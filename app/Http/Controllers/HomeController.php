<?php

namespace App\Http\Controllers;
use App\Models\Review;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home(){
        $reviews = Review::all();
        
        return view('home.index',compact('reviews'));
    }

    
}
