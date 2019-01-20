<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Models\PlacementTestQuestion;
use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class QuestionsPlacementRepository
{
    static function all()
    {
        $question = PlacementTestQuestion::all();
        return $question;
    }

    static function find($id)
    {
        $question = PlacementTestQuestion::find($id);
        return $question;
    }

    static function findWhere($att, $value)
    {
        $question = PlacementTestQuestion::where($att, $value)->get();
        return $question;
    }

    static function findWhereIn($att, $value)
    {
        $question = PlacementTestQuestion::whereIn($att, $value)->get();
        return $question;
    }

    static function findIds($att, $value)
    {
        $question = PlacementTestQuestion::where($att, $value)->get()->pluck('id')->toArray();
        return $question;
    }

    static function save($data)
    {
        $exam_id = $data['exam_id'];
        $array = [];
        $question = [];
        foreach ($data['question'] as $key => $value) {
            $new = new PlacementTestQuestion();
            $new->question = $data['question'][$key];
            $new->ans1 = $data['ans1'][$key];
            $new->ans2 = $data['ans2'][$key];
            $new->ans3 = $data['ans3'][$key];
            $new->ans4 = $data['ans4'][$key];
            $new->true_answer = $data['true_answer'][$key];
            $new->exam_id = $exam_id;
            $new->user_id = auth()->id();
            $new->created_at = Carbon::now();
            $new->updated_at = Carbon::now();
            $new->save();
            $question = array_push($array, $new);
        }

        return $question;
    }

    static function update($id, $data)
    {
        $question = PlacementTestQuestion::find($id);
        $question = $question->update($data);
        return $question;
    }

    static function delete($id)
    {
        try {
            PlacementTestQuestion::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}