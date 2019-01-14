<?php

namespace App\Http\Controllers;

use App\Helper\Steps;
use App\Helper\UsersTypes;
use App\Models\Article;
use App\Models\ArticleFiles;
use App\Models\Categery;
use App\Models\ContentList;
use App\Models\Grade;
use App\Repository\ContentListsRepository;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allLists=ContentList::all()->count();
        $listsByArtical=ContentListsRepository::findStep('step','>',Steps::INSERTING_ARTICLE)->count();
        $complete=ContentListsRepository::findWhere('step',Steps::Publish)->count();
        $allUsers=User::all()->count();
        $allCats=Categery::all()->count();
        $allGrades=Grade::all()->count();
        $allArtical=Article::all()->count();
        $allFiles=ArticleFiles::all()->count();
        $analizingFile=ContentListsRepository::findStep('step','>',Steps::ANALYZING_FILE)->count();
        $fileUnderAnalizing=ContentListsRepository::findStep('step','=',Steps::ANALYZING_FILE)->count();
        $fileUnderUploading=ContentListsRepository::findStep('step','=',Steps::UPLOADING_FILE)->count();
//      dd($fileUnderAnalizing);
        if(auth()->user()->role==UsersTypes::SUPERADMIN){
            return view('superadmin.home',compact('allLists','listsByArtical','complete','allUsers','allCats','allGrades','allArtical','analizingFile','fileUnderAnalizing','allFiles','fileUnderUploading'));
        }
        else{
            return view('home');
        }

    }
}
