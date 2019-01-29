<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Helper\ArticleLevels;
use App\Helper\Steps;
use App\Models\Article;
use App\Models\Country;
use App\Models\ContentList;
use App\Models\Grade;
use App\Models\ArticleFiles;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ContentListsRepository
{
    static function all()
    {
        $lists = ContentList::all();
        return $lists;
    }

    static function find($id)
    {
        $lists = ContentList::find($id);
        return $lists;
    }

    static function save($data)
    {
        $array = [];
        foreach ($data['list'] as $key => $value) {
            if ($data['list'][$key] == "") {
                continue;
            }
            $list = New ContentList();
            $list->list = $data['list'][$key];

            $list->grade_id = $data['grade_id'];
            $list->user_id = auth()->id();
            $list->created_at = Carbon::now();
            $list->updated_at = Carbon::now();

            $list->save();
        }


        return $list;
    }

    static function update($id, $data)
    {
        $lists = ContentList::find($id);
        $lists = $lists->update($data);
        return $lists;
    }

    static function delete($id)
    {
        try {
            $check = ContentList::find($id);
//            if ($check->step == Steps::Publish) {
//                return false;
//            }
            ContentList::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    static function filter($data)
    {

        $query = ContentList::orderBy("id", "desc");
        if ($data['grade_id'] != null && $data['grade_id'] != 'all') {
            $query->where('grade_id', $data['grade_id']);
        }
        $lists = $query->get();
        return $lists;
    }

    static function AjaxGetLists($grade_id)
    {
        $lists_ids = ArticleFiles::select('list_id')->get()->toArray();
        $lists = ContentList::where(['grade_id' => $grade_id])->whereNotIn('id', $lists_ids)->select('id', 'list')->get();
        return $lists;
    }

    static function updateStep($list_id, $step)
    {

        DB::transaction(function () use ($list_id, $step) {
            $task = ContentList::find($list_id);
            $articles = Article::where('list_id', $list_id)->get();
            foreach ($articles as $article) {
                $article->status = ArticleLevels::notReview;
                $article->save();
            }
            $task->step = $step;
            $task->save();
        });


    }

    static function findWhere($paramter, $value)
    {

        return ContentList::with('level', 'grade')->where($paramter, $value)->get();

    }

    static function findStep($paramter, $sign, $value)
    {

        return ContentList::where($paramter, $sign, $value)->get();

    }

}