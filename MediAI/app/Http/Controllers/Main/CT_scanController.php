<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class CT_scanController extends Controller{
    public function index(Request $request){
        if($request->hasCookie('user_id')){
            return view('Main/ct_scan');
        }else{
            return redirect('/login');
        }
    }

    public function send_mri(Request $request)
    {
    
        try {

            $fileContents = file_get_contents($request->file('image')->getRealPath());

            $response = Http::attach(
                'image', // parameter name
                $fileContents, // file contents
                'image.jpg' // file name
            )->post('http://127.0.0.1:8700/' . $request->type);

            if(count($response->json()) == 0){
                return response()->json('Image resolution not high enough or image not  valid for this type of MRI.');
            }

            $response_value = $response->json()[0];
            if ($response->failed()) {
                throw new \Exception('Failed to get a response from the ML server.');
            }

            $path = $request->file('image')->store('images', 'public');
    
            DB::table('history')->insert([
                'USER_ID'   => $request->cookie('user_id'),
                'Diagnosis' => $response_value,
                'Symptom1'  => $request->type,
                'Symptom2'  => $path,
                'Symptom3'  => '',
                'Symptom4'  => '',
                'Symptom5'  => '',
                'TYPE'      => 'CT'
            ]);
    
            return response()->json($response_value);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}