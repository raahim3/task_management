<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function upload(Request $request)
    {
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $path = $image->store('images', 'public');
            $url = Storage::url($path);

            return response()->json(['url' => $url]);
        }

        return response()->json(['error' => 'Image upload failed'], 500);
    }

    public function delete(Request $request)
    {
        $src = $request->input('src');
        $filename = basename($src);

        if (Storage::disk('public')->exists('images/' . $filename)) {
            Storage::disk('public')->delete('images/' . $filename);
            return response()->json(['success' => true]);
        }

        return response()->json(['error' => 'Image deletion failed'], 500);
    }
}
