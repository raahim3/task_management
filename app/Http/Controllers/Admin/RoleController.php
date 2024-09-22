<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\RoleDataTable;
use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RoleDataTable $dataTable)
    {
        return $dataTable->render('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function permissions(string $id,Request $request)
    {
        $role = Role::find($id);

        $permission = Permission::where('role_id',$id)->first();
        $all_permissions = $permission ? json_decode($permission->permissions) : [];
        if($request->isMethod('post')){

            $permissions = [];
            foreach ($request->all() as $key => $value) {
                if($key != "_token"){
                    array_push($permissions, $key);
                }
            }
            $permissions = json_encode($permissions);
            if($permission){
                $permission->permissions = $permissions;
                $permission->update();
            }else{
                $permission = new Permission();
                $permission->role_id = $id;
                $permission->permissions = $permissions;
                $permission->save();
            }
            return redirect()->back()->with('success','Permissions updated successfully');  
        }
        return view('admin.roles.permissions', compact('role','permission','all_permissions'));
    }
}
