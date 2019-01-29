<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 21/01/2019
 * Time: 11:12 ص
 */

namespace App\Repository;


use App\Helper\UsersTypes;
use App\Models\School;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SchoolRepository
{
    static function save($request, $id = null)
    {

        DB::transaction(function () use ($request, $id) {
            $school = new  School();
            $user = School::find($id);
            if ($user) {
                $school = $user;
                $SchoolLogo = DB::table('studentpedia.schools')
                    ->select('*')
                    ->where('user_id', '=', $id)->first();
                $logoName = $SchoolLogo->logo;
            }
            if ($request->file('logo') != null) {
                $logo = $request->file('logo');
                $destinationPath = 'public/schoolsLogos/';
                $extension = $logo->getClientOriginalExtension();
                $sha1 = sha1($logo->getClientOriginalName());
                $logoName = time() . "_" . $sha1 . "." . $extension;
                $logo->move($destinationPath, $logoName);
            }


            $school->name = $request->name;
            $school->email = $request->email;
            if (!empty($request->password)) {
                $school->password = Hash::make($request->password);
            }
            $school->type = UsersTypes::School;
            $school->save();
            $query = ['start_at' => $request->start_at,
                'created_by' => auth()->id(),
                'user_id' => $school->id,
                'end_at' => $request->end_at,
                'num_acc' => $request->acc_num,
                'student_num' => $request->student_num,
                'lat' => $request->lat,
                'lng' => $request->lng,
                'logo' => $logoName,
                'website' => $request->website,
                'mobile' => $request->mobile,
                'facebook' => $request->facebook,];
            if ($id != null) {
                DB::table('studentpedia.schools')->where('user_id', $id)
                    ->update(
                        $query
                    );
            } else {
                DB::table('studentpedia.schools')->insert([
                    [
                        $query
                    ],

                ]);
            }


        });

    }

    static function findSchool($school_id)
    {
        $user = School::find($school_id);
        $school = DB::table('studentpedia.schools')
            ->select('*')
            ->where('user_id', '=', $school_id)->first();
        $data['user'] = $user;
        $data['school'] = $school;
        return $data;


    }
}