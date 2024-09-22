<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(UserDataTable $dataTable,$id)
    {
        $role = Role::find($id);
        return $dataTable->with('id',$id)->render('admin.users.index',compact('role'));
    }

    public function create($id)
    {
        $roles = Role::whereNotIn('id',[1,2])->get();
        $organizations = Organization::all();
        return view('admin.users.create',compact('id','roles','organizations'));
    }
    public function edit($slug,$id)
    {
        $user = User::find($id);
        return view('admin.users.edit',compact('user'));
    }
}
