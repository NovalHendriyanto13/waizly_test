<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Basics\BasicController;

Route::post('/no/{id}', [BasicController::class, 'getBasic']);