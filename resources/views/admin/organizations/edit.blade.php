@extends('layouts.admin')

@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>Plans</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Organizations</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('admin.organizations.index') }}" class="btn btn-primary float-end"><i class="mdi mdi-arrow-left me-1"></i> Back</a>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.organizations.update', $organization->id) }}" method="POST">
    @csrf
    @method('PUT')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Organization</h4>
                        <div class="row">
                            <div class="form-group col-md-6 mt-3">
                                <label for="org_name">Organization Name</label>
                                <input type="text" name="org_name" id="org_name" class="form-control" required value="{{ $organization->name }}">
                                @error('org_name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Edit Plan</h4>
                        <div class="row">
                            <div class="form-group col-md-6 mt-3">
                                <label for="name">Plan</label>
                                <select name="plan" class="form-control" id="plan">
                                    @foreach ($plans as $plan_item)
                                        <option value="{{ $plan_item->id }}" {{ $plan_item->id == $subscription->plan_id ? 'selected' : '' }}>{{ $plan_item->name }}</option>
                                    @endforeach
                                </select>
                                @error('plan')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div class="form-group col-md-6 mt-3">
                                <label for="max_users">No of Users</label>
                                <input type="number" name="max_users" id="max_users" class="form-control" required value="{{ $plan->max_users }}">
                                @error('max_users')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="max_projects">No of Projects</label>
                                <input type="number" name="max_projects" id="no_of_projects" class="form-control" required value="{{ $plan->max_projects }}">
                                @error('max_projects')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div class="form-group col-md-6 mt-3">
                                <label for="max_tasks">No of Task <small>(Each Project)</small></label>
                                <input type="number" name="max_tasks" id="max_tasks" class="form-control" required value="{{ $plan->max_tasks }}">
                                @error('max_tasks')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="start_date">Start Date</label>
                                <input type="date" name="start_date" id="start_date" class="form-control" required value="{{ $subscription->start_date }}">
                                @error('start_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="end_date">End Date</label>
                                <input type="date" name="end_date" id="end_date" class="form-control" required value="{{ $subscription->end_date }}">
                                @error('end_date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
    
                            <div class="form-group col-md-12 mt-3 text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>

@endSection