<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\Projects;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['total_projects'] = Projects::where('organization_id',auth()->user()->organization->id)->count();
        $data['total_users'] = User::where('organization_id',auth()->user()->organization->id)->count();
        return view('home',$data);
    }

    public function activities()
    {
        $userId = auth()->id(); 
        if(auth()->user()->role_id == 2){
            $activities = ActivityLog::where('organization_id',auth()->user()->organization->id)->orderBy('created_at', 'desc')->take(20)->get();
        }
        else{
            $activities = ActivityLog::whereHas('project.users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orWhereHas('task.users', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();
        }
        

        return view('dashboard.activities', compact('activities'))->render();
    }

    public function search(Request $request)
    {
        $search = $request->input('search');
        $tasks = Task::with('project')->where('name', 'like', '%' . $search . '%')->get();
        $projects = Projects::where('name', 'like', '%' . $search . '%')->get();

        $html = '';
        foreach ($tasks as $task) {
            $html .= '<li class="list-group-item">
                            <a href="'. route('project.tasks' ,$task->project->id) .'" wire:navigate>'.$task->name.' <small>(Task)<small></a>
                        </li>';
        }
        foreach ($projects as $project) {
            $html .= '<li class="list-group-item">
                            <a href="'. route("project.show",$project->id) .'" wire:navigate>'.$project->name.' <small>(Project)<small></a>
                        </li>';
        }
        return response()->json(['html' => $html]);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $path = $image->store('images', 'public');
            $url = Storage::url($path);

            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'Image upload failed'], 500);
    }

    public function delete(Request $request)
    {
        $src = $request->input('src');
        $filename = basename($src);

        if (Storage::disk('public')->exists('images/' . $filename)) {
            Storage::disk('public')->delete('images/' . $filename);
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Image deletion failed'], 500);
    }
}
