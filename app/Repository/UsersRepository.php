<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 12/11/2018
 * Time: 03:37 م
 */

namespace App\Repository;


use App\User;
use Illuminate\Database\Eloquent\Model;

class UsersRepository
{
    static function all()
    {
        $users = User::all();
        return $users;
    }

    static function find($id)
    {
        $users = User::find($id);
        return $users;
    }

    static function save($data)
    {
        $users = User::create($data);
        return $users;
    }

    static function update($id, $data)
    {
//        dd($data);
        $users = User::find($id);

        $user['name'] = $data['name'];
        $user['email'] = $data['email'];
        $user['role'] = $data['role'];
        $user['active'] = $data['active'];
        if ($data['password'] && $data['password'] != null) {
            $user['password'] = bcrypt($data['password']);
        }
        $users = $users->update($user);
        return $users;
    }
    static function profile($id, $data)
    {

        $users = User::find($id);

        $user['name'] = $data['name'];
        if(array_key_exists('img',$data)){
        if ($data['img'] && $data['img'] != null) {
            $user['img'] = $data['img'];
        }
        }
        if ($data['password'] && $data['password'] != null) {
            $user['password'] = bcrypt($data['password']);
        }
        $users = $users->update($user);
        return $users;
    }

    static function delete($id)
    {
        try {
            User::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    static function findWhere($att, $value)
    {
        $users = User::where($att, $value)->get();
        return $users;
    }
}