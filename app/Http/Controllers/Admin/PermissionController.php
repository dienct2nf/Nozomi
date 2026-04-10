<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Role\PermissionRequest;
use App\Repositories\Eloquent\RoleRepository;

class PermissionController extends Controller
{

    /**
     * RoleRepository
     * @var roleRepository
     */
    private $roleRepository;

    /**
     * roleRepository constructor.
     * @param roleRepository
     */
    public function __construct(RoleRepository $roleRepository) {
        $this->roleRepository = $roleRepository;
    }

    /**
     * show index category
     * @return collection
     */
    public function loadData()
    {
        // $category = $this->categoryRepository->all();
        // return view('admin.category.index', compact('category'));
        $data = $this->roleRepository->allPermission();
        $data = $this->roleRepository->dataTablePermission($data);
        return $data;
    }

    /**
     * show index roles
     * @return Illuminate\Http\Response
     */
    public function index() {
        checkPermission('admin-create');
        $text = 'Create Permission';
        $permission = [];
        $role = $this->roleRepository->listRoleArray();
        return view('admin.permission.index', compact('role', 'permission', 'text'));
    }

    /**
     * add role database
     * @return Illuminate\Http\Response
     */
    public function store(PermissionRequest $request) {
        $validated = $request->validated();
        $permission = $this->roleRepository->addPermission($request);
        return redirect()->route('permission.edit', $permission->id)
                        ->with('status', 'Created permission successful!');
    }

    /**
     * edit index roles
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function edit($id) {
        checkPermission('admin-edit');
        $text = 'Edit Permission';
        $permission = $this->roleRepository->findPermission($id);
        $role = $this->roleRepository->listRoleArray();
        return view('admin.permission.index', compact('role', 'permission', 'text'));
    }

    /**
     * update record  roles
     * @param array $request
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, $id) {
        $validated = $request->validated();
        $role = $this->roleRepository->updatePermission($request, $id);
        return redirect()->back()
                         ->with('status', 'Updated permission successful!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        checkPermission('admin-delete');
        $this->roleRepository->deletePermission($id);
        return redirect()->route('permission.index')
                        ->with('status', 'Deleted permission successful!');
    }
}
