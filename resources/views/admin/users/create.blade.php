@extends('layouts.admin')

@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>Create</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="name">Profile <small>(Optional)</small></label>
                            <input type="file" class="form-control dropify" name="profile" id="profile">
                        </div>
                        <div class="form-group col-md-12 mt-3">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" name="name" id="name" placeholder="Enter Name" required="">
                        </div>
                        <div class="form-group col-md-12 mt-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter Email" required="">
                        </div>
                        <div class="form-group col-md-12 mt-3">
                            <label for="role">Role</label>
                            <select class="form-control" name="role" id="role" required="">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}" @if($role->id == $id) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12 mt-3">
                            <label for="Organization">Organization</label>
                            <select class="form-control" name="Organization" id="Organization" required="">
                                @foreach ($organizations as $organization)
                                    <option value="{{ $organization->id }}" >{{ $organization->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12 mt-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" required="" autocomplete="new-password">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

</div>

@endSection

@section('script')
    
@endsection