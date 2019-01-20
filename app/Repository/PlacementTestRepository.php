<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Models\PlacementTest;
use Illuminate\Database\Eloquent\Model;

class PlacementTestRepository
{
    static function all()
    {
        $placement =PlacementTest::all();
        return $placement;
    }

    static function find($id)
    {
        $placement =PlacementTest::find($id);
        return $placement;
    }

    static function save($data)
    {
        $placement =PlacementTest::create($data);
        return $placement;
    }

    static function update($id, $data)
    {
        $placement =PlacementTest::find($id);
        $placement = $placement->update($data);
        return $placement;
    }

    static function delete($id)
    {
        try {
           PlacementTest::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
    static function getPlacementTests($att,$value)
    {
        $placement=PlacementTest::where($att,$value)->lists('name','id');
        return response()->json($placement);
    }
}