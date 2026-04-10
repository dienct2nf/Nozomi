<?php

namespace App\Repositories\Eloquent;

use App\Repositories\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Collection;
use Image;
use MediaUploader;
use Illuminate\Support\Facades\Storage;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
     protected $model;

     /**
     * @var day
     */
    protected $day;

    /**
     * @var month
     */
    protected $month;

     /**
     * @var month
     */
    protected $year;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
        $this->day = date('d');
        $this->month = date('m');
        $this->year = date('Y');
    }

    /**
    * Get all instances of model
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->model->all();
    }
    /**
    * create a new record in the database
    * @param array $attributes
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
    * update record in the database
    * @param array $attributes
    * @param int $id
    * @return Model
    */
    public function update(array $attributes, $id) : bool
    {
        $record = $this->find($id);
        return $record->update($attributes);
    }

    /**
    * remove record from the database
    * @param int $id
    * @return bool
    */
    public function delete($id) : bool
    {
        return $this->model->destroy($id);
    }

    /**
    * find with id
    * @param  int $id
    * @return Model
    */
    public function find($id): ? Model
    {
        return $this->model->find($id);
    }

    /**
    * show the record with the given id
    * @param  int $id
    * @return Model
    */
    public function show($id) : ? Model
    {
        return $this->model->findOrFail($id);
    }
     /**
    * Eager load database relationships
    * @param  array|string $relations
    * @return Model
    */
    public function with($relations)
    {
        return $this->model->with($relations);
    }

    /**
    * @param $text
    * @return String
    */
    public function slug($text): ? string
    {
        return SlugService::createSlug($this->model, 'slug', $text, ['unique' => false]);
    }

    /**
    * @param int $id
    * @return bool
    */
    public function deleteFile($id): ? bool {
        $data = $this->model->find($id);
        $data = $data->loadMedia();
        $arrayFiles = [];
        foreach ($data->media as $item) {
            $image_path = "$item->disk/$item->directory/$item->filename.$item->extension";
            array_push($arrayFiles, $image_path);
        }
        return Storage::disk('photos')->delete($arrayFiles);
    }

    /**
    * @param int $path
    * @return bool
    */
    public function copyFile($image_path): ? string {
                return $image_path;
    }
     /**
    * @param int $id
    * @return bool
    */
    public function deleteThumb($id): ? bool {
        $data = $this->model->find($id);
        $data = $data->loadMedia(['thumbnail', 'original']);
        $arrayFiles = [];
        foreach ($data->media as $item) {
            $image_path ="$item->disk/$item->directory/$item->filename.$item->extension";
            array_push($arrayFiles, $image_path);
        }
        return Storage::disk('photos')->delete($arrayFiles);
    }

    /**
    * @param array $request
    * @param string $folder
    * @param array $data
    * @return bool
    */

    public function thumb($request, $folder, $id): ? bool {
        // small. jpg (320 × 240 pixels)
        $data = $this->find($id);
        $filename = $data->slug.'-'.mt_rand();
        if ( isset($request->image) && !empty($request->image)) {
            $img = Storage::disk('photos')->get($request->image);
            // delete old thumb
            $this->deleteThumb($id);
            // create new thumb
            $string = Image::make($img);
            $string_encode = $string->resize(480, 320)
            ->encode('jpg');
            $media = MediaUploader::fromString($string_encode)
            ->toDestination('uploads', $folder.'/thumbnails/'.$this->year.'/'.$this->month)
            ->useFilename($filename.'-480-320')
            ->upload();
            $data->attachMedia($media, ['thumbnail']);

            // medium. jpg (640 × 480  pixels)
            $string_medium = $string->resize(640, 480)
            ->encode('jpg');
            $media = MediaUploader::fromString($string_medium)
            ->toDestination('uploads', $folder.'/thumbnails/'.$this->year.'/'.$this->month)
            ->useFilename($filename.'-640-480')
            ->upload();

            $data->attachMedia($media, ['thumbnail']);
            //insert database
            $this->update(['img' => $media->getDiskPath()], $id);

            // original
            $string_encode = $string->resize($string->width(), $string->height(), function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
            $media = MediaUploader::fromString($string_encode)
            ->toDestination('uploads', $folder.'/original/'.$this->year.'/'.$this->month)
            ->useFilename($filename)
            ->upload();

            $data->attachMedia($media, ['original']);

            $string_encode->destroy();
            return true;
        }
        return false;

    }
}
