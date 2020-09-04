<?php

namespace App\Http\Controllers;

use App\Poll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class GraphController extends Controller
{
    private $api;
    public function __construct(Facebook $fb)
    {
        $this->middleware(function ($request, $next) use ($fb) {
            $fb->setDefaultAccessToken(Auth::user()->facebook_id);
            $this->api = $fb;
            return $next($request);
        });
    }


    public function publishToProfile($id){
        /*
        try {
            $response = $this->api->post('/me/feed', [
                'message' => "Test"
            ])->getGraphNode()->asArray();
            if($response['id']){
               // post created
            }
        } catch (FacebookSDKException $e) {
            dd($e); // handle exception
        }
        */
        /*
        try {
            // Get the \Facebook\GraphNodes\GraphUser object for the current user.
            // If you provided a 'default_access_token', the '{access-token}' is optional.
            $response =$this->api->get('/10220336023449211/accounts', Auth::user()->facebook_id);
            dd($response);
          } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            // When Graph returns an error
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
          } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
          }
          */

        $longLivedToken = $this->api->getOAuth2Client()->getLongLivedAccessToken(Auth()->user()->facebook_id);
        $this->api->setDefaultAccessToken($longLivedToken);
        $response = $this->api->get('/me/accounts', Auth::user()->facebook_id)->getDecodedBody();
          
        $foreverPageAccessToken = $response["data"][1]['access_token'];

        $this->api->setDefaultAccessToken($foreverPageAccessToken);

        //dd(Poll::find($id)->player1);
        try{
            $this->api->sendRequest('POST', "/me/feed", [
                'message' => 'Consigliami chi schierare:'.Poll::find($id)->player1 ." o " . Poll::find($id)->player2 ."?\n" ."Visita:",
                'link' => 'http://FantaAdvice.com',
            ]);
           
            return redirect('/home')->with('successo', 'Posted on Facebook!');
            
        }catch(FacebookSDKException $e){
            return redirect('/home')->with('errore','Duplicate post');
        }
        
        
       
    }
}
