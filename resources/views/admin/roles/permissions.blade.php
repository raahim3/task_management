@extends('layouts.admin')

@section('admin')
<style>
    .permission-table thead tr th {
        text-align: center;
    }
    .permission-table tr td {
        text-align: center;
    }
</style>
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>Permissions</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Roles</a></li>
                    <li class="breadcrumb-item active">Permissions</li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-primary float-end"><i class="mdi mdi-arrow-left me-1"></i> Back</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.roles.permissions', $role->id) }}" method="post">
                @csrf
                <div class="table-responsive">
                    <table class="table table-bordered permission-table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Read</th>
                                <th>Create</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tr>
                            <th>Team</th>
                            <td><input type="checkbox" name="team_read" value="1" {{ in_array('team_read',$all_permissions) ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="team_create" value="1" {{ in_array('team_create',$all_permissions) ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="team_edit" value="1" {{ in_array('team_edit',$all_permissions) ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="team_delete" value="1" {{ in_array('team_delete',$all_permissions) ? 'checked' : '' }}></td>
                        </tr>
                        <tr>
                            <th>Project</th>
                            <td><input type="checkbox" name="project_read" value="1" {{ in_array('project_read',$all_permissions) ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="project_create" value="1" {{ in_array('project_create',$all_permissions) ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="project_edit" value="1" {{ in_array('project_edit',$all_permissions) ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="project_delete" value="1" {{ in_array('project_delete',$all_permissions) ? 'checked' : '' }}></td>
                        </tr>
                        <tr>
                            <th>Task</th>
                            <td><input type="checkbox" name="task_read" value="1" {{ in_array('task_read',$all_permissions) ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="task_create" value="1" {{ in_array('task_create',$all_permissions) ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="task_edit" value="1" {{ in_array('task_edit',$all_permissions) ? 'checked' : '' }}></td>
                            <td><input type="checkbox" name="task_delete" value="1" {{ in_array('task_delete',$all_permissions) ? 'checked' : '' }}></td>
                        </tr>
                    </table>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection