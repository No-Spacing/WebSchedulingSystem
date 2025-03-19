<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
use Inertia\Inertia;
use App\Models\Schedule;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{

    public function PostSchedule(ScheduleRequest $request){
        Schedule::create([
            'title' => $request->title,
            'room' => $request->room,
            'date' => $request->date,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
        ]);  
        return redirect('/schedules');
    }

    public function UpdateSchedule(ScheduleRequest $request){
        DB::table('schedules')
        ->where('id', $request->id)
        ->update([
            'title' => $request->title,
            'room' => $request->room,
            'date' => $request->date,
            'startTime' => $request->startTime,
            'endTime' => $request->endTime,
        ]);
    }

    public function DeleteSchedule($id){
        DB::table('schedules')
        ->where('id', $id)
        ->delete();
    }

    public function show(Request $request)
    {
        error_log($request->title);
        $schedules = DB::table('schedules')
        ->where('title', 'like', '%' . $request->search . '%')
        ->orWhere('room', 'like', '%' . $request->search . '%')
        ->orWhere('date', 'like', '%' . $request->search . '%')
        ->orderBy('created_at', 'desc')
        ->paginate(5);
        return Inertia::render('Schedules',[
          'schedules' => $schedules
        ]);
    }
}
