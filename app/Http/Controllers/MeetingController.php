<?php

namespace App\Http\Controllers;

use App\Meeting;

class MeetingController extends Controller
{

    public function index()
    {
        $meetings = Meeting::paginate(10);
        return view('spacesMeeting.index', compact('meetings'));
    }

}
