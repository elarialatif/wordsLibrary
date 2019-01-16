<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Models\UserRate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class UserRateRepository
{
    static function all()
    {
        $rate = UserRate::all();
        return $rate;
    }

    static function find($id)
    {
        $rate = UserRate::find($id);
        return $rate;
    }

    static function save($data)
    {
        $rate = UserRate::create($data);
        return $rate;
    }

    static function update($user_id, $list_id, $data)
    {
        $rate = UserRate::where(['user_id' => $user_id, 'list_id' => $list_id])->first();
        $rate = $rate->update($data);
        return $rate;
    }

    static function delete($id)
    {
        try {
            UserRate::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    static function findWhere( $value, $value2)
    {

            $rate = UserRate::where(['list_id' => $value, 'user_id' => $value2])->first();

        return $rate;
    }
}