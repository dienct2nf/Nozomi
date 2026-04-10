<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Models\Job;
use App\Models\Workflow\Department;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Support\Collection;
use Hash;
use Illuminate\Support\Arr;
use Image;
use DataTables;
use MediaUploader;
use Storage;
class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * @var Model
     */
    protected $model;

    /**
     * @var Job
     */
    protected $job;

    /**
     * @var Department
     */
    protected $department;

   /**
    * UserRepository constructor.
    *
    * @param User $model
    * @param Job $job
    */
   public function __construct(User $model, Job $job, Department $department)
   {
       parent::__construct($model);
       $this->job = $job;
       $this->department = $department;
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->all();
   }

   /**
    * add record database
    * @param array $request
    * @return object collection
    */
   public function addUser($request) : object {
        $input = $request->all();
        $input['password'] = Hash::make($input['password']); //password
        $input['name'] = $request->firstname.' '.$request->lastname;
        $user = $this->model->create($input);
        $this->createFolder($user->id);
        if (isset($request->roles)) {
            $user->assignRole($request->input('roles'));
        }
        return $user;
   }


   /**
    * add record databse
    * @param array $request
    * @param int $id
    * @return object collection
    */
    public function updateUser($request, $id) : object {
        $input = $request->all();
        $input['name'] = $request->firstname.' '.$request->lastname;
        $user = $this->model->find($id);
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']); //password
        } else {
            $input = Arr::except($input, array('password')); //except password
        }
        if (isset($request->roles)) {
            $user->syncRoles($request->input('roles'));
        }
        $user->update($input);
        return $user;
   }

   /**
    * @param array $request
    * @param string $folder
    * @param array $data
    * @return bool
    */

    public function thumb($request, $folder, $id): ? bool {
        $data = $this->find($id);
        $filename = 'avatar-'.$data->id.mt_rand();
        if ( isset($request->image) && !empty($request->image)) {
            $img = Storage::disk('photos')->get($request->image);
            // delete old thumb
            $this->deleteThumb($id);
            // original user custom from to laravel file manager
            $string = Image::make($img);
            $string_small = $string->resize($string->width(), $string->height(), function ($constraint) {
                $constraint->aspectRatio();
            })
            ->encode('jpg');
            $media = MediaUploader::fromString($string_small)
            ->toDestination('uploads', $folder.'/original/'.$this->year.'/'.$this->month)
            ->useFilename($filename)
            ->upload();
            $this->update(['img' => $media->getDiskPath()], $id);
            $data->attachMedia($media, ['original']);
            return true;
        }
        return false;

    }

        /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTable($data) : object {
        return  Datatables::of($data)
                    ->addColumn('img', function ($category) {
                        if (trim($category->img) == '') {
                            $url= '/vendor/image/no-avatar.png';
                        } else {
                            $url= '/uploads/'.$category->img;
                        }
                        return $url;
                        })
                    ->addColumn('roles', function($user){
                        $roles = $user->roles->map(function($item){
                                        return $item->name;
                                    });
                        return $roles;
                    })
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('admin-edit')) {
                            $btn .= '<a href="'.route('user.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }
                        if (auth()->user()->can('admin-delete')) {
                            $btn .= '<form method="POST" action="'.route("user.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
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
     * delete with file and media
     * @param int $id
     * @return object
     */
    public function deleteWithAvatar($id) : bool
    {
        $this->deleteFile($id);
        return $this->model->destroy($id);
    }

    /**
     * list jobs array
     * @return array
     */

    public function listJobArray() : array {
        $jobs = $this->job->all();
        $arrayData = new \stdClass();
        foreach ($jobs as $row) {
            $title = $row->name;
            $id = $row->id;
            $arrayData->{$id} = $title;
        }
        $arrayData = (array) $arrayData;
        return (array) $arrayData;
    }

    /**
     * list department array
     * @return array
     */

    public function listDepartmentArray() : array {
        $departments = $this->department->all();
        $arrayData = new \stdClass();
        foreach ($departments as $row) {
            $title = $row->title;
            $id = $row->id;
            $arrayData->{$id} = $title;
        }
        $arrayData = (array) $arrayData;
        return (array) $arrayData;
    }

    /**
     * create folder user
     * @param int $id
     */

    public function createFolder($id) {
        foreach (config('custom.create_folder') as $key => $val) {
            $folder = "photos/$id/$key";
            Storage::disk('photos')->makeDirectory($folder);
        }
    }
}
