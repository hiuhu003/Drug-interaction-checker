<?php
use App\Http\Controllers\DrugInteractionController;
use Illuminate\Support\Facades\Route;


Route::post('/api/check-interaction', [DrugInteractionController::class, 'checkInteraction']);