<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Socialite;

class SocialAuthFacebookController extends Controller
{
  /**
   * Create a redirect method to facebook api.
   *
   * @return void
   */
    public function redirect()
    {
        return Socialite::driver('facebook')->redirect();
    }
    /**
     * Return a callback method from facebook api.
     *
     * @return callback URL from facebook
     */
    public function callback()
    {
        try{
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('email', $user->email)->first();
            if($finduser){
                auth()->login($finduser);
                return redirect('/home');
            }else{
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id'=> $user->token,
                    'avatar'=> $user->avatar,    
                    'password' => encrypt('123456dummy')
                ]);

                Auth::login($newUser);
                return redirect('/home');
            }
        }
        catch (Exception $e) {
            dd($e->getMessage());
        };
    }
}