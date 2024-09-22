<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\TeamDataTable;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(TeamDataTable $dataTable)
    {
        $roles = Role::where('id','!=',1)->get();
        return $dataTable->render('dashboard.team.index',compact('roles'));
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
        $count_members = User::where('organization_id',auth()->user()->organization->id)->count();
        if($count_members >= auth()->user()->subscription_plan()->max_users){
            return response()->json(['status' => 'error','message' => 'Your plan does not support more than '.auth()->user()->subscription_plan()->max_users.' users']);
        }

        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        $user->password = bcrypt($request->password);
        $user->organization_id = auth()->user()->organization->id;
        if($request->hasFile('profile')){
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $image->move(public_path('avatars'), $filename);
            $user->avatar = $filename;
        }
        $user->save();
        return response()->json(['status' => 'success']);
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'role' => 'required',
        ]);
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role_id = $request->role;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        if($request->hasFile('profile')){
            $image = $request->file('profile');
            $extension = $image->getClientOriginalExtension();
            $filename = time().'.'.$extension;
            $image->move(public_path('avatars'), $filename);
            $user->avatar = $filename;
        }
        $user->save();
        return response()->json(['status' => 'success']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function change_status(Request $request)
    {
        $user = User::findOrFail($request->id);
        $user->status = $user->status == 0 ? 1 : 0;
        $user->save();
        return response()->json(['status' => 'success']);
    }
}
