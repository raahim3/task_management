<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\BlogDataTable;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(BlogDataTable $dataTable)
    {
        return $dataTable->render('admin.blogs.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['categories'] = Category::all();
        return view('admin.blogs.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'short_description' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ]);

        $blog = new Blog();
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->short_description;
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;
        $blog->meta_title = $request->meta_title;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_description = $request->meta_description;
        $blog->status = 1;
        $blog->user_id = auth()->user()->id;
        $file = $request->file('image');
        $filename = rand().$file->getClientOriginalName();
        $file->move(public_path('blogs'), $filename);
        $blog->image = $filename;
        $blog->save();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['blog'] = Blog::find($id);
        $data['categories'] = Category::all();
        return view('admin.blogs.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'short_description' => 'required',
            'meta_title' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'status' => 'required'
        ]);

        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->slug = Str::slug($request->title);
        $blog->description = $request->short_description;
        $blog->content = $request->content;
        $blog->category_id = $request->category_id;
        $blog->meta_title = $request->meta_title;
        $blog->meta_keywords = $request->meta_keywords;
        $blog->meta_description = $request->meta_description;
        $blog->status = $request->status;
        if($request->hasFile('image')) {
            $path = public_path("blogs/").$blog->image;
            if($path){
                File::delete($path);
            }
            $img = $request->file('image');
            $ext = rand().".".$img->getClientOriginalName();
            $img->move("public/blogs/",$ext);
            $blog->image = $ext;
        }
        $blog->update();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::find($id);
        $path = public_path("blogs/").$blog->image;
        if($path){
            File::delete($path);
        }
        $blog->delete();
        return redirect()->route('admin.blogs.index')->with('success', 'Blog deleted successfully.');
    }
}
