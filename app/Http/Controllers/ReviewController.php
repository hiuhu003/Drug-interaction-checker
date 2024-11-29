<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    //show the form to submit reviews
    public function showForm(){
        return view('review_form');
    }

    //store the review in the database
    public function store(Request $request){
        $request->validate([
            'username' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|between:1,5',
        ]);

        $review = new Review();
        $review->username = $request->username;
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();

        return redirect()->route('reviews.index');
    }

    // Display the reviews
    public function index()
    {
        $reviews = Review::all();
        return view('home.reviews', compact('reviews'));
    }

}
