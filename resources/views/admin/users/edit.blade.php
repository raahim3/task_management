@extends('layouts.admin')

@section('admin')

<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-sm-6">
            <div class="page-title-box">
                <h4>Edit</h4>
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Users</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end page title -->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="name">Profile <small>(Optional)</small></label>
                                <input type="file" class="form-control dropify" name="profile" id="profile" data-default-file="{{ asset('avatars').'/'. $user->avatar }}">
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" name="name" id="name" value="{{ $user->name }}" required="">
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" name="email" id="email" value="{{ $user->email }}" required="">
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="role">Role</label>
                                <select class="form-control" name="role" id="role" required="" @if($user->role_id == 2) disabled @endif>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}" @if($role->id == $user->role_id) selected @endif   @if($role->id == 2) disabled @endif>{{ $role->name }}</option>
                                    @endforeach
                                </select>
                                @error('role')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 mt-3">
                                <label for="Organization">Organization</label>
                                <select class="form-control" name="organization" id="Organization" required=""  @if($user->role_id == 2) disabled @endif>
                                    @foreach ($organizations as $organization)
                                        <option value="{{ $organization->id }}" @if($organization->id == $user->organization_id) selected @endif >{{ $organization->name }}</option>
                                    @endforeach
                                </select>
                                @error('organization')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Enter Password" autocomplete="new-password">
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="d-flex justify-content-end mt-3">
                                <button class="btn btn-primary" type="submit">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end col -->
    </div>

</div>


@endSection