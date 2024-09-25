<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Plan;
use App\Models\Section;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $data['hero_section'] = Section::where('title','Hero Section')->first();
        $data['hero_section'] = json_decode($data['hero_section']->content);
        $data['about_section'] = Section::where('title','About Us')->first();
        $data['about_section'] = json_decode($data['about_section']->content);
        $data['feature_section'] = Section::where('title','Features')->first();
        $data['feature_section'] = json_decode($data['feature_section']->content);
        $data['plan_section'] = Section::where('title','Pricing Plan')->first();
        $data['plan_section'] = json_decode($data['plan_section']->content);
        $data['blog_section'] = Section::where('title','Our Blog')->first();
        $data['blog_section'] = json_decode($data['blog_section']->content);
        $data['testimonial_section'] = Section::where('title','Testimonial')->first();
        $data['testimonial_section'] = json_decode($data['testimonial_section']->content);
        $data['faq_section'] = Section::where('title','Faq')->first();
        $data['faq_section'] = json_decode($data['faq_section']->content);
        $data['plans'] = Plan::where('status', 1)->get();
        $data['blogs'] = Blog::where('status', 1)->latest()->get();
        return view('welcome',$data);
    }
}
