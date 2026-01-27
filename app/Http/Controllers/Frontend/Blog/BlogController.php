<?php

namespace App\Http\Controllers\Frontend\Blog;

use App\Http\Controllers\Controller;

 class BlogController extends Controller
{
    public function index()
    {
        return view('frontend.blogs');
    }

    public function detail(){
        return view('frontend.blog-details');
    }


}
