<?php

namespace App\Http\Controllers;

use App\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlayerController extends Controller
{
    public function store(Request $request){
        $data = DB::table('_all_serie_aplayer')->where('Nome','LIKE','%'.  $request->get('player_name') .'%')->get();
        
        foreach ($data as $item) {
            $name = $item->Nome;
            $role = $item->R;
            $team = $item->Squadra;
            $id = $item->id;
            //$media = $item->Qt_A
        }
        $name = str_replace(' ', '-', $name);
        $name = rtrim($name,'.');
        $nuovo = new Player();
        $last_score = $nuovo->getVote($name,$team,$id);
        $nuovo->user_id = auth()->user()->id;
        $nuovo->name = $name;
        $nuovo->role = $role;
        $nuovo->club = $team;
        $nuovo->img = 'http://content.fantacalcio.it/web/campioncini/card/'.$name. '.jpg';
        $nuovo->fantamedia = 7;
        $nuovo->last_score = $last_score[25];
   
        
        
        
        $nuovo->save();
        return redirect('/home');

    }

    public function destroy($id){
        Player::find($id)->delete();
        return redirect('/home');
    }
    
}
