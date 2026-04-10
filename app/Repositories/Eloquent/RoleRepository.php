<?php

namespace App\Repositories\Eloquent;

use App\Repositories\RoleRepositoryInterface;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
class RoleRepository extends BaseRepository implements RoleRepositoryInterface
{

     /**
     * @var Model
     */
    protected $role;

      /**
     * @var Model
     */
    protected $permission;
   /**
    * UserRepository constructor.
    *
    * @param Role $model
    */
   public function __construct(Role $role, Permission $permission)
   {
    //    parent::__construct($model);
        $this->role = $role;
        $this->permission = $permission;
   }


   /**
    * Get all instances of model
    * @return Collection
    */
    public function allRole(): Collection
    {
        return $this->role->all();
    }

    /**
    * find model
    * @param int $id;
    * @return Collection
    */
    public function findRole($id): object
    {
        return $this->role->find($id);
    }

   /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTableRole($data) : object {
        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('permissions', function($permission){
                        $permissions = $permission->permissions->map(function($item){
                                        return $item->name;
                                    });
                        return $permissions;
                    })
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('admin-edit')) {
                            $btn .= '<a href="'.route('role.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }
                        if (auth()->user()->can('admin-delete')) {
                            $btn .= '<form method="POST" action="'.route("role.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
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
    * insert database request
    * @param array $request
    */

    public function addRole($request) : object {
        $role = $this->role->create([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);
        $role->syncPermissions($request->input('permission'));
        return $role;
    }

    /**
     * list permission array
     * @return array
     */

    public function listPermissionArray() : array {
        $permission = $this->permission->all();
        $arrayData = new \stdClass();
        foreach ($permission as $row) {
            $title = $row->name;
            $id = $row->id;
            $arrayData->{$id} = $title;
        }
        $arrayData = (array) $arrayData;
        return (array) $arrayData;
    }

    /**
     * update into database
     * @param int $id
     * @param array $request
     * @return object
     */
    public function updateRole($request, $id) : object {
        $role = $this->role->find($id);
        $role->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        $role->syncPermissions($request->input('permission'));
        return $role;
    }

    /**
     * delete into database
     * @param int $id
     * @return object
     */
    public function deleteRole($id) : bool {
        $role = $this->role->find($id);
        $role = $role->delete();
        return $role;
    }

    /**
    * Get all instances of model
    * @return Collection
    */
    public function allPermission(): Collection
    {
        return $this->permission->all();
    }

    /**
    * find model
    * @param int $id;
    * @return Collection
    */
    public function findPermission($id): object
    {
        return $this->permission->find($id);
    }

   /**
     * render datatabe
     * @param object
     * @return object
     */
    public function dataTablePermission($data) : object {
        return  Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('roles', function($permission){
                        $roles = $permission->roles->map(function($item){
                                        return $item->name;
                                    });
                        return $roles;
                    })
                    ->addColumn('action', function($row){
                        $btn = '';
                        if (auth()->user()->can('admin-edit')) {
                            $btn .= '<a href="'.route('permission.edit', $row->id).'" class="edit btn btn-info btn-sm"><i class="fas fa-fw fa-edit "></i></a>&nbsp;';
                        }
                        if (auth()->user()->can('admin-delete')) {
                            $btn .= '<form method="POST" action="'.route("permission.destroy", $row->id).'" accept-charset="UTF-8" style="display:inline">
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
    * insert database request
    * @param array $request
    */

    public function addPermission($request) : object {
        $permission = $this->permission->create([
                'name' => $request->input('name'),
                'description' => $request->input('description')
            ]);
        $permission->syncRoles($request->input('role'));
        return $permission;
    }

    /**
     * list permission array
     * @return array
     */

    public function listRoleArray() : array {
        $role = $this->role->all();
        $arrayData = new \stdClass();
        foreach ($role as $row) {
            $title = $row->name;
            $id = $row->id;
            $arrayData->{$id} = $title;
        }
        $arrayData = (array) $arrayData;
        return (array) $arrayData;
    }

    /**
     * update into database
     * @param int $id
     * @param array $request
     * @return object
     */
    public function updatePermission($request, $id) : object {
        $permission = $this->permission->find($id);
        $permission->update([
            'name' => $request->input('name'),
            'description' => $request->input('description')
        ]);
        $permission->syncRoles($request->input('role'));
        return $permission;
    }

    /**
     * delete into database
     * @param int $id
     * @return object
     */
    public function deletePermission($id) : bool {
        $permission = $this->permission->find($id);
        $permission = $permission->delete();
        return $permission;
    }
}
