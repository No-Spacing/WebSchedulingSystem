<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ScheduleController;

Route::inertia('/schedules', 'Schedules');
Route::inertia('/create-schedule', 'CreateSchedule');

Route::post('/post-schedule', [ScheduleController::class, 'PostSchedule']);

Route::post('/update-schedule', [ScheduleController::class, 'UpdateSchedule']);

Route::get('/', function () {
    return view('welcome');
});
