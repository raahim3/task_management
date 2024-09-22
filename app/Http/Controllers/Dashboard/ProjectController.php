<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ProjectsDataTable;
use App\DataTables\ProjectTaskDataTable;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Models\User;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProjectsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $count_projects = Projects::where('organization_id',auth()->user()->organization->id)->count();
        if($count_projects >= auth()->user()->subscription_plan()->max_projects){
            return response()->json(['status' => 'error','message' => 'Your plan does not support more than '.auth()->user()->subscription_plan()->max_projects.' projects']);
        }
        $request->validate([
            'project_name' => 'required',
            'color' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $project = new Projects();
        $project->name = $request->project_name;
        $project->slug = Str::slug($request->project_name);
        $project->color = $request->color;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->user_id = auth()->user()->id;
        $project->organization_id = auth()->user()->organization->id;
        $project->save();
        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, ProjectTaskDataTable $dataTable)
    {
        $project = Projects::findOrFail($id);
        $assignees = User::with('role')->where('organization_id',auth()->user()->organization->id)->where('id','!=',auth()->user()->id)->where('status',1)->take(15)->get();
        return $dataTable->with('project_id', $id)->render('dashboard.projects.show', compact('project','assignees'));
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

    public function change_status(Request $request)
    {
        $project = Projects::find($request->id);
        $project->status = $request->status;
        $project->save();
        return response()->json(['status' => 'success','data' => $project]);
    } 

    public function get_assignees(Request $request)
    {
        if($request->type == 'project'){
            $project = Projects::find($request->id);
            $users = User::with('role')->where('organization_id',auth()->user()->organization->id)->where('id','!=',auth()->user()->id)->where('status',1)->take(15)->get();
        }else if($request->type == 'task')
        {
            $task = Task::with('project')->find($request->id);
            $project = $task->project;
            $assign_project_users = ProjectUser::where('project_id',$project->id)->pluck('user_id')->toArray();
            $users = User::with('role')
            ->whereIn('id',$assign_project_users)
            ->where('id','!=',auth()->user()->id)
            ->where('status',1)->take(15)->get();
        }
        return response()->json(['status' => 'success','users' => $users , 'project' => $project]);
    }

    public function search_assignees(Request $request)
    { 
        $users = User::with('role')->where('organization_id',auth()->user()->organization->id)->where('id','!=',auth()->user()->id)->where('name','like','%'.$request->value.'%')->where('status',1)->take(15)->get();
        return response()->json(['status' => 'success','users' => $users]);
    }

    public function add_assignees(Request $request)
    {
        $exist = ProjectUser::where('project_id',$request->project_id)->where('user_id',$request->user_id)->first();
        if($exist){
            return response()->json(['status' => 'error','message' => 'User already added']);                               
        }
        $project = new ProjectUser();
        $project->project_id = $request->project_id;
        $project->user_id = $request->user_id;
        $project->save();
        $user = User::find($request->user_id);
        return response()->json(['status' => 'success','user'=>$user]);
    }
}
