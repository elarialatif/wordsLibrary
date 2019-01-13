<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Models\Country;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class CountryRepository
{
    static function all()
    {
        $country =Country::all();
        return $country;
    }

    static function find($id)
    {
        $country =Country::find($id);
        return $country;
    }

    static function save($data)
    {
        $country =Country::create($data);
        return $country;
    }

    static function update($id, $data)
    {
        $country =Country::find($id);
        $country = $country->update($data);
        return $country;
    }

    static function delete($id)
    {
        try {
           Country::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}