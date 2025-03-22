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

        $schedules = Schedule::where('room', $request->room)
                    ->where('date', $request->date)
                    ->where(function ($query) use ($request) {
                        $query->where('startTime', '<', $request->startTime)
                        ->where('endTime', '>', $request->endTime);
                    })
                    ->orWhere(function ($query) use ($request){
                        $query->where('startTime', '>', $request->startTime)
                        ->where('startTime', '<', $request->endTime);
                    })
                    ->orWhere(function ($query) use ($request){
                        $query->where('endTime', '>', $request->startTime)
                        ->where('endTime', '<', $request->endTime);
                    })
                    ->first();

        if($schedules){
            return back()->with(['message' => 'Selected Time has already been taken']);
        }else{
            Schedule::create([
                'title' => $request->title,
                'room' => $request->room,
                'date' => $request->date,
                'startTime' => $request->startTime,
                'endTime' => $request->endTime,
            ]);
            return redirect('/schedules');
        }
    }

    public function UpdateSchedule(ScheduleRequest $request){
        $schedules = Schedule::where('room', $request->room)
                    ->where('date', $request->date)
                    ->where(function ($query) use ($request) {
                        $query->where('startTime', '<', $request->startTime)
                        ->where('endTime', '>', $request->endTime);
                    })
                    ->orWhere(function ($query) use ($request){
                        $query->where('startTime', '>', $request->startTime)
                        ->where('startTime', '<', $request->endTime);
                    })
                    ->orWhere(function ($query) use ($request){
                        $query->where('endTime', '>', $request->startTime)
                        ->where('endTime', '<', $request->endTime);
                    })
                    ->first();

        if($schedules){
            return back()->with(['message' => 'Selected Time has already been taken.']);
        }else{
            Schedule::where('id', $request->id)
                    ->update([
                        'title' => $request->title,
                        'room' => $request->room,
                        'date' => $request->date,
                        'startTime' => $request->startTime,
                        'endTime' => $request->endTime,
                    ]);
        }

    }

    public function DeleteSchedule($id){
        Schedule::where('id', $id)
        ->delete();
    }

    public function show(Request $request)
    {
        return Inertia::render('Schedules',[
          'schedules' => Schedule::where('title', 'like', '%' . $request->search . '%')
                            ->orWhere('room', 'like', '%' . $request->search . '%')
                            ->orWhere('date', 'like', '%' . $request->search . '%')
                            ->orderBy('created_at', 'desc')
                            ->paginate(5)
                            ->withQueryString()
        ]);
    }
}
