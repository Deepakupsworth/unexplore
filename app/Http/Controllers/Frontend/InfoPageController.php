<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;

class InfoPageController extends Controller
{
    public function aboutSaudi()
    {
        return view('frontend.info.about-saudi');
    }

    public function visaRegulations()
    {
        return view('frontend.info.visa-regulations');
    }

    public function travelGuide()
    {
        return view('frontend.info.travel-guide');
    }

    public function gettingAround()
    {
        return view('frontend.info.getting-around');
    }
}
