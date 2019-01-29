<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 25/12/2018
 * Time: 11:04 ص
 */

namespace App\Repository;


use App\Models\Sound;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class SoundsRepository
{
    static function save($file, $article_id)
    {

        DB::transaction(function () use ($file, $article_id) {
            $extension = $file->getClientOriginalExtension();
            $sha1 = sha1($file->getClientOriginalName());
            $filename = time() . "_" . $sha1 . "." . $extension;
            $destinationPath = 'public/sounds/';
            $file->move($destinationPath, $filename);

            $sound = Sound::where('article_id', $article_id)->first();
            if (!$sound) {
                $sound = new Sound();
            }
            $sound->name = $file->getClientOriginalName();
            $sound->article_id = $article_id;
            $sound->extension = $file->getClientOriginalExtension();
            $sound->path = $destinationPath . $filename;
            $sound->user_id = auth()->id();
            $sound->save();

        });

    }

    static function findWhere($att, $value)
    {
        $sound = Sound::where($att, $value)->first();
        return $sound;
    }

    static function findWhereIn($att, $value)
    {
        $sound = Sound::whereIn($att, $value)->get();
        return $sound;
    }
}