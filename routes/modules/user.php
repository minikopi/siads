<?php

use App\Http\Controllers\User\PasswordController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

Route::resource('profile', ProfileController::class)->only('index', 'store');

Route::resource('password', PasswordController::class)->only('index', 'store');
