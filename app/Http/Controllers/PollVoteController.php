<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PollVoteController extends Controller
{
    public function store(Poll $poll){
        
        $poll->vote1(auth()->user());

        return back();
    }

    public function destroy(Poll $poll){
        $poll->vote2(auth()->user());
        return back();
    }
}
