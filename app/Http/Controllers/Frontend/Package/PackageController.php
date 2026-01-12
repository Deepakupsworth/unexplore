<?php

namespace App\Http\Controllers\Frontend\Package;

use App\Http\Controllers\Controller;

 class PackageController extends Controller
{
    public function index()
    {
        return view('frontend.package-listing');
    }

    public function details()
    {
        return view('frontend.package-details');
    }
}
