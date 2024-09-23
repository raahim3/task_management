<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\SectionDataTable;
use App\Http\Controllers\Controller;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    public function index(SectionDataTable $dataTable)
    {
        return $dataTable->render('admin.sections.index');
    }

    public function create()
    {
        return view('admin.sections.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);
        $fields = [];
        if($request->value){
            foreach ($request->value as $key => $value) {
                $fields[$request->name[$key]] = [
                    'value' => $value,
                    'label' => $request->label[$key],
                    'type' => $request->type[$key],
                ];
            }
        }
        if($request->img_value){
            foreach ($request->img_value as $key => $img_value) {
                $ext = rand().".".$img_value->getClientOriginalName();
                $img_value->move(public_path('sections'),$ext);
                $fields[$request->img_name[$key]] = [
                    'value' => $ext,
                    'label' => $request->img_label[$key],
                    'type' => $request->img_type[$key],
                ];
            }
        }

        $section = new Section();
        $section->title = $request->title;
        $section->status = $request->status;
        $section->content = json_encode($fields);
        $section->save();
        return redirect()->route('admin.sections.index')->with('success', 'Section created successfully.');
    }

    public function edit(Section $section)
    {
        return view('admin.sections.edit', compact('section'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'status' => 'required',
        ]);
        // Retrieve the existing section
        $section = Section::findOrFail($id);

        // Initialize fields array
        $fields = [];

        // Handle text fields
        if($request->has('value')) {
            foreach ($request->value as $key => $value) {
                $fields[$request->name[$key]] = [
                    'value' => $value,
                    'label' => $request->label[$key],
                    'type' => $request->type[$key],
                ];
            }
        }

        // Handle image fields
        if($request->has('img_name')) {
            foreach ($request->img_name as $key => $img_name) {
                // Check if an image file was uploaded
                if ($request->img_value[$key] instanceof \Illuminate\Http\UploadedFile) {
                    $ext = rand() . "." . $request->img_value[$key]->getClientOriginalExtension();
                    $request->img_value[$key]->move(public_path('sections'), $ext);
                }
                elseif (is_string($request->img_value[$key])) {
                    $ext = $request->img_value[$key];
                }
                $fields[$img_name] = [
                    'value' => $ext,
                    'label' => $request->img_label[$key],
                    'type' => $request->img_type[$key],
                ];
            }
        }

        // Update the section
        $section->title = $request->title;
        $section->status = $request->status;
        $section->content = json_encode($fields);
        $section->save();

        return redirect()->route('admin.sections.index')->with('success', 'Section updated successfully.');
    }

}
