<?php

namespace App\Http\Controllers;

use App\Helper\UsersTypes;
use App\Repository\IssuesRepository;
use Illuminate\Http\Request;

class IssuesController extends Controller
{
    public function save(Request $request)
    {
        if (auth()->user()->role == UsersTypes::EDITOR /*|| auth()->user()->role == UsersTypes::QuestionCreator*/) {
            return redirect()->back()->withErrors('غير مسموح لك الدخول إلى هنا ');
        }
        $request->validate([
            'name' => 'required',
            'title' => 'required',
        ], [
            'name.required' => 'الاسم مطلوب',
            'title.required' => 'العنوان مطلوب'
        ]);
        IssuesRepository::save($request);
        return redirect()->back()->with('success', 'تمت الإضافة بنجاح ');
    }

    public function ChangeStep($id, $step)
    {
        IssuesRepository::ChangeStep($id, $step);
        return redirect()->back()->with('success', 'تم التعديل بنجاح ');
    }

    public function edit(Request $request, $id)
    {
        $data = $request->except('_token');
        $issue = IssuesRepository::update($id, $data);
        return redirect()->back()->with('success', 'تمت التعديل بنجاح ');
    }

    public function destroy($id)
    {
        if (auth()->user()->role == UsersTypes::EDITOR /*|| auth()->user()->role == UsersTypes::QuestionCreator*/) {
            return redirect()->back()->withErrors('غير مسموح لك الدخول إلى هنا ');
        }
        IssuesRepository::delete($id);
        return redirect()->back()->with('success', 'تم المسح بنجاح ');
    }
}
