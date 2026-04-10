<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Eloquent\UserRepository;
use App\Repositories\Eloquent\RoleRepository;
use App\Http\Requests\User\UserRequest;
use App\Http\Requests\User\UserPersonalRequest;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * var
     * @var UserRepository
     */
    private $userRepository;

    /**
     * var
     * @var RoleRepository
     */
    private $roleRepository;

    /**
     * roleRepository constructor.
     * @param roleRepository
     */
    public function __construct(UserRepository $userRepository, RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->roleRepository = $roleRepository;
    }

    /**
     * show index post
     * @return collection
     */
    public function loadData()
    {
        $data = $this->userRepository->all();
        $data = $this->userRepository->dataTable($data);
        return $data;
    }

    /**
     *  show all article
     * @return view
     */
    public function index() {
        return view('admin.user.index');
    }

    /**
     * show form add user into database
     * @return Illuminate\Http\Response
     */

     public function create() {
        checkPermission('admin-create');
        $text = 'Add user';
        $user = [];
        $role = $this->roleRepository->listRoleArray();
        $jobs = $this->userRepository->listJobArray();
        $departments = $this->userRepository->listDepartmentArray();
        return view('admin.user.form', compact('text', 'role', 'user', 'jobs', 'departments'));
     }

     /**
     * show form edit user
     * @return Illuminate\Http\Response
     */

    public function editPersonal() {
        $text = 'Edit personal';
        $user = $this->userRepository->find(auth()->user()->id);
        $jobs = $this->userRepository->listJobArray();
        $departments = $this->userRepository->listDepartmentArray();
        return view('admin.user.personal', compact('text', 'user', 'jobs', 'departments'));
    }

    /**
      * update user
      * @param array $request
      * @return redirect
      */
      public function updatePersonal(UserPersonalRequest $request) {
        $validated = $request->validated();
        $id = auth()->user()->id;
        $user = $this->userRepository->updateUser($request, $id);
        $this->userRepository->thumb($request, 'users', $user->id);
        return redirect()->back()->with('status', 'User updated successful!');
    }

     /**
     * show form edit user into database
     * @return Illuminate\Http\Response
     */

    public function edit($id) {
        checkPermission('admin-edit');
        $text = 'Edit user';
        $user = $this->userRepository->find($id);
        $role = $this->roleRepository->listRoleArray();
        $jobs = $this->userRepository->listJobArray();
        $departments = $this->userRepository->listDepartmentArray();
        return view('admin.user.form', compact('text', 'role', 'user', 'jobs', 'departments'));
     }

     /**
      * add user
      * @param array $request
      * @return redirect
      */
    public function store(UserRequest $request) {
        $validated = $request->validated();
        $user = $this->userRepository->addUser($request);
        $this->userRepository->thumb($request, 'users', $user->id);
        return redirect()->route('user.edit', $user->id)->with('status', 'User created successful!');
    }

    /**
      * add user
      * @param array $request
      * @return redirect
      */
      public function update(UserRequest $request, $id) {
        $validated = $request->validated();
        $user = $this->userRepository->updateUser($request, $id);
        $this->userRepository->thumb($request, 'users', $user->id);
        return redirect()->back()->with('status', 'User updated successful!');
    }

    /**
      * delete user
      * @param int $id
      * @return redirect
      */

    public function destroy($id) {
        checkPermission('admin-delete');
        $this->userRepository->deleteWithAvatar($id);
        return redirect()->route('user.index')->with('status', 'User deleted successful!');
    }
}
