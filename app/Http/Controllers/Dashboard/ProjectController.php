<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\ProjectsDataTable;
use App\DataTables\ProjectTaskDataTable;
use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Comment;
use App\Models\Discussion;
use App\Models\PrivateNote;
use Illuminate\Http\Request;
use App\Models\Projects;
use App\Models\ProjectUser;
use App\Models\Task;
use App\Models\TaskUser;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ProjectsDataTable $dataTable)
    {
        if(!auth()->user()->hasPermission('project_read')){
            return redirect()->route('home')->with('error', 'You are not authorized to access this page');
        }
        return $dataTable->render('dashboard.projects.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!auth()->user()->hasPermission('project_create')){
            return redirect()->route('home')->with('error', 'You are not authorized to access this page');
        }
        return view('dashboard.projects.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if(!auth()->user()->hasPermission('project_create')){
            return response()->json(['status' => 'error','message' => 'You are not authorized to access this page']);
        }
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

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'type' => 'project',
            'related_id' => $project->id,
            'content' => 'Created a new project',
            'organization_id' => auth()->user()->organization->id
        ]);
        return response()->json(['status' => 'success']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(!auth()->user()->hasPermission('project_read')){
            return redirect()->route('home')->with('error', 'You are not authorized to access this page');
        }
        $project = Projects::with('tasks')->findOrFail($id);
        $assignees = User::with('role')->where('organization_id',auth()->user()->organization->id)->where('id','!=',auth()->user()->id)->where('status',1)->take(15)->get();
        return view('dashboard.projects.show', compact('project','assignees'));
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if(!auth()->user()->hasPermission('project_edit')){
            return response()->json(['status' => 'error','message' => 'You are not allowed to access this feature']);
        }
        $project = Projects::find($id);
        $users = User::with('role')->where('organization_id',auth()->user()->organization->id)->where('id','!=',auth()->user()->id)->where('status',1)->take(15)->get();
        $assign_ids = $project->users->pluck('id')->toArray();
        return view('dashboard.projects.edit', compact('project','users','assign_ids'))->render();

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if(!auth()->user()->hasPermission('project_edit')){
            return response()->json(['status' => 'error','message' => 'You are not authorized to access this page']);
        }
        $request->validate([
            'name' => 'required',
            'color' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required'
        ]);
        $project = Projects::find($id);
        $project->name = $request->name;
        $project->slug = Str::slug($request->name);
        $project->color = $request->color;
        $project->start_date = $request->start_date;
        $project->end_date = $request->end_date;
        $project->status = $request->status;
        $project->description = $request->description;
        $project->update();
        if($request->assignees){
            ProjectUser::where('project_id',$project->id)->delete();
            foreach ($request->assignees as $key => $assignee) {
                $exist = ProjectUser::where('project_id',$project->id)->where('user_id',$assignee)->first();
                if(!$exist){
                    $project = new ProjectUser();
                    $project->project_id = $id;
                    $project->user_id = $assignee;
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
        if(!auth()->user()->hasPermission('project_delete')){
            return response()->json(['status' => 'error','message' => 'You are not allowed to access this feature']);
        }

        try {
            $project = Projects::find($id);

            if ($project) {
                ProjectUser::where('project_id', $id)->delete();
                $tasks = Task::where('project_id', $id)->with('files')->get();

                foreach ($tasks as $task) {
                    TaskUser::where('task_id', $task->id)->delete();
                    
                    Comment::where('task_id', $task->id)->delete();
                    
                    foreach ($task->files as $file) {
                        $path = public_path($file->path);
                        if (file_exists($path)) {
                            unlink($path);
                        }
                        $file->delete();
                    }

                    $task->delete();
                }

                $project->delete();

                ActivityLog::create([
                    'user_id' => auth()->user()->id,
                    'type' => 'project',
                    'related_id' => $project->id,
                    'content' => 'Deleted project ' . $project->name,
                    'organization_id' => auth()->user()->organization->id
                ]);
                return response()->json(['status' => 'success', 'message' => 'Project deleted successfully']);
            }

            return response()->json(['status' => 'error', 'message' => 'Project not found']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error','message' => $th->getMessage()]);
        }
    }

    public function change_status(Request $request)
    {
        if(!auth()->user()->hasPermission('project_edit')){
            return response()->json(['status' => 'error','message' => 'You are not authorized to access this feature']);
        }
        $project = Projects::find($request->id);
        $project->status = $request->status;
        $project->save();

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'type' => 'project',
            'related_id' => $project->id,
            'content' => 'Changed project status to ' . formatText($request->status),
            'organization_id' => auth()->user()->organization->id
        ]);
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

        ActivityLog::create([
            'user_id' => auth()->user()->id,
            'type' => 'project',
            'related_id' => $project->project_id,
            'content' => 'Project assigned to ' . $user->name,
            'organization_id' => auth()->user()->organization->id
        ]);
        return response()->json(['status' => 'success','user'=>$user]);
    }
    public function tasks(string $id, ProjectTaskDataTable $dataTable)
    {
        if(!auth()->user()->hasPermission('project_read')){
            return redirect()->route('home')->with('error', 'You are not authorized to access this page');
        }
        if(!auth()->user()->hasPermission('task_read')){
            return redirect()->route('home')->with('error', 'You are not authorized to access this page');
        }
        $project = Projects::findOrFail($id);
        $assignees = User::with('role')->where('organization_id',auth()->user()->organization->id)->where('id','!=',auth()->user()->id)->where('status',1)->take(15)->get();
        return $dataTable->with('project_id', $id)->render('dashboard.projects.task', compact('project','assignees'));
    }
    public function private_note(string $id)
    {
        if(!auth()->user()->hasPermission('project_read')){
            return redirect()->route('home')->with('error', 'You are not authorized to access this page');
        }
        $project = Projects::findOrFail($id);
        $note = PrivateNote::where('user_id',auth()->user()->id)->where('project_id',$id)->first();
        return view('dashboard.projects.private_notes', compact('project','note'));
    }
    public function private_note_save(Request $request)
    {
        $note = PrivateNote::where('user_id',auth()->user()->id)->where('project_id',$request->project_id)->first();
        if(!$note)
        {
            $note = new PrivateNote();
        }
        $note->project_id = $request->project_id;
        $note->user_id = auth()->user()->id;
        $note->content = $request->content;
        $note->save();
        return response()->json(['status'=>'success']);
    }
    

    public function discussions($id)
    {
        $project = Projects::findOrFail($id);
        return view('dashboard.projects.discussion',compact('project'));
    }

    public function image_upload(Request $request)
    {
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('uploads', $filename, 'public');
    
            return response()->json(['success' => true, 'url' => asset('storage/' . $path),'path' => $path]);
        }
    
        return response()->json(['success' => false], 400);
    }

    public function image_delete(Request $request)
    {
        $filePath = $request->input('path'); // Assuming the file path is sent via the request
        if (Storage::disk('public')->exists($filePath)) {
            Storage::disk('public')->delete($filePath);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 404);
    }

    public function message_store(Request $request)
    {
        $message = new Discussion();
        $message->project_id = $request->project_id;
        $message->user_id = auth()->user()->id;
        $message->content = $request->message;
        $message->save();
        return response()->json(['status' => 'success','message' => $message]);
    }

    public function messages(Request $request)
    {
        $chats = Discussion::with('user')->where('project_id',$request->project_id)->get();
        return view('dashboard.components.chats',compact('chats'))->render();
    }
}
