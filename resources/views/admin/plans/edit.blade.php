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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Plans</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('admin.plans.index') }}" class="btn btn-primary float-end"><i class="mdi mdi-arrow-left me-1"></i> Back</a>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Plan</h4>
                    <form action="{{ route('admin.plans.update', $plan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="form-group col-md-6 mt-3">
                                <label for="name">Name</label>
                                <input type="text" name="name" id="name" class="form-control" required value="{{ $plan->name }}">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-6 mt-3">
                                <label for="monthly_price">Monthly Price</label>
                                <input type="text" name="monthly_price" id="monthly_price" class="form-control" required value="{{ $plan->monthly_price }}">
                                @error('monthly_price')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group col-md-6 mt-3">
                                <label for="yearly_price">Yearly Price</label>
                                <input type="text" name="yearly_price" id="yearly_price" class="form-control" required value="{{ $plan->yearly_price }}">
                                @error('yearly_price')
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
                                <label for="statuss">Status</label>
                                <select name="status" id="statuss" class="form-control">
                                    <option value="1" @if($plan->status == 1) selected @endif>Active</option>
                                    <option value="0" @if($plan->status == 0) selected @endif>Inactive</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group col-md-12 mt-3 text-end">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

@endSection