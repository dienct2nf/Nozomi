<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleRequest;
use App\Repositories\Eloquent\RoleRepository;

class RoleController extends Controller
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
        // $this->middleware(['role:Administrator','permission:admin-create|admin-edit|admin-delete']);
        $this->roleRepository = $roleRepository;
    }

    /**
     * show index category
     * @return collection
     */
    public function loadData()
    {
        $data = $this->roleRepository->allRole();
        $data = $this->roleRepository->dataTableRole($data);
        return $data;
    }

    /**
     * show index roles
     * @return Illuminate\Http\Response
     */
    public function index() {
        checkPermission('admin-create');
        $text = 'Create Role';
        $role = [];
        $permission = $this->roleRepository->listPermissionArray();
        return view('admin.role.index', compact('role', 'permission', 'text'));
    }

    /**
     * add role database
     * @return Illuminate\Http\Response
     */
    public function store(RoleRequest $request) {
        $validated = $request->validated();
        $role = $this->roleRepository->addRole($request);
        return redirect()->route('role.edit', $role->id)
                        ->with('status', 'Created role successful!');
    }

    /**
     * edit index roles
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function edit($id) {
        checkPermission('admin-edit');
        $text = 'Edit Role';
        $role = $this->roleRepository->findRole($id);
        $permission = $this->roleRepository->listPermissionArray();
        return view('admin.role.index', compact('role', 'permission', 'text'));
    }

    /**
     * update record  roles
     * @param array $request
     * @param int $id
     * @return Illuminate\Http\Response
     */
    public function update(RoleRequest $request, $id) {
        $validated = $request->validated();
        $role = $this->roleRepository->updateRole($request, $id);
        return redirect()->back()
                         ->with('status', 'Updated role successful!');
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
        $this->roleRepository->deleteRole($id);
        return redirect()->route('role.index')
                        ->with('status', 'Deleted role successful!');
    }
}
