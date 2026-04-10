<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Models\Workflow\Department;
use App\Models\Workflow\Worklist;
use App\Repositories\WorkFlowRepositoryInterface;
use DataTables;
use Validator;

class WorkFlowRepository extends BaseRepository implements WorkFlowRepositoryInterface
{

     /**
     * @var Model
     */
    protected $model;

     /**
     * @var CustomerOrder
     */
    protected $department;

     /**
     * @var Product
     */
    protected $worklist;

     /**
     * @var User
     */
    protected $user;

   /**
    * WorkFlowRepository constructor.
    *
    * @param Customer $model
    */
   public function __construct(
       User $model,
       Worklist $worklist,
       Department $department
       )
   {
       parent::__construct($model);
       $this->worklist = $worklist;
       $this->department = $department;
   }

    /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTableDepartment($data) : object {
        return  Datatables::of($data)

                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<a data-toggle="tooltip" data-placement="right" title="'.__('label.edit').'" href="'.route('work.department.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }
                        if (auth()->user()->can('admin-edit')) {
                            $btn .= '<form method="POST" action="'.route("work.department.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.csrf_token().'">
                            <button data-toggle="tooltip" data-placement="right" title="'.__('label.delete').'" class="btn btn-danger btn-sm delete-confirm" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
    }


    /**
     * list record
     * @param array $request
     * @return object
     */
    public function getListDepartment() : object
    {
        $department = $this->department->all();
        return $department;
    }

    /**
     * return y-m-d
     */

    public function covertDate($input) {
        $date = str_replace('/', '-', $input);
        return date('Y-m-d', strtotime($date));
    }

    /**
     * list record
     * @param array $request
     * @return object
     */

    public function getListDepartmentWithDate($request) : object
    {
        if ($request->ngaybatdau == $request->ngayketthuc) {
            $department = $this->getListDepartmentToday($request);
            return $department;
        }
        $department = $this->department->with(['worklists' => function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                $query->whereBetween('start_at', [$this->covertDate($request->ngaybatdau), $this->covertDate($request->ngayketthuc)])
                    ->orWhereBetween('end_at', [$this->covertDate($request->ngaybatdau), $this->covertDate($request->ngayketthuc)]);
        });
        }])->get();
        return $department;
    }

    public function getListDepartmentWithDateByID($request, $id) : object
    {
        if ($request->ngaybatdau == $request->ngayketthuc) {
            $department = $this->getListDepartmentTodayByID($request, $id);
            return $department;
        }
        $department = $this->department->with(['worklists' => function ($query) use ($request) {
            $query->where(function ($query) use ($request) {
                    $query->whereBetween('start_at', [$this->covertDate($request->ngaybatdau), $this->covertDate($request->ngayketthuc)])
                        ->orWhereBetween('end_at', [$this->covertDate($request->ngaybatdau), $this->covertDate($request->ngayketthuc)]);
            });
        }])
        ->where('id', $id)
        ->get();
        return $department;
    }

    public function getListDepartmentToday($request) : object
    {
        $department = $this->department->with(['worklists' => function ($query) use ($request) {
            $query->where('start_at', '<=', $this->covertDate(date('d/m/Y')));
            $query->where('end_at', '>=', $this->covertDate(date('d/m/Y')));
        }])->get();
        return $department;
    }

    public function getListDepartmentTodayByID($request, $id) : object
    {
        $department = $this->department->with(['worklists' => function ($query) use ($request) {
            $query->where('start_at', '<=', $this->covertDate(date('d/m/Y')));
            $query->where('end_at', '>=', $this->covertDate(date('d/m/Y')));
        }])
        ->where('id', $id)
        ->get();
        return $department;
    }

    /**
     * add record
     * @param array $request
     * @return object
     */
    public function addDepartment($request) : object
    {
        $input = $request->all();
        $department = $this->department->create($input);
        return $department;
    }

    /**
     * update record
     * @param array $request
     * @param int $id
     * @return object
     */
    public function updateDepartment($request, $id) : bool
    {
        $department = $this->department->find($id);
        $input = $request->all();
        if($request->parent_id == 0) {
            $input['parent_id'] = null;
        }
        $data = $department->update($input);
        return $data;
    }

    /**
     * delete record
     * @param int $id
     * @return object
     */
    public function deleteDepartment($id) : bool
    {
        $data = $this->department->destroy($id);
        return $data;
    }


    /**
     * find record
     * @param int $id
     * @return object
     */
    public function findDepartment($id) : object
    {
        $data = $this->department->find($id);
        return $data;
    }

     /**
     * select page record
     * @param int $limit
     * @return object
     */

    public function pageDepartment($limit) : object {
        return $this->department->paginate($limit);
    }

    /**
     * add record
     * @param array $request
     * @return object
     */
    public function addWorkListMultiple($request) : bool
    {
        $list = $request->row;
        foreach ($list as $key => $value) {
            $data = [];
            $data = $value;
            $data['user_id'] = $request->user()->id;
            // insert
            $listWork = $this->worklist->create($data);
            $listWork->departments()->sync($data['department_id'], true);
        }
        return true;
    }

    /**
     * add record
     * @param array $request
     * @return object
     */
    public function addWorkList($request) : string
    {

        $validation = Validator::make($request->all(), [
            'title' => 'required',
            'department_id' => 'required',
            'start_at' => 'required',
            'end_at' => 'required',
        ],
        [
            'title.required' => 'Tên công việc không được để trống',
            'department_id.required' => 'Phòng ban không được để trống',
            'start_at.required' => 'Ngày bắt đầu không được để trống',
            'end_at.required' => 'Ngày kết thúc không được để trống'
        ]
    );

        $error_array = array();
        $success_output = '';
        if ($validation->fails())
        {
            foreach ($validation->messages()->getMessages() as $field_name => $messages)
            {
                $error_array[] = $messages;
            }
        }
        else
        {
            if ($request->method_action == 'update') {
                $this->updateWorkList($request, $request->worklist_id);
                $success_output = '<div class="alert alert-success">Cập nhật thành công</div>';
                $error_array = [];
            } else {
                $input = $request->all();
                $input['user_id'] = $request->user()->id;
                $listWork = $this->worklist->create($input);
                $listWork->departments()->sync($input['department_id'], true);
                $success_output = '<div class="alert alert-success">Thêm thành công</div>';
                $error_array = [];
            }
        }
        $output = array(
            'errors'     => $error_array,
            'success'   =>  $success_output
        );
        return json_encode($output);

    }

     /**
     * update record
     * @param array $request
     * @param int $id
     * @return object
     */
    public function updateWorkList($request, $id) : bool
    {
        $input = $request->all();
        $department = $this->worklist->find($id);
        $data = $department->update($request->all());
        $department->departments()->sync($input['department_id'], true);
        return $data;
    }

    /**
     * list record
     * @param array $request
     * @return object
     */
    public function getListWork() : object
    {
        $work = $this->worklist->with('author', 'departments')->orderBy('created_at', 'DESC')->get();
        return $work;
    }

    /**
     * json worklist
     */
    public function findWorkListJson($id) {

        $list = $this->worklist->find($id);
        $list->department_id = $list->departments->first()->id;
        $list->start_at_edit = date('d/m/Y', strtotime($list->start_at));
        $list->end_at_edit = date('d/m/Y', strtotime($list->end_at));
        return json_encode($list);
    }


    /**
     * delete record
     * @param int $id
     * @return object
     */
    public function deleteWorkList($id) : bool
    {
        $data = $this->worklist->destroy($id);
        return $data;
    }

    /**
     * list record database covert
     * @param array $request
     * @return object
     */

    public function dataTableWorkList($data) : object {
        return  Datatables::of($data)
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('article-edit')) {
                            $btn .= '<button data-toggle="tooltip" data-placement="right" title="'.__('label.edit').'" data-department_id="'.auth()->user()->department_id.'" data-id="'.$row->id.'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;</button>';
                        } else if (auth()->user()->id == $row->user_id) {
                            $btn .= '<a data-toggle="tooltip" data-placement="right" title="'.__('label.edit').'" href="'.route('work.department.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                            $btn .= '<form method="POST" action="'.route("work.department.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.csrf_token().'">
                            <button data-toggle="tooltip" data-placement="right" title="'.__('label.delete').'" class="btn btn-danger btn-sm delete-confirm" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>';
                        }
                        if (auth()->user()->can('admin-edit')) {
                            $btn .= '<form method="POST" action="'.route("work.worklist.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
                            <input name="_method" type="hidden" value="DELETE">
                            <input name="_token" type="hidden" value="'.csrf_token().'">
                            <button data-toggle="tooltip" data-placement="right" title="'.__('label.delete').'" class="btn btn-danger btn-sm delete-confirm" type="submit"><i class="fas fa-fw fa-trash"></i></button>
                            </form>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['action', 'description'])
                    ->make(true);
    }

    /**
     * delete record ajax
     * @param int $id
     */

    public function ajaxDelete($id) : string {

        $work = $this->worklist->find($id);
        $work->delete();
        return response()->json([
          'message' => 'Xóa thành công!'
        ]);

  }

  /**
    * get category by langues
    * @return array
    */
    public function listDepartmentToArray() : object {
        $data = $this->department->all();
        return $data;
    }

    /**
    * get category by langues
    * @return array
    */
    public function listUsersToArray() : array {
        $data = $this->model->all();
        $arrayData = new \stdClass();
        foreach ($data as $row) {
            $title = $row['name'];
            $id = $row['id'];
            $arrayData->{$id} = $title;
        }
        $arrayData = (array) $arrayData;
        return (array) $arrayData;
    }

}
