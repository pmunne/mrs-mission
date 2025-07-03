<?php 

use App\Http\Controllers\RoverController;

Route::post('/rover/start', [RoverController::class, 'start']);
    