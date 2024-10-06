<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Comment;
use App\Models\File;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Http\Request;

use function Termwind\render;

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
        if(!auth()->user()->hasPermission('task_create')){
            return response()->json(['status' => 'error','message' => 'You are not allowed to access this feature']);
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
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'type' => 'task',
            'related_id' => $task->id,
            'content' => 'Created a new task',
            'organization_id' => auth()->user()->organization->id
        ]);

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

        $task = Task::with('users','project','comments','files')->find($id);
        $assignees = User::with('role')->where('organization_id',auth()->user()->organization->id)->where('id','!=',auth()->user()->id)->where('status',1)->take(15)->get();
        $assignee_ids = $task->users->pluck('id')->toArray();
        return view('dashboard.tasks.edit', compact('task','assignees','assignee_ids'))->render();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!auth()->user()->hasPermission('task_edit')){
            return response()->json(['status' => 'error','message' => 'You are not allowed to access this feature']);
        }
        $request->validate([
            'title' => 'required',
            'due_date' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'project_id' => 'required',
        ]);

        $task = Task::find($id);
        $task->name = $request->title;
        $task->project_id = $request->project_id;
        $task->due_date = $request->due_date;
        $task->status = $request->status;
        $task->priority = $request->priority;
        $task->description = $request->description;
        $task->user_id = auth()->user()->id;
        $task->save();
        if($request->assignees){
            TaskUser::where('task_id',$task->id)->delete();
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
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if(!auth()->user()->hasPermission('task_delete')){
            return response()->json(['status' => 'error','message' => 'You are not allowed to access this feature']);
        }
        try{
            $task = Task::find($id);
            TaskUser::where('task_id',$task->id)->delete();
            Comment::where('task_id',$task->id)->delete();
            $files = File::where('task_id',$task->id)->get();
            foreach($files as $file){
                $path = public_path($file->path);
                if(file_exists($path)){
                    unlink($path);
                }
                $file->delete();
            }
            $task->delete();
            ActivityLog::create([
                'user_id' => auth()->user()->id,
                'type' => 'task',
                'related_id' => $task->id,
                'content' => 'Deleted a task '.$task->name,
                'organization_id' => auth()->user()->organization->id
            ]);
            return response()->json(['status' => 'success','message' => 'Task deleted successfully']);  
        }
         catch (\Throwable $th) {
            return response()->json(['status' => 'error','message' => $th->getMessage()]);
        }
    }

    public function add_assignees(Request $request)
    {
        $exist = TaskUser::where('task_id',$request->task_id)->where('user_id',$request->user_id)->first();
        if($exist){
            return response()->json(['status' => 'error','message' => 'User already added']);                               
        }
        $task = new TaskUser();
        $task->task_id = $request->task_id;
        $task->user_id = $request->user_id;
        $task->project_id = $request->project_id;
        $task->save();
        $user = User::find($request->user_id);
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'type' => 'task',
            'related_id' => $request->task_id,
            'content' => 'Assigned a user '.$user->name,
            'organization_id' => auth()->user()->organization->id
        ]);
        return response()->json(['status' => 'success','user'=>$user]);
    }
    public function change_priority(Request $request)
    {
        $task = Task::find($request->id);
        $task->priority = $request->priority;
        $task->save();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'type' => 'task',
            'related_id' => $task->id,
            'content' => 'Changed priority to '.formatText($request->priority),
            'organization_id' => auth()->user()->organization->id
        ]);
        return response()->json(['status' => 'success']);
    }

    public function change_status(Request $request)
    {
        $task = Task::find($request->id);
        $task->status = $request->status;
        $task->save();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'type' => 'task',
            'related_id' => $task->id,
            'content' => 'Changed status to '.formatText($request->status),
            'organization_id' => auth()->user()->organization->id
        ]);
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
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'type' => 'task',
            'related_id' => $id,
            'content' => 'Added a file '.$file_create->name,
            'organization_id' => auth()->user()->organization->id
        ]);

        return response()->json(['success' => $file_create->id]);
    }

    public function deleteFile(Request $request,$id){
        $file = File::find($id);
        $path = public_path($file->path);
        if(file_exists($path)){
            unlink($path);
        }
        $file->delete();
        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'type' => 'task',
            'related_id' => $id,
            'content' => 'Deleted a file '.$file->name,
            'organization_id' => auth()->user()->organization->id
        ]);
        return response()->json(['status' => 'success']);
    }
    public function updateDescription(Request $request,$id){
        $task = Task::find($id);
        $task->description = $request->description;
        $task->save();
        return response()->json(['status' => 'success','data'=>$task]);
    }
}
