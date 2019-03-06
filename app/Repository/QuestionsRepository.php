<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Models\Question;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class QuestionsRepository
{
    static function all()
    {
        $question = Question::all();
        return $question;
    }

    static function find($id)
    {
        $question = Question::find($id);
        return $question;
    }

    static function findWhere($att, $value)
    {
        $question = Question::where($att, $value)->get();
        return $question;
    }

    static function findWhereIn($att, $value)
    {
        $question = Question::whereIn($att, $value)->get();
        return $question;
    }

    static function findIds($att, $value)
    {
        $question = Question::where($att, $value)->get()->pluck('id')->toArray();
        return $question;
    }

    static function save($data)
    {
        $type = $data['type'];
        $list_id = $data['list_id'];
        $artical_id = $data['artical_id'];
        $question = [];
        foreach ($data['question'] as $key => $value) {
            $new = new Question();
            $new->question = $data['question'][$key];
            $new->ans1 = $data['ans1'][$key];
            $new->ans2 = $data['ans2'][$key];
            $new->ans3 = $data['ans3'][$key];
            $new->ans4 = $data['ans4'][$key];
            $new->true_answer = $data['true_answer'][$key];
            $new->list_id = $list_id;
            $new->type = $type;
            $new->artical_id = $artical_id;
            $new->user_id = auth()->id();
            $new->created_at = Carbon::now();
            $new->updated_at = Carbon::now();
            $new->save();
            array_push($question, $new);
        }

        return $question;
    }

    static function update($id, $data)
    {
        $question = Question::find($id);
        $question = $question->update($data);
        return $question;
    }

    static function delete($id)
    {
        try {
            Question::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}