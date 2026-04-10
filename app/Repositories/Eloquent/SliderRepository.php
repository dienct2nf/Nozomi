<?php

namespace App\Repositories\Eloquent;

use App\Models\Slider;
use App\Models\Widget;
use App\Repositories\SliderRepositoryInterface;
use Illuminate\Support\Collection;
use DataTables;
use MediaUploader;
use Image;
use Illuminate\Support\Str;
use Storage;
class SliderRepository extends BaseRepository implements SliderRepositoryInterface
{

     /**
     * @var Model
     */
    protected $model;

    /**
     * @var Widget
     */
    protected $widget;

   /**
    * SliderRepository constructor.
    *
    * @param Slider $model
    */
   public function __construct(Slider $model, Widget $widget)
   {
       parent::__construct($model);
       $this->widget = $widget;
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();
   }


   /**
    * attribute value form
    * @param array $request
    * @return array
    */

    public function attribute($request): array {

        $newArrayAtribute = [];

        foreach (config('translatable.language') as $key => $item) {

            $newArrayAtribute[$key] = [
                'title'       => $request->input('title_'.$key),
                'description'       => $request->input('description_'.$key)
            ];
        }
        $newArrayAtribute['parent_id'] = $request->input('parent_id') == 0? NULL : $request->input('parent_id');
        $newArrayAtribute['order'] = $request->input('order');
        $newArrayAtribute['link'] = $request->input('link');
        //return data
        return $newArrayAtribute;
       }

   /**
    * get parent group slider
    * @return object
    */

   public function getGroup() : object {
       return $this->model->whereNull('parent_id')->get();
   }

    /**
    * get chilldren  slider
    * @return object
    */

    public function getChildren() : object {
        return $this->model->whereNotNull('parent_id')->get();
    }

   /**
     * list Slider array
     * @return array
     */

    public function listSliderArray() : array {
        $permission = $this->getGroup();
        $arrayData = new \stdClass();
        foreach ($permission as $row) {
            $title = $row->title;
            $id = $row->id;
            $arrayData->{$id} = $title;
        }
        $arrayData = (array) $arrayData;
        return (array) $arrayData;
    }

   /**
    * add record databse
    * @param array $request
    * @return object collection
    */
   public function addSlider($request) : object {
        $attribute  = $this->attribute($request);
        $slider  = $this->model->create($attribute);
        $this->saveImageSlider($request, 'slider', $slider->id);
        return $slider;
   }

   /**
    * add record databse
    * @param array $request
    * @param int $id
    * @return object collection
    */
    public function updateSlider($request, $id) : object {
        $slider = $this->model->find($id);
        $attribute  = $this->attribute($request);
        $slider->update($attribute);
        $this->saveImageSlider($request, 'slider', $id);
        return $slider;
   }

   /**
    * @param array $request
    * @param string $folder
    * @param array $data
    * @return bool
    */

    public function saveImageSlider($request, $folder, $id): ? bool {
        // small. jpg (320 × 240 pixels)
        $data = $this->find($id);
        $filename = 'slider-'.$data->id.mt_rand();
        if ( isset($request->image) && !empty($request->image)) {
            
            
            
            $img = Storage::disk('photos')->get($request->image);
            // delete old thumb
            $this->deleteThumb($id);
            // create new thumb
            $string = Image::make($img);
            $string_encode = $string->resize($string->width(), $string->height(), function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
            $media = MediaUploader::fromString($string_encode)
            ->toDestination('uploads', $folder.'/original/'.$this->year.'/'.$this->month)
            ->useFilename($filename)
            ->upload();
            //insert database
            $this->update(['img' => $media->getDiskPath()], $id);
            $data->attachMedia($media, ['original']);
            $string_encode->destroy();
            return true;
        }
        return false;

    }

        /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTable($data, $request) : object {
        return  Datatables::of($data)
                    ->addColumn('img', function ($slider) {
                            $url= '/uploads/'.$slider->img;
                        return $url;
                        })
                    ->addColumn('group', function($query){
                        $group  = $query->parent->title;
                        return $group;
                    })
                    ->filter(function ($instance) use ($request) {
                        if (!empty($request->get('group'))) {
                            $instance->collection = $instance->collection->filter(function ($row) use ($request) {
                                return Str::contains($row['group'], $request->get('group')) ? true : false;
                            });
                        }
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<a href="'.route('slider.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }
                        if (auth()->user()->can('article-delete')) {
                            $btn .= '<form method="POST" action="'.route("slider.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.csrf_token().'">
                            <button class="btn btn-danger btn-sm delete-confirm" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>';
                        }

                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }

     /**
     * delete slider
     * @param int $id
     * @return object
     */
    public function delete($id) : bool
    {
        $this->deleteFile($id);
        return $this->model->destroy($id);
    }


     /**
    * find record databse
    * @param array $request
    * @return object collection
    */
   public function findWidget($id) : object {
    $slider  = $this->widget->find($id);
    return $slider;
}

    /**
    * add record databse
    * @param array $request
    * @return object collection
    */
   public function addWidget($request) : object {
        $input  = $request->all();
        $input['user_id']  = $request->user()->id;
        $slider  = $this->widget->create($input);
        return $slider;
    }

    /**
    * update record databse
    * @param array $request
    * @return object collection
    */
   public function updateWidget($request, $id) : object {
        $input  = $request->all();
        $widget = $this->widget->find($id);
        $widget->update($input);
        return $widget;
    }



    /**
    * delete record databse
    * @param array $request
    * @return object collection
    */
   public function deleteWidget($id) : bool {
        return $this->widget->destroy($id);
    }

    /**
     * get list widget
     */

    public function getListWidget() : object {
        return $this->widget->with('author')->orderBy('created_at', 'DESC')->get();
    }

       /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTableWidget($data, $request) : object {
        return  Datatables::of($data)
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<a href="'.route('widget.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }
                        if (auth()->user()->can('article-delete')) {
                            $btn .= '<form method="POST" action="'.route("widget.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.csrf_token().'">
                            <button class="btn btn-danger btn-sm delete-confirm" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>';
                        }

                        return $btn;
                    })
                    ->rawColumns(['action' , 'description'])
                    ->make(true);
    }
}
