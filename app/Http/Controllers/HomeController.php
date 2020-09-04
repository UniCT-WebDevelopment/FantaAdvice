<?php

namespace App\Http\Controllers;

use App\allPlayer;
use App\Poll;
use App\Player;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $players = User::find(auth()->user()->id)->player;
        return view('home',[
            'polls' => auth()->user()->timeline(),
            'players' => $players,
        ]);
    }

    function fetch(Request $request){
        if($request->get('query')){
            $data = DB::table('_all_serie_aplayer')->where('Nome','LIKE','%'.  $request->get('query') .'%')->get();

            $output = '<ul class="dropdown-menu" style="display:block; position:relative>"';
            foreach($data as $row){
                $output .= '<li><a class="dropdown-item" href="#">'.$row->Nome.'</a></li>';
            }
            $output .= '</ul>';
            echo $output;
        }
    }
}
