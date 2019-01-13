<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Models\Level;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LevelsRepository
{
    static function all()
    {
        $levels =Level::all();
        return $levels;
    }

    static function find($id)
    {
        $levels =Level::find($id);
        return $levels;
    }

    static function save($data)
    {
        $levels =Level::create($data);
        return $levels;
    }

    static function update($id, $data)
    {
        $levels =Level::find($id);
        $levels = $levels->update($data);
        return $levels;
    }

    static function delete($id)
    {
        try {
           Level::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}