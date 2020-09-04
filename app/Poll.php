<?php

namespace App;
use App\Vote;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Poll extends Model{

    protected $guarded = [];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeWithVotes(Builder $query){
        
        $query->leftJoinSub(
            'SELECT poll_id, SUM(player) voti1, SUM(!player) voti2 FROM votes GROUP BY poll_id',
            'votes',
            'votes.poll_id',
            'polls.id'
        
        );
    }

    public function vote1($user = null,$player = true){
        if(!$this->votes()->where('user_id',"=",auth()->user()->id,'and','player',"=",$player)->exists()){
            DB::table('users')->where('id',"=",auth()->user()->id)->increment('credits');
        }
        $this->votes()->updateOrCreate([
            'user_id' => $user ? $user->id : auth()->id(),
        ],[
            'player' => $player
        ]);  
    }
    public function vote2($user= null){
        return $this->vote1($user, false);
    }

    public function votes(){
        return $this->hasMany(Vote::class);
    }

    // Controllo ora se un determinato utente ha votato un sondaggio $user->votes($poll) oppure $poll->isVotedBy($user)
    public function isVoted1By(User $user){
        return $this->votes()->where('user_id',$user->id)->where('player',true)->exists();
        #return (bool) $user->votes->where('poll_id',$this->id)->where('player',true)->exist();
    }

    public function isVoted2By(User $user){
        return $this->votes()->where('user_id',$user->id)->where('player',false)->exists();
        #return (bool) $user->votes->where('poll_id',$this->id)->where('player',false)->exist();
    }

}

