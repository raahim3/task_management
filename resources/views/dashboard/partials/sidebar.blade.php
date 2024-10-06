<div class="sidebar">
    <div class="site-width">
        <!-- START: Menu-->
        <ul id="side-menu" class="sidebar-menu">
            <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <a href="{{ url('dashboard') }}" wire:navigate><i class="icon-home mr-1"></i> Dashboard</a>                  
            </li>
            @if(auth()->user()->hasPermission('team_read'))
            <li class="{{ request()->routeIs('team') ? 'active' : '' }}">
                <a href="{{ route('team.index') }}" wire:navigate><i class="icon-user mr-1"></i> Team</a>                  
            </li>
            @endif
            <li class="dropdown">
                <div class="d-flex justify-content-between a_alternative align-items-center">
                    <a href="{{ route('project.index') }}" wire:navigate style="pointer-events: auto !important"><i class="icon-grid mr-1"></i> Projects</a>
                    @if(auth()->user()->hasPermission('project_create'))
                        <a class="dropdown-toggle dropdown-toggle-split hide_drop_icon create_project_icon" style="pointer-events: auto !important" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="icon-plus"></i>
                        </a>
                        <div class="dropdown-menu p-0">
                            <a class="dropdown-item event_auto " href="{{ route('project.create') }}" wire:navigate><i class="icon-plus mr-2"></i> Add Project</a>
                        </div> 
                    @endif               
                </div>
                <ul>
                    @php
                        if(auth()->user()->role_id == 2){
                            $projects = App\Models\Projects::where('organization_id', auth()->user()->organization_id)->latest()->get();
                        }else{
                            $assign_projects_ids = App\Models\ProjectUser::where('user_id',auth()->user()->id)->pluck('project_id')->toArray();
                            $projects = App\Models\Projects::whereIn('id',$assign_projects_ids)->latest()->get();
                        }
                    @endphp
                    @foreach ($projects as $project)
                        <li class="{{ Request::is('dashboard') ? 'active' : '' }}"><a href="{{ route('project.show', $project->id) }}" wire:navigate class="project_a"><i class="project_icon" style="background-color: {{ $project->color }} "></i> {{ substr($project->name,0,22) }}</a></li>
                    @endforeach
                </ul>
            </li>
            
        </ul>
        <!-- END: Menu-->
        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ml-auto">
            <li class="breadcrumb-item"><a href="#">{{ $settings->title }}</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </div>
</div>




{{-- 
<div class="vertical-menu">
    
    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>

                <li class="{{ Request::is('dashboard') ? 'mm-active' : '' }}">
                    <a href="{{ url('dashboard') }}"  wire:navigate class="waves-effect {{ Request::is('dashboard') ? 'active' : '' }}">
                        <i class="mdi mdi-view-dashboard"></i>
                        <span class="badge rounded-pill bg-primary float-end">2</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                @if(auth()->user()->role_id == 2)
                <li class="{{ Request::is('team') ? 'mm-active' : '' }}">
                    <a href="{{ route('team.index') }}" wire:navigate class=" waves-effect {{ Request::is('team') ? 'active' : '' }}">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>Team</span>
                    </a>
                </li>
                @endif

                <li class="{{ Request::is('project') ? 'mm-active' : '' }}">
                    <a href="{{ route('project.index') }}" wire:navigate class=" waves-effect{{ Request::is('project') ? 'active' : '' }}">
                        <i class="mdi mdi-calendar-check"></i>
                        <span>Projects</span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div> --}}