<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\Models\Link;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class LinksRepository
{
    static function all()
    {
        $link =Link::all();
        return $link;
    }

    static function find($id)
    {
        $link =Link::find($id);
        return $link;
    }

    static function save($data)
    {

        $arr=[];
        foreach ($data['link'] as $link){
            $new['link']=$link;
            $new['list_id']=$data['list_id'];
            array_push($arr,$new);
        }
        $link=Link::insert($arr);
        return $link;
    }

    static function update($id, $data)
    {
        $link =Link::find($id);
        $link = $link->update($data);
        return $link;
    }

    static function delete($id)
    {
        try {
           Link::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}