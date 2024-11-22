<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use Laravel\Socialite\Facades\Socialite; 
use Illuminate\Support\Facades\Session; 
use App\Models\User; 
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB; 

class LoginGoogleController extends Controller
{
    //Google Login 
    public function redirectToGoogle(){ 
        return Socialite::driver('google')->redirect();
    } 

    //Google callback  
    public function handleGoogleCallback(){ 

        try{
            $google_user = Socialite::driver('google')->user();
            $google_id = $google_user->getId();
            $user = DB::table('users')->where('google_id', '=', $google_id)->first();
            if(!$user){
                // var_dump($google_id);exit;
                $new_user = DB::table('users')->insertGetId([
                                                            'name'  => $google_user->getName(),
                                                            'email' => $google_user->getEmail(),
                                                            'google_id' => $google_id
                                                        ]);

                Cookie::queue('user_name', $google_user->getName(), 60); 
                Cookie::queue('user_last_name', '', 60);
                Cookie::queue('user_id', $new_user, 60);
        
                return redirect()->route('home'); 
            }else{
                Cookie::queue('user_name', $user->name, 60); 
                Cookie::queue('user_last_name', $user->last_name, 60);
                Cookie::queue('user_id', $user->id, 60);
                return redirect()->route('home'); 
            }

        }catch (\Throwable $e){
            dd("Error: " . $e->getMessage());exit;
        }
        
    }
    
    // public function logout(){ 

    //     $user = Auth::user(); 
    //     if($user->provider===('google')){ 
    //         Auth::logout(); 
    //         Session::flush(); 
            
    //         return redirect('/login'); 
    //     }else{ 
    //         echo "error"; 
    //     } 
    // } 

}
