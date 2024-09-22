<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $count_task = Task::where('project_id',$request->project_id)->count();
        if($count_task >= auth()->user()->subscription_plan()->max_tasks){
            return response()->json(['status' => 'error','message' => 'Your plan does not support more than '.auth()->user()->subscription_plan()->max_tasks.' tasks in a project']);
        }
        $request->validate([
            'title' => 'required',
            'due_date' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'project_id' => 'required',
        ]);

        $task = new Task();
        $task->name = $request->title;
        $task->project_id = $request->project_id;
        $task->due_date = $request->due_date;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->description = $request->description;
        $task->user_id = auth()->user()->id;
        $task->save();
        if($request->assignees){
            foreach ($request->assignees as $key => $assignee) {
                $exist = TaskUser::where('task_id',$task->id)->where('user_id',$assignee)->first();
                if(!$exist){
                    $project = new TaskUser();
                    $project->task_id = $task->id;
                    $project->user_id = $assignee;
                    $project->project_id = $request->project_id;
                    $project->save();                              
                }
            }
        }

        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::with('users','project','comments','files')->find($id);
        return view('task.task_modal', compact('task'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function add_assignees(Request $request)
    {
        $exist = TaskUser::where('task_id',$request->task_id)->where('user_id',$request->user_id)->first();
        if($exist){
            return response()->json(['status' => 'error','message' => 'User already added']);                               
        }
        $project = new TaskUser();
        $project->task_id = $request->task_id;
        $project->user_id = $request->user_id;
        $project->project_id = $request->project_id;
        $project->save();
        $user = User::find($request->user_id);
        return response()->json(['status' => 'success','user'=>$user]);
    }
    public function change_priority(Request $request)
    {
        $task = Task::find($request->id);
        $task->priority = $request->priority;
        $task->save();
        return response()->json(['status' => 'success']);
    }

    public function change_status(Request $request)
    {
        $task = Task::find($request->id);
        $task->status = $request->status;
        $task->save();
        return response()->json(['status' => 'success']);
    }
    public function uploadFile(Request $request,$id){
        $request->validate([
            'file' => 'required',
        ]);
        $file = $request->file('file');
        $filename = time().'.'. $file->getClientOriginalExtension();
        $file->move(public_path('uploads'), $filename);
        $mimeType = $file->getClientMimeType();
        $generalType = explode('/', $mimeType)[0];
        $file_create = new File();
        $file_create->task_id = $id;
        $file_create->user_id = auth()->user()->id;
        $file_create->name = $filename;
        $file_create->path = 'uploads/' . $filename;
        $file_create->file_type = $generalType;
        $file_create->save();

        return response()->json(['success' => $file_create->id]);
    }

    public function deleteFile(Request $request,$id){
        $file = File::find($id);
        $path = public_path($file->path);
        if(file_exists($path)){
            unlink($path);
        }
        $file->delete();
        return response()->json(['status' => 'success']);
    }
    public function updateDescription(Request $request,$id){
        $task = Task::find($id);
        $task->description = $request->description;
        $task->save();
        return response()->json(['status' => 'success','data'=>$task]);
    }
}
