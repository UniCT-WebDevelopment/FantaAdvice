<?php

namespace App\Http\Controllers;
use App\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class PollController extends Controller{

    public function store(Request $request){


        $player1_check = request()->validate(['player1_selected' => 'required|min:1|different:player2_selected']);
        
        $player2_check = request()->validate(['player2_selected' => 'required|min:1|different:player1_selected']);
        
        if(auth()->user()->credits < 5){
            throw ValidationException::withMessages(['Credits_error' => 'You need more money']);
        }
        Poll::create([
            'user_id' => auth()->id(),
            'player1' =>  $player1_check['player1_selected'],
            'player2' =>  $player2_check['player2_selected']
        ]);
        
        DB::table('users')->where('id',"=",auth()->user()->id)->decrement('credits',5);

        return redirect('/home');
    }
    

    public function destroy($id){
        Poll::find($id)->delete();
        return redirect('/home');
    }
}
