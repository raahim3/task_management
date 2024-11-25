<ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('project.show') ? 'active' : '' }}" href="{{ route('project.show', $project->id) }}" wire:navigate>Overview</a>
    </li>
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('project.tasks') ? 'active' : '' }}" href="{{ route('project.tasks', $project->id) }}"  wire:navigate>Tasks</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('project.discussion') ? 'active' : '' }}" href="{{ route('project.discussion', $project->id) }}"  wire:navigate>Discussions</a>
    </li>
    <li class="nav-item">
      <a wire:navigate class="nav-link {{ request()->routeIs('project.private.notes') ? 'active' : '' }}" href="{{ route('project.private.notes', $project->id) }}">Personal Notes</a>
    </li>
</ul>

