<?php

namespace App\Http\Controllers\superAdmin;

use App\Helper\UsersTypes;
use App\Models\School;
use App\Repository\SchoolRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class SchoolController extends Controller
{
    public function index()
    {
        $schools = School::whereIn('type', [UsersTypes::School,UsersTypes::virtualSchool])->get();
        return view('superadmin.school.index', compact('schools'));
    }

    public function create()
    {
        return view('superadmin.school.create');
    }

    public function save(Request $request)
    {
        $rules = 'greater_than_now';

        request()->validate([
            'email' => 'required|email|unique:mysql2.users,email',
            "name" => "required|min:6|max:30|alpha_num",
            "password" => "required|min:6|max:30|confirmed",

        ], [

            'name.required' => 'الاسم مطلوب ',
            'name.min' => 'الاسم لا يقل عن 6 احرف ',
            'password.min' => 'كلمة المرور لا تقل عن 6 احرف',
            'password.required' => 'كلمة المرور مطلوبة',
            'name.max' => 'الاسم لا يزيد عن 30 حرف',
            'password.max' => 'كلمة المرور لا تزيد عن 30 حرف ',
            'password.confirmed' => 'تأكيد كلمة المرور غير صحيحة',
            'name.alpha_num' => 'الاسم يجب ان يكون ارقان وحروف فقط ',
            'email.required' => 'الإيميل مطلوب ',
            'email.email' => 'الإيميل غير صحيح ',
            'email.unique' => 'الاميل موجود بالفعل',
        ]);
        if ($request->type == UsersTypes::virtualSchool) {
            $school = new  School();
            $school->name = $request->name;
            $school->email = $request->email;
            if (!empty($request->password)) {
                $school->password = Hash::make($request->password);
            }
            $school->type = UsersTypes::virtualSchool;
            $school->save();
            return redirect()->back()->with('success', 'تمت إضافة المدرسة بنجاح ');
        } else {
            request()->validate([
                "acc_num" => "required|numeric",
                "end_at" => "required|greater_than_field:start_at|" . $rules,
                "start_at" => "required|" . $rules,], [
                'end_at.required' => 'من فضلك ادخل تاريخ نهايه التفعيل',
                'end_at.greater_than_field' => 'من فضلك  تاريخ النهايه يحب ان يكون اكبر من تاريخ البدايه',
                'end_at.greater_than_now' => 'من فضلك  تاريخ النهايه يحب ان يكون اكبر من تاريخ اليوم',
                'start_at.greater_than_now' => 'من فضلك  تاريخ البدايه يحب ان يكون اكبر من تاريخ اليوم',
                'start_at.required' => 'من فضلك ادخل تاريخ بدايه التفعيل',
                'acc_num.required' => 'عدد المتسخدمين مطلوب',
                'acc_num.numeric' => 'عدد المتسخدمين يجب ان يكون رقم ',
            ]);
        }

        SchoolRepository::save($request);
        return redirect()->back()->with('success', 'تمت إضافة المدرسة بنجاح ');
    }

    public function edit($school_id)
    {
        $data = SchoolRepository::findSchool($school_id);

        $user = $data['user'];
        $school = $data['school'];
        if (empty($school)) {
            return redirect()->back()->with('error', 'المدرسة غير موجودة ');
        }
        return view('superadmin.school.edit', compact('user', 'school'));

    }

    public function update(Request $request, $school_id)
    {
        $rules = 'greater_than_now';
        request()->validate([
            'email' => 'required|email|unique:mysql2.users,email,' . $school_id . '|email',
            "name" => "required|min:6|max:30|alpha_num",
            "acc_num" => "required|numeric",
            "end_at" => "required|greater_than_field:start_at|" . $rules,
            "start_at" => "required",
        ], [
            'end_at.required' => 'من فضلك ادخل تاريخ نهايه التفعيل',
            'end_at.greater_than_field' => 'من فضلك  تاريخ النهايه يحب ان يكون اكبر من تاريخ البدايه',
            'end_at.greater_than_now' => 'من فضلك  تاريخ النهايه يحب ان يكون اكبر من تاريخ اليوم',
            'start_at.greater_than_now' => 'من فضلك  تاريخ البدايه يحب ان يكون اكبر من تاريخ اليوم',
            'start_at.required' => 'من فضلك ادخل تاريخ بدايه التفعيل',
            'acc_num.required' => 'عدد المتسخدمين مطلوب',
            'acc_num.numeric' => 'عدد المتسخدمين يجب ان يكون رقم ',
            'name.required' => 'الاسم مطلوب ',
            'name.min' => 'الاسم لا يقل عن 6 احرف ',
            'password.min' => 'كلمة المرور لا تقل عن 6 احرف',
            'password.required' => 'كلمة المرور مطلوبة',
            'name.max' => 'الاسم لا يزيد عن 30 حرف',
            'password.max' => 'كلمة المرور لا تزيد عن 30 حرف ',
            'password.confirmed' => 'تأكيد كلمة المرور غير صحيحة',
            'name.alpha_num' => 'الاسم يجب ان يكون ارقان وحروف فقط ',
            'email.required' => 'الإيميل مطلوب ',
            'email.email' => 'الإيميل غير صحيح ',
            'email.unique' => 'الاميل موجود بالفعل',
        ]);
        SchoolRepository::save($request, $school_id);
        return redirect()->back()->with('success', 'تمت التعديل المدرسة بنجاح ');
    }
}
