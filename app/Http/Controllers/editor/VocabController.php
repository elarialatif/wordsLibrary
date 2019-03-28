<?php

namespace App\Http\Controllers\editor;

use App\Models\Article;
use App\Models\ArticleFiles;
use App\Models\Vocab;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VocabController extends Controller
{
    public function createVocab($file_id, $level)
    {
        $list_id = ArticleFiles::find($file_id)->list_id;
        $articleCheck = Article::where(['list_id' => $list_id, 'level' => $level])->first();
        $allVocabularyForTheListAndLevel = Vocab::where(['list_id' => $list_id, 'level' => $level])->get();
        $article= Article::where(['list_id'=>$list_id,'level'=>$level])->first();
        if ($articleCheck == null) {
            return redirect()->back()->withErrors(['ادخل المقال المختصر اولا ']);
        } elseif ($articleCheck->stretchArticle == null) {
            return redirect()->back()->withErrors(['ادخل المقال الموسع اولا ']);
        }
        return view('editor.vocabulary.createVocabulary')->with(compact('file_id'))->with(compact('level'))->with(compact('allVocabularyForTheListAndLevel'))->with(compact('article'));
    }

    public function saveVocab($file_id, $level)
    {
        $list_id = ArticleFiles::find($file_id)->list_id;
        foreach (\request('word') as $word) {
            if ($word['word'] == null || $word['mean'] == null) {
                continue;
            }
            $arrayOfWordsAndMeaning[] = array(
                'word' => $word['word'],
                'mean' => $word['mean'],
                'list_id' => $list_id,
                'level' => $level,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            );
        }
        $vocab = new Vocab();
        $vocab::insert($arrayOfWordsAndMeaning);
        return redirect()->back()->with('success', 'تمت الإضافة بنجاح');
    }

    public function deleteVocab($id)
    {
        $vocab = Vocab::find($id)->delete();
        return redirect()->back()->with('success', 'تم الحذف بنجاح');
    }

    public function updateVocab($id)
    {
       $newDataForUpdatedWord= \request()->except('_token');
        $vocab = Vocab::find($id);
        $vocab->update($newDataForUpdatedWord);
        return redirect()->back()->with('success', 'تم التعديل بنجاح');
    }
}
