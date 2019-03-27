<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Helper\ArticleLevels;
use App\Models\Country;
use App\Models\Word;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class WordsRepository
{
    static function all()
    {
        $words = Word::all();
        return $words;
    }

    static function find($id)
    {
        $word = Word::find($id);
        return $word;
    }

    static function save($data)
    {
        $array = [];
        foreach ($data['word'] as $key => $value) {
            if ($data['word'][$key] == "") {
                continue;
            }
            $array[] = array(
                'word' => $data['word'][$key],
                'grade_id' => $data['grade_id'],
                'user_id' => auth()->id(),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            );
        }
        $word = Word::insert($array);
        return $word;
    }

    static function update($id, $data)
    {
        $word = Word::find($id);
        $word = $word->update($data);
        return $word;
    }

    static function delete($id)
    {
        try {
            Word::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    static function filter($garde_id)
    {
        $query = Word::orderBy("id", "desc");
        if ($garde_id != null && $garde_id != 'all') {
            $query->where('grade_id', $garde_id);
        }
        $words = $query->get();
        return $words;
    }

    static function AjaxSave($datahard, $dataeasy, $grade_id, $file_id)
    {
        $array1 = [];
        $array2 = [];
        $words = Word::where('file_id', $file_id)->get();
        if ($words->count() > 0) {
            Word::where('file_id', $file_id)->delete();

        }
        for ($i = 0; $i < count($dataeasy); $i++) {
            $Word = Word::where(['word' => $dataeasy[$i], 'grade_id' => $grade_id])->first();
            if ($Word) {
                $Word->level = ArticleLevels::Easy;
                $Word->save();
            } else {


                $array1[] = array(
                    'word' => $dataeasy[$i],
                    'grade_id' => $grade_id,
                    'level' => ArticleLevels::Easy,
                    'file_id' => $file_id,
                    'user_id' => auth()->id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                );
            }
        }
        for ($i = 0; $i < count($datahard); $i++) {
            $Word = Word::where(['word' => $datahard[$i], 'grade_id' => $grade_id])->first();
            if ($Word) {
                $Word->level = ArticleLevels::Hard;
                $Word->save();
            } else {
                $array2[] = array(
                    'word' => $datahard[$i],
                    'grade_id' => $grade_id,
                    'level' => ArticleLevels::Hard,
                    'file_id' => $file_id,
                    'user_id' => auth()->id(),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                );
            }
        }
        Word::insert($array1);
        Word::insert($array2);

    }
}