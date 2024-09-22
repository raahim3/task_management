<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\General;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function general(Request $request)
    {
        if($request->isMethod('post'))
        {
            $request->validate([
                'title' => 'required',
                'description' => 'required',
                'meta_title' => 'required',
                'meta_description' => 'required',
                'keywords' => 'required',
                'footer_text' => 'required',
            ]);
            $general = General::first();
            $general->title = $request->title;
            $general->description = $request->description;
            $general->address = $request->address;
            $general->email = $request->email;
            $general->contact = $request->contact;
            $general->meta_title = $request->meta_title;
            $general->meta_description = $request->meta_description;
            $general->keywords = $request->keywords;
            $general->footer_text = $request->footer_text;
            if($request->hasFile('light_logo')){
                $file = $request->file('light_logo');
                $filename = $file->getClientOriginalName();
                $file->move('settings', $filename);
                $general->light_logo = $filename;
            }
            if($request->hasFile('dark_logo')){
                $file = $request->file('dark_logo');
                $filename = $file->getClientOriginalName();
                $file->move('settings', $filename);
                $general->dark_logo = $filename;
            }
            if($request->hasFile('favicon')){
                $file = $request->file('favicon');
                $filename = $file->getClientOriginalName();
                $file->move('settings', $filename);
                $general->favicon = $filename;
            }
            $general->update();
            return redirect()->back()->with('success', 'Settings updated successfully');
        }
        return view('admin.settings.general');
    }
}
