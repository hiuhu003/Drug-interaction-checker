<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\HomeController;
use  App\Http\Controllers\DrugInteractionController;
use App\Http\Controllers\PersonalInfoController;
use App\Http\Controllers\ReviewController;

route::get('/',[HomeController::class,'home']);

Route::get('/dashboard', function () {
    return view('main.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

route::get('/info',function(){
    return view('final.info');
});

Route::post('/drug-interactions', [DrugInteractionController::class, 'store']);

//to get faq's section
route::get('/faq',function(){
    return view('main.faq');
})->name('faq');

//bmi information
Route::post('/calculate-bmi', [PersonalInfoController::class, 'processMedicalInfo'])->name('calculate.bmi');



//review section
Route::get('/review', [ReviewController::class, 'showForm']);
Route::post('/review', [ReviewController::class, 'store']);
Route::get('/reviews', [ReviewController::class, 'index'])->name('reviews.index');