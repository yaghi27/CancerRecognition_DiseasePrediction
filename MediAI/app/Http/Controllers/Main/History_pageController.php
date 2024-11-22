<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class History_pageController extends Controller
{
    public function index(Request $request){

        if($request->hasCookie('user_id')){

            $user_id = $request->cookie('user_id');
            $disease_prediction_list = DB::table('history')->where('user_id', $user_id)
                                                           ->where('TYPE', '=', 'DP')
                                                           ->orderBy('DATE', 'desc')
                                                           ->get();
            $ct_image_list           = DB::table('history')->where('user_id', $user_id)
                                                           ->where('TYPE', '=', 'CT')
                                                           ->orderBy('DATE', 'desc')
                                                           ->get();

            return view('Main/history', [
                                         'disease_prediction_list' => $disease_prediction_list,
                                         'ct_image_list'           => $ct_image_list
                                        ]);
            
        }else{
            return redirect('/login');
        }
    }

}
