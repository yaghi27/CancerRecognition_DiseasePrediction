<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 
use Illuminate\Support\Facades\Http;
use Symfony\Component\DomCrawler\Crawler;

class Disease_predictionController extends Controller
{
    public function index(Request $request){
        if($request->hasCookie('user_id')){

            $symptoms_list = DB::table('symptoms')->get();
            return view('Main/disease_prediction', ['symptoms' => $symptoms_list]);
        }else{
            return redirect('/login');
        }
    }

    public function disease_prediction_form_submit(Request $request){

        $symptom1 = ($request->input('Symptom1') !== null) ? $request->input('Symptom1') : '';
        $symptom2 = ($request->input('Symptom2') !== null) ? $request->input('Symptom2') : '';
        $symptom3 = ($request->input('Symptom3') !== null) ? $request->input('Symptom3') : '';
        $symptom4 = ($request->input('Symptom4') !== null) ? $request->input('Symptom4') : '';
        $symptom5 = ($request->input('Symptom5') !== null) ? $request->input('Symptom5') : '';
        
        $response = Http::asForm()->post('http://127.0.0.1:5001/disease_predict', [
            'Symptom1' => $symptom1,
            'Symptom2' => $symptom2,
            'Symptom3' => $symptom3,
            'Symptom4' => $symptom4,
            'Symptom5' => $symptom5,
            'form'     => $request->input('form')
        ]);

        $html = $response->getBody()->getContents();
        $crawler = new Crawler($html);
        $filter_prediction = $crawler->filter('div#prediction')->html();

        $dom = new \DOMDocument();
        $dom->loadHTML($filter_prediction);
        $paragraphs = $dom->getElementsByTagName('p');
        $diagnosis = $paragraphs->item(0)->nodeValue;
        if($request->input('from_history') == 'false'){
            DB::table('history')->insert([
                'USER_ID'   => $request->cookie('user_id'),
                'Diagnosis' => trim($diagnosis),
                'Symptom1'  => $symptom1,
                'Symptom2'  => $symptom2,
                'Symptom3'  => $symptom3,
                'Symptom4'  => $symptom4,
                'Symptom5'  => $symptom5,
                'TYPE'      => 'DP'
            ]);
        }

        // Check if the request was successful
        if ($response->successful()) {
            return response()->json(['html' => $filter_prediction]);
        } else {
            return redirect()->back()->with('error', 'Failed to submit form. Please try again.');
        }
    }

}
