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
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Blogs</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </div>
        </div>
        <div class="col-sm-6">
            <a href="{{ route('admin.blogs.index') }}" class="btn btn-primary float-end"><i class="mdi mdi-arrow-left me-1"></i> Back</a>
        </div>
    </div>
    <!-- end page title -->

    <form action="{{ route('admin.blogs.update' , $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <label for="title">Title</label>
                                <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="short_description">Short Description</label>
                                <textarea name="short_description" id="short_description" class="form-control">{{ $blog->description }}</textarea>
                                @error('short_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="content">Content</label>
                                <textarea name="content" id="content" class="form-control" value="Content">{{ $blog->content }}</textarea>
                                @error('content')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <h4 class="pt-3">SEO Information</h4>
                            <div class="col-md-12 mt-3">
                                <label for="meta_title">Meta Title</label>
                                <input type="meta_title" name="meta_title" id="meta_title" class="form-control" value="{{ $blog->meta_title }}">
                                @error('meta_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="meta_description">Meta Description</label>
                                <textarea name="meta_description" id="meta_description" class="form-control" >{{ $blog->meta_description }}</textarea>
                                @error('meta_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for="meta_keywords">Meta Keywords</label>
                                <input type="meta_keywords" name="meta_keywords" id="meta_keywords" class="form-control" value="{{ $blog->meta_keywords }}">
                                @error('meta_keywords')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <div class="col-md-12">
                            <label for="image">Featured Image</label>
                            <input type="file" name="image" id="image" class="form-control dropify" data-default-file="{{ asset('blogs').'/'.$blog->image }}">
                            @error('image')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="category">Category</label>
                            <select name="category_id" id="category" class="form-control">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ $category->id == $blog->category_id ? 'selected' : '' }}>{{ $category->title }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-3">
                            <label for="statusa">Status</label>
                            <select name="status" id="statusa" class="form-control">
                                <option value="1" {{ $blog->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $blog->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                            @error('status')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary float-end">Update</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>


@endSection

@section('script')
    
@endsection