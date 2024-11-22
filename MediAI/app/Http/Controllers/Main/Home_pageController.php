<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Http;

class Home_pageController extends Controller
{
    public function index(Request $request){

        if($request->hasCookie('user_id')){

            $user_id        = $request->cookie('user_id');
            $user_name      = $request->cookie('user_name');
            $user_last_name = $request->cookie('user_last_name');

            $symptoms_list   = DB::table('symptoms')->get();
            $recent_act_list = DB::table('history')->where('user_id', $user_id)
                                                   ->orderBy('DATE', 'desc')
                                                   ->take(3)
                                                   ->get();

            return view('Main/home', [
                                        'symptoms'        => $symptoms_list,
                                        'user_name'       => $user_name,
                                        'user_last_name'  => $user_last_name,
                                        'recent_act_list' => $recent_act_list,
                                        'user_id'         => $user_id
                                    ]);
            
        }else{
            return redirect('/login');
        }
    }

}
