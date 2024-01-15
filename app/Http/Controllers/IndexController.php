<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\Video;

class IndexController extends Controller
{
    public function home(){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        $category = Category::orderBy('id', 'DESC')->get();
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blog', 'huongdan')->get();
        return view('pages.home', compact('category', 'slider', 'blogs_huongdan'));
    }

    public function dichvu(){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.services', compact('slider'));
    }

    public function dichvucon($slug){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.sub_services',compact('slug', 'slider'));
    }

    public function danhmuc($slug){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.category', compact('slider'));
    }

    public function danhmuccon($slug){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        return view('pages.sub_category',compact('slug', 'slider'));
    }

    public function blogs(){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        $blogs = Blog::orderBy('id', 'DESC')->where('kind_of_blog', 'blogs')->paginate(30);
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blog', 'huongdan')->get();
        return view('pages.blog', compact('slider', 'blogs', 'blogs_huongdan'));
    }

    public function blogs_detail($slug){
        $slider = Slider::orderBy('id', 'DESC')->get();
        $blogs = Blog::where('slug', $slug)->first();
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blog', 'huongdan')->get();
        return view('pages.blog_detail', compact('slider', 'blogs', 'blogs_huongdan'));
    }

    public function video_highlight(){
        $slider = Slider::orderBy('id', 'DESC')->where('status', 1)->get();
        $blogs_huongdan = Blog::orderBy('id', 'DESC')->where('kind_of_blog', 'huongdan')->get();
        $videos = Video::orderBy('id', 'DESC')->where('status', 1)->paginate(30);
        return view('pages.video', compact('slider', 'blogs_huongdan', 'videos'));
    }
}
