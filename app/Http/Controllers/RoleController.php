<?php

namespace App\Http\Controllers;

use App\Models\RoleHasPermission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
// use Spatie\Permission\Contracts\Permission;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{
    public function view()
    {
       
        return view('task.updateRole');
    }
    public function list(){
        $roles = Role::get();
        return DataTables::of($roles)
        ->addColumn('Id', function($roles){
            return $roles->id;
        })
        ->addColumn('Roles',function($roles){
            return $roles->name;
        })
        ->addColumn('Action',function($roles){
            $edit = '<a href="'  .route('edit_role',$roles->id). '" class="btn btn-warning" role="button">Update</a>';
            $delete = '<a href="'  . '" class="btn btn-danger" role="button">Delete</a>';
            return $edit. ' ' .$delete;
        })
        ->rawColumns(['id', 'roles', 'Action'])
        ->make(true);
    }
    public function edit_role(Request $request)
    {
        $id = $request->id;
        $roles = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
      

        return view('RoleManage.edit', compact('roles','permissions','rolePermissions'));
    }
        public function store_role(Request $request)
    {
        $permissionNames = $request->input('permissions', []);
        $permissionIds = $request->input('permission_ids', []);

        foreach ($permissionIds as $key => $permissionId) {
            $role = new RoleHasPermission();
            $role->role_id = $request->id;
            $role->permission_id = $permissionId;
            $role->save();
        }

        return redirect()->route('view');
    }


}
