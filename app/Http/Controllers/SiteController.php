<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Section;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $data['hero_section'] = Section::where('title','Hero Section')->first();
        $data['hero_section'] = json_decode($data['hero_section']->content);
        $data['plans'] = Plan::where('status', 1)->get();
        return view('welcome',$data);
    }
}
