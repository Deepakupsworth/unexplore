<?php

namespace App\Http\Controllers\Frontend;
use App\Http\Controllers\Controller;

 class PageController extends Controller
    {
        public function index()
        {
            return view('frontend.home');
        }
        public function about_us()
        {
            return view('frontend.about-us');
        }

        public function contact_us()
        {
            return view('frontend.contact-us');
        }
    }
