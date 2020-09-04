<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Goutte\Client;
use Symfony\Component\HttpClient\HttpClient;

class Player extends Model
{
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getVote($name,$team,$id){
        $client = new Client(HttpClient::create(['timeout' => 60]));
        $crawler = $client->request('GET', 'https://www.fantacalcio.it/squadre/'.$team .'/'.$name.'/'.$id.'/1/2019-20');
        $value = $crawler->filter('div > p')->each(function ($node) {
            return $node->text();
        });
        return $value;
    }
}
