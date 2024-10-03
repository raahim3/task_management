@extends('layouts.dashboard')

@section('content')

<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">                               
                <h4 class="card-title">Project : <a href="javascript:void(0)" class="text-primary">#{{ $project->name }}</a></h4>
                @if (auth()->user()->hasPermission('task_create'))
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#createTask"><i class="icon-plus"></i> Task</a>
                @endif
            </div>
            <div class="card-body">
                <div class="mb-3">
                    @include('dashboard.projects.nav')
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Project Overview
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-6">
                                        <strong>Project Name : </strong>
                                        <p>{{ $project->name }}</p>
                                    </div>
                                    <div class="col-6">
                                        <strong>Status : </strong>
                                        <p>{{ formatText($project->status) }}</p>
                                    </div>
                                    <div class="col-6">
                                        <strong>Start Date : </strong>
                                        <p>{{ formatDate($project->start_date) }}</p>
                                    </div>
                                    <div class="col-6">
                                        <strong>Deadline : </strong>
                                        <p>{{ formatDate($project->end_date) }}</p>
                                    </div>
                                    <div class="col-12">
                                        <strong>Description : </strong>
                                        <p>{!! $project->description !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <p class="m-0">Task Overview </p>
                                <strong>Total Tasks : {{ $project->tasks()->count() }}</strong>
                            </div>
                            <div class="card-body">
                                <div id="donut-graph"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endSection
@section('script')
    
    <script>
        if ($('#donut-graph').length > 0)
    {
        Morris.Donut({
            element: 'donut-graph',
            data: [
                {value: "{{ $project->tasks()->where('status','done')->count() }}", label: 'Completed Task'},
                {value: "{{ $project->tasks()->where('status','in_progress')->count() }}", label: 'In Progress Tasks'},
                {value: "{{ $project->tasks()->where('status','todo')->count() }}", label: 'Todo Tasks'},
                {value: "{{ $project->tasks()->where('status','review')->count() }}", label: 'Review Tasks'}
            ],
            backgroundColor: '#000',
            labelColor: '#1e3d73',
            colors: [
                '#1e3d73',
                '#25b8d6',
                '#2397af',
                '#6bbdce'
            ]
        });
    }
    </script>
@endsection
