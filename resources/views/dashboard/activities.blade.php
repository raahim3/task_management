@foreach ($activities as $activity)
    <li class="activity py-2 border-left">
        <div class="activity-absolute">
            <img src="{{ $activity->user->avatar ? asset('avatars/'.$activity->user->avatar) : asset('default-avatar.webp') }}" alt="author" width="50" class="rounded-circle position-absolute ml-35">
        </div>
        <p> 
            <span class="text-primary font-weight-bold">{{ $activity->user->name }}</span><br>
            <span class="text-muted">{{ $activity->created_at->diffForHumans() }}</span><br>
            <span>{!! $activity->content !!}</span><br>
            @if($activity->type == 'project' && $activity->project)
                <a href="{{ route('project.show', $activity->project->id) }}"><b>#{{ $activity->project->name }}</b></a>
            @elseif($activity->type == 'task' && $activity->task)
                <a href="#" class="show_task" data-id="{{ $activity->task->id }}" ><b>#{{ $activity->task->name }}</b></a>
            @else
                <span>No related project/task found</span>
            @endif
        </p> 
    </li>
@endforeach