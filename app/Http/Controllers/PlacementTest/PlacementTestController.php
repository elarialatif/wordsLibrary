<?php

namespace App\Http\Controllers\PlacementTest;

use App\Models\PlacementTest;
use App\Repository\GradesRepository;
use App\Repository\PlacementTestRepository;
use App\Repository\QuestionsPlacementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PlacementTestController extends Controller
{
    public function index()
    {
        $tests = PlacementTest::all();
        $grades = GradesRepository::all();
        return view("PlacementTestEditor.index", compact('tests', 'grades'));
    }

    public function save(Request $request)
    {
        $data = $request->except('_token');
        $data['user_id'] = auth()->id();
        PlacementTestRepository::save($data);
        return redirect()->back()->with('success', 'تمت اضافة الاختبار بنجاح');
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token');
        $placement = PlacementTestRepository::update($id, $data);
        return redirect()->back()->with('success', 'تم تعديل الاختبار بنجاح');
    }

    public function delete($id)
    {
        $placementTest = QuestionsPlacementRepository::findWhere('exam_id', $id);
        if ($placementTest->count() > 0) {
            return redirect()->back()->with('info', 'لا يمكنك المسح توجد اسئلة');
        }
        $placement = PlacementTestRepository::delete($id);
        return redirect()->back()->with('success', 'تم تعديل الاختبار بنجاح');
    }
}
