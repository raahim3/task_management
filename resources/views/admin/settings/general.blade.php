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
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Settings</a></li>
                        <li class="breadcrumb-item active">General Settings</li>
                    </ol>
                </div>
            </div>
            <div class="col-sm-6">
                <a href="{{ route('admin.index') }}" class="btn btn-primary float-end"><i class="mdi mdi-arrow-left me-1"></i> Back</a>
            </div>
        </div>
        <!-- end page title -->
    </div>
    <form action="{{ route('admin.settings.general') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title mb-2 pb-2 border-bottom">General Settings</h4>
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" name="title" id="title" class="form-control" required value="{{ $settings->title }}">
                            @error('title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="description">Description</label>
                            <textarea name="description" id="description" class="form-control" required >{{ $settings->description }}</textarea>
                            @error('description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="address">Address</label>
                            <input type="address" name="address" id="address" class="form-control" required value="{{ $settings->address }}">
                            @error('address')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" class="form-control" required value="{{ $settings->email }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="contact">Phone</label>
                            <input type="text" name="contact" id="contact" class="form-control" required value="{{ $settings->contact }}">
                            @error('contact')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="footer_text">Copyright Text</label>
                            <input type="footer_text" name="footer_text" id="footer_text" class="form-control" required value="{{ $settings->footer_text }}">
                            @error('footer_text')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <h4 class="card-title py-2 my-2 border-bottom">SEO Settings</h4>
                        <div class="form-group mt-3">
                            <label for="meta_title">Meta Title</label>
                            <input type="text" name="meta_title" id="meta_title" class="form-control" required value="{{ $settings->meta_title }}">
                            @error('meta_title')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" id="meta_description" class="form-control" required >{{ $settings->meta_description }}</textarea>
                            @error('meta_description')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="keywords">Keywords</label>
                            <input type="keywords" name="keywords" id="keywords" class="form-control" required value="{{ $settings->keywords }}">
                            @error('keywords')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="light_logo">Light Logo</label>
                            <input type="file" name="light_logo" id="light_logo" class="form-control dropify" value="" data-default-file="{{ asset('settings').'/'. $settings->light_logo }}">
                            @error('light_logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="dark_logo">Dark Logo</label>
                            <input type="file" name="dark_logo" id="dark_logo" class="form-control dropify" value="" data-default-file="{{ asset('settings').'/'. $settings->dark_logo }}">
                            @error('dark_logo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group mt-3">
                            <label for="favicon">Favicon</label>
                            <input type="file" name="favicon" id="favicon" class="form-control dropify" value="" data-default-file="{{ asset('settings').'/'. $settings->favicon }}">
                            @error('favicon')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary mt-3">Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection