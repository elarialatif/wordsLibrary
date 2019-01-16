<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Grade;
use App\Repository\CountryRepository;
use App\Repository\WordsRepository;
use Illuminate\Http\Request;
use App\Repository\GradesRepository;
use App\Repository\LevelsRepository;

class WordController extends Controller
{
    public function index()
    {
        $words = WordsRepository::all();
       // $countries = CountryRepository::all();
        $grades = GradesRepository::all();
        $levels = LevelsRepository::all();
        return view('listsanalayzer.words.index', compact('words', 'levels',  'grades'));
    }

    public function create()
    {
       // $countries = CountryRepository::all();
        $grades = GradesRepository::all();
        $levels = LevelsRepository::all();
        return view('listsanalayzer.words.create', compact( 'levels', 'grades'));
    }

    public function save(Request $request)
    {
        $word = $request->except('_token', 'level_id');
        WordsRepository::save($word);
        return redirect()->to('allWords');
    }

    public function wordsFilter($grade_id)
    {
        $request = request()->except('_token', 'level_id');
        $words = WordsRepository::filter($grade_id);
       // $countries = CountryRepository::all();
        $grades = GradesRepository::all();
        $levels = LevelsRepository::all();
        return view('listsanalayzer.words.index', compact('words', 'levels', 'grades'));
    }

    public function AjaxSave()
    {


        $grade_id = \request('grade_id');
        $file_id = \request('file_id');
        $wordseasy = \request('arreasy');
        $wordhard = \request('arrhard');
        WordsRepository::AjaxSave($wordhard, $wordseasy, $grade_id, $file_id);
        session()->put('success', 'تم الحفظ بنجاح');
    }

    public function teshkelGet()
    {

        return view('taskel');
    }

    public function teshkelpost()
    {
        $client = new \GuzzleHttp\Client();
        $URI = 'http://tahadz.com/mishkal/ajaxGet';
        $params['form_params'] = array('text' => \request('text'), 'action' => 'TashkeelText');
        $response = $client->post($URI, $params);
        $body = $response->getBody();
        $content = json_decode($body);
        $textTaskel  = $content->result;
        $text=\request('text');
        return view('taskel',compact('textTaskel','text'));
    }
}
