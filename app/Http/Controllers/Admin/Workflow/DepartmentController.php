<?php

namespace App\Http\Controllers\Admin\Workflow;

use App\Http\Controllers\Controller;
use App\Models\Workflow\Department;
use App\Repositories\Eloquent\WorkFlowRepository;
use Illuminate\Http\Request;
use App\Http\Requests\Work\DepartmentRequest;

class DepartmentController extends Controller
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

    public function __construct(WorkFlowRepository  $work) {
        $this->workRepository = $work;
    }

    /**
     * show department
     * @return collection
     */
    public function loadData()
    {
        $data = $this->workRepository->getListDepartment();
        $data = $this->workRepository->dataTableDepartment($data);
        return $data;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $text = 'Create';
        $department = [];
        $listDepartments = $this->workRepository->getListDepartment();
        $listUsers = $this->workRepository->listUsersToArray();
        return view('admin.work.department.index', compact('department', 'text', 'listDepartments', 'listUsers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return redirect()->route('home.contact')->with('status', 'Cảm ơn bạn đã để lại thông tin. Chúng tôi sẽ sớm liên hệ lại với bạn.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $validated = $request->validated();
        $slider = $this->workRepository->addDepartment($request);
        return redirect()->route('work.department.edit', $slider->id)
                        ->with('status', 'Created department successful!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Workflow\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Workflow\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = $this->workRepository->findDepartment($id);
        $text = $department->title;
        $listDepartments = $this->workRepository->listDepartmentToArray();
        $listUsers = $this->workRepository->listUsersToArray();
        return view('admin.work.department.index', compact('department', 'text', 'listDepartments' ,'listUsers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Workflow\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        $validated = $request->validated();
        $this->workRepository->updateDepartment($request, $id);
        return redirect()->route('work.department.edit', $id)
                        ->with('status', 'Created department successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Workflow\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->workRepository->deleteDepartment($id);
        return redirect()->route('work.department.index')
                        ->with('status', 'Delete department successful!');
    }
}
