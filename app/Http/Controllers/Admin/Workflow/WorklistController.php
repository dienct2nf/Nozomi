<?php

namespace App\Http\Controllers\Admin\Workflow;

use App\Http\Controllers\Controller;
use App\Models\Workflow\Worklist;
use App\Repositories\Eloquent\WorkFlowRepository;
// use App\Http\Requests\Work\WorkListRequest;
use App\Http\Requests\Work\WorkListMultipleRequest;
use Illuminate\Http\Request;

class WorklistController extends Controller
{
    /**
     * variable param
     * @param $department;
     * @param $workflow;
     */

    protected $workRepository;


    /**
     * contruct
     * @param WorkFlowRepository
     */

    public function __construct(WorkFlowRepository $work) {
        $this->workRepository = $work;
    }

    /**
     * show department
     * @return collection
     */
    public function loadData()
    {
        $data = $this->workRepository->getListWork();
        $data = $this->workRepository->dataTableWorkList($data);
        return $data;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listDepartment = $this->workRepository->getListDepartment();
        return view('admin.work.worklist.index', compact('listDepartment'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function todoList(Request $request) {
        $listAllDepartment = $this->workRepository->getListDepartment();
        if ($request->has('ngaybatdau')) {
            $listDepartment = $this->workRepository->getListDepartmentWithDate($request);
        } else {
            $listDepartment = $this->workRepository->getListDepartmentToday($request);
        }
        return view('frontend.work.index', compact('listDepartment', 'listAllDepartment'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detailDepartment(Request $request, $id) {

        if (!empty(auth()->user()) && auth()->user()->can('work-create')) {
            $listAllDepartment = $this->workRepository->getListDepartment();
        } else {
            $listAllDepartment = $this->workRepository->findDepartment($id);
        }
        if ($request->has('ngaybatdau')) {
            $listDepartment = $this->workRepository->getListDepartmentWithDateByID($request, $id);
        } else {
            $listDepartment = $this->workRepository->getListDepartmentTodayByID($request, $id);
        }
        $listAllDepartmentSelect = $this->workRepository->getListDepartment();
        // return $listAllDepartment;
        $department = $this->workRepository->findDepartment($id);
        return view('frontend.work.detail', compact('department', 'listDepartment', 'listAllDepartment', 'listAllDepartmentSelect'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $text = 'Create';
        $worklist = [];
        $rowReplace = 0;
        $listDepartment = $this->workRepository->getListDepartment();
        return view('admin.work.worklist.create', compact('worklist', 'text', 'rowReplace', 'listDepartment'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return $this->workRepository->addWorkList($request);
    }

    /**
     * storeMultiple a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeMultiple(WorkListMultipleRequest $request)
    {
        $this->workRepository->addWorkListMultiple($request);
        return redirect()->route('work.worklist.index')
                        ->with('status', 'Thêm công việc thành công!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workflow\Worklist  $worklist
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->workRepository->findWorkListJson($id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workflow\Worklist  $worklist
     * @return \Illuminate\Http\Response
     */

    public function getJson($id)
    {
        return $this->workRepository->findWorkListJson($id);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workflow\Worklist  $worklist
     * @return \Illuminate\Http\Response
     */
    public function edit(Worklist $worklist)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workflow\Worklist  $worklist
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Worklist $worklist)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workflow\Worklist  $worklist
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->workRepository->deleteWorkList($id);
        return redirect()->route('work.worklist.index')
                        ->with('status', 'Xóa công việc thành công!');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workflow\Worklist  $worklist
     * @return \Illuminate\Http\Response
     */
    public function ajaxDelete($id)
    {
        return $this->workRepository->ajaxDelete($id);
    }
}
