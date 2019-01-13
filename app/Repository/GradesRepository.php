<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Models\Grade;
use Illuminate\Database\Eloquent\Model;

class GradesRepository
{
    static function all()
    {
        $grades =Grade::all();
        return $grades;
    }

    static function find($id)
    {
        $grades =Grade::find($id);
        return $grades;
    }

    static function save($data)
    {
        $grades =Grade::create($data);
        return $grades;
    }

    static function update($id, $data)
    {
        $grades =Grade::find($id);
        $grades = $grades->update($data);
        return $grades;
    }

    static function delete($id)
    {
        try {
           Grade::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    static function getGrades($att,$value)
    {
        $grades=Grade::where($att,$value)->lists('name','id');
        return response()->json($grades);
    }
}