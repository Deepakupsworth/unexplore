<?php

namespace App\Http\Controllers\Frontend\ToDoThings;

use App\Http\Controllers\Controller;

 class ToDoThingsController extends Controller
{
    public function index()
    {
        return view('frontend.things-to-do');
    }

    public function search(){
        return view('frontend.to-do-things-search');
    }
}
