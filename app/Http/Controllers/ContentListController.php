<?php

namespace App\Http\Controllers;

use App\Models\ContentList;
use App\Repository\GradesRepository;
use App\Repository\CountryRepository;
use Illuminate\Http\Request;
use App\Repository\ContentListsRepository;
use App\Repository\LevelsRepository;
use App\Models\Grade;

class ContentListController extends Controller
{

    public function index()
    {
        $lists = ContentListsRepository::all();
        // $countries = CountryRepository::all();
        $grades = GradesRepository::all();
        $levels = LevelsRepository::all();

        return view('listsmaker.lists.show', compact('lists', 'grades', 'levels'));
    }

    public function create()
    {
        //  $countries = CountryRepository::all();
        $grades = GradesRepository::all();
        $levels = LevelsRepository::all();
        return view('listsmaker.lists.create', compact('grades', 'levels'));
    }

    public function save(Request $request)
    {

        $lists = $request->except('_token', 'level_id');

        $list = ContentList::where(['list' => $lists['list'][0], 'grade_id' => $lists['grade_id']])->first();
        if ($list) {
            return redirect()->to('allLists')->withErrors('الاسم موجود بالفعل ');
        }
        ContentListsRepository::save($lists);
        return redirect()->to('allLists')->with('success', 'تمت الاضافة بنجاح ');

    }

    public function edit($id)
    {
        $lists = ContentListsRepository::find($id);
        // $countries = CountryRepository::all();
        $grades = GradesRepository::all();
        //   $levels = LevelsRepository::all();
        return view('listsmaker.lists.edit', compact('grades', 'lists'));
    }

    public function update(Request $request, $id)
    {
        $lists = $request->except('_token', 'level_id','image');

        $checkName = ContentListsRepository::find($id);
//        if($request->image && $request->image!=null){
//            unlink(public_path('listsImage/'.$checkName->image));
//            $filename = ($request->image)->getClientOriginalName();
//            $lists['image']=$filename;
//            ($request->image)->move(public_path() . '/' . 'listsImage', $filename);
//        }
        if ($checkName->list == $lists['list'] && $checkName->grade_id == $lists['grade_id'] /*&&$checkName->image==$lists['image']*/) {
            return redirect(url('allLists'))->with('info', 'لا يوجد تغغير ');
        }
        $list = ContentList::where(['list' => $lists['list'], 'grade_id' => $lists['grade_id']/*,'image'=>$lists['image']*/])->first();
        if ($list) {
            return redirect()->to('allLists')->withErrors('الاسم موجود بالفعل ');
        }
        ContentListsRepository::update($id, $lists);
        return redirect(url('allLists'))->with('success', 'تم  التعديل بنجاح ');
    }

    public function delete($id)
    {
        $delete = ContentListsRepository::delete($id);
        if ($delete == false) {
            session()->put('error', 'يوجد ملف لهذا الموضوع ');
            return redirect(url('allLists'));
        }
        return redirect(url('allLists'))->with('success', 'تم  الحذف بنجاح ');
    }

    public function listsFilter(Request $request, $grade_id)
    {
//
        //  $data = request()->except('_token');
        $data['grade_id'] = $grade_id;
        $lists = ContentListsRepository::filter($data);
        //$countries = CountryRepository::all();
        $grades = GradesRepository::all();
        return view('listsmaker.lists.show', compact('lists', 'grades'));
    }

    public function getGradeList(Request $request, $level_id)
    {
        $grades = Grade::where('level_id', $level_id)->select('name', 'id')->get();
        return response()->json($grades);
    }

    public function AjaxGetLists($grade_id)
    {
        $lists = ContentListsRepository::AjaxGetLists($grade_id);
        return response()->json($lists);
    }

    public function archive()
    {
        $lists = ContentList::onlyTrashed()->get();
        return view('superadmin.archive', compact('lists'));
    }

    public function restoreList($id)
    {
        ContentList::withTrashed()
            ->where('id', $id)
            ->restore();

        return redirect()->back()->with('success', 'تمت الاستعادة بنجاح');
    }

    public function forceDeleteList($id)
    {
        ContentList::withTrashed()
            ->where('id', $id)
            ->forceDelete();
        return redirect()->back()->with('success', 'تم المسح بنجاح');
    }
}
