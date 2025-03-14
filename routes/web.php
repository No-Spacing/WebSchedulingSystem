<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::inertia('/schedules', 'Schedules');

Route::get('/', function () {
    return view('welcome');
});
