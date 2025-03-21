<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ScheduleController;
use App\Models\Schedule;

Route::get('/', function () {
    return view('welcome');
});

Route::inertia('/dashboard', 'Dashboard');

Route::get('/schedules', [ScheduleController::class, 'show']);

Route::inertia('/create-schedule', 'CreateSchedule');

Route::post('/post-schedule', [ScheduleController::class, 'PostSchedule']);

Route::put('/update-schedule', [ScheduleController::class, 'UpdateSchedule']);

Route::delete('/delete-schedule/{id}', [ScheduleController::class, 'DeleteSchedule']);

