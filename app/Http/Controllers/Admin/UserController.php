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

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'role' => 'required',
            'organization' => 'required'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role;
        $user->organization_id = $request->organization;
        if($request->hasFile('profile')){
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $image->move(public_path('avatars'), $filename);
            $user->avatar = $filename;
        }
        $user->save();
        return redirect()->route('admin.users.index',$user->role_id)->with('success', 'User created successfully.');
    }
    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::whereNotIn('id',[1])->get();
        $organizations = Organization::all();
        return view('admin.users.edit',compact('user','roles','organizations'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$id,
            'role' => 'required',
            'organization' => 'required'
        ]);
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->organization_id = $request->organization;
        if($request->hasFile('profile')){
            $old_avatar = $user->avatar;
            if(file_exists(public_path('avatars/'.$old_avatar))){
                unlink(public_path('avatars/'.$old_avatar));
            }
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $image->move(public_path('avatars'), $filename);
            $user->avatar = $filename;
        }
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->update();
        return redirect()->route('admin.users.index',$user->role_id)->with('success', 'User updated successfully.');
    }
    public function change_status(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $user->status == 0 ? 1 : 0;
        $user->save();
        return response()->json(['status' => 'success']);
    }
}
