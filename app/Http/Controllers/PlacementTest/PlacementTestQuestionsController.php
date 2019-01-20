<?php

namespace App\Http\Controllers\PlacementTest;

use App\Models\PlacementTest;
use App\Models\PlacementTestQuestion;
use App\Repository\GradesRepository;
use App\Repository\PlacementTestRepository;
use App\Repository\QuestionsPlacementRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;

class PlacementTestQuestionsController extends Controller
{
    public function index($placement_id)
    {
        $testQuestions = PlacementTestQuestion::where('exam_id', $placement_id)->get();
        $placementTest = PlacementTest::find($placement_id);
        return view("PlacementTestEditor.questions.index", compact('testQuestions', 'grades', 'placement_id', 'placementTest'));
    }

    public function create($placement_id)
    {

        return view("PlacementTestEditor.questions.create", compact('placement_id'));
    }

    public function save(Request $request)
    {
        $messages_array = [
            'question.*.question.required' => 'من فضلك ادخل اسم السؤال',
            'question.*.question.max' => 'اسم السوال يجب الا يزيد عن 191 حرف',
            'question.*.ans1.required' => 'من فضلك الاجابه الاولى',
            'question.*.ans2.required' => 'من فضلك الاجابه الثانيه',
            'question.*.ans3.required' => 'من فضلك الاجابه الثالثه',
            'question.*.ans4.required' => 'من فضلك الاجابه الرابعه',
            'question.*.ans1.max' => 'الاجابه الاولى يجب الا تزيد عن 191 حرف',
            'question.*.ans2.max' => 'الاجابه الثانيه يجب الا تزيد عن 191 حرف',
            'question.*.ans3.max' => 'الاجابه الثالثه يجب الا تزيد عن 191 حرف',
            'question.*.ans4.max' => 'الاجابه الرابعه يجب الا تزيد عن 191 حرف',
        ];
        foreach ($request->question as $arrIndex => $arrValue) { //add unqiue constraint of answers to each question answers
            $messages_array["ans1.$arrIndex.not_in"] = "لابد ان تكون الاجابه الاولي مختلفه";
            $messages_array["ans2.$arrIndex.not_in"] = "لابد ان تكون الاجابه الثانيه مختلفه";
            $messages_array["ans3.$arrIndex.not_in"] = "لابد ان تكون الاجابه الثالثه مختلفه";
            $messages_array["ans4.$arrIndex.not_in"] = "لابد ان تكون الاجابه الرابعه مختلفه";
            $rules_array ["ans1.$arrIndex"] = ["required", Rule::notIn([$request->ans2[$arrIndex], $request->ans3[$arrIndex], $request->ans4[$arrIndex]]), "max:191"];
            $rules_array ["ans2.$arrIndex"] = ["required", Rule::notIn([$request->ans1[$arrIndex], $request->ans3[$arrIndex], $request->ans4[$arrIndex]]), "max:191"];
            $rules_array ["ans3.$arrIndex"] = ["required", Rule::notIn([$request->ans1[$arrIndex], $request->ans2[$arrIndex], $request->ans4[$arrIndex]]), "max:191"];
            $rules_array ["ans4.$arrIndex"] = ["required", Rule::notIn([$request->ans1[$arrIndex], $request->ans2[$arrIndex], $request->ans3[$arrIndex]]), "max:191"];
            $rules_array["question.$arrIndex"] = ["required", "max:191"];
        }
        request()->validate($rules_array, $messages_array);
        $data = $request->except('_token');
        $data['user_id'] = auth()->id();

        QuestionsPlacementRepository::save($data);
        return redirect()->back()->with('success', 'تمت اضافة الاسئلة بنجاح');
    }

    public function update(Request $request, $id)
    {
        $messages_array = [
            'question.question.required' => 'من فضلك ادخل اسم السؤال',
            'question.question.max' => 'اسم السوال يجب الا يزيد عن 191 حرف',
            'question.ans1.required' => 'من فضلك الاجابه الاولى',
            'question.ans2.required' => 'من فضلك الاجابه الثانيه',
            'question.ans3.required' => 'من فضلك الاجابه الثالثه',
            'question.ans4.required' => 'من فضلك الاجابه الرابعه',
            'question.ans1.max' => 'الاجابه الاولى يجب الا تزيد عن 191 حرف',
            'question.ans2.max' => 'الاجابه الثانيه يجب الا تزيد عن 191 حرف',
            'question.ans3.max' => 'الاجابه الثالثه يجب الا تزيد عن 191 حرف',
            'question.ans4.max' => 'الاجابه الرابعه يجب الا تزيد عن 191 حرف',
        ];

        $messages_array["ans1.not_in"] = "لابد ان تكون الاجابه الاولي مختلفه";
        $messages_array["ans2.not_in"] = "لابد ان تكون الاجابه الثانيه مختلفه";
        $messages_array["ans3.not_in"] = "لابد ان تكون الاجابه الثالثه مختلفه";
        $messages_array["ans4.not_in"] = "لابد ان تكون الاجابه الرابعه مختلفه";
        $rules_array ["ans1"] = ["required", Rule::notIn([$request->ans2, $request->ans3, $request->ans4]), "max:191"];
        $rules_array ["ans2"] = ["required", Rule::notIn([$request->ans1, $request->ans3, $request->ans4]), "max:191"];
        $rules_array ["ans3"] = ["required", Rule::notIn([$request->ans1, $request->ans2, $request->ans4]), "max:191"];
        $rules_array ["ans4"] = ["required", Rule::notIn([$request->ans1, $request->ans2, $request->ans3]), "max:191"];
        $rules_array["question"] = ["required", "max:191"];

        request()->validate($rules_array, $messages_array);
        $data = $request->except('_token');
        $placement = QuestionsPlacementRepository::update($id, $data);

        return redirect()->back()->with('success', 'تم تعديل الاسئلة بنجاح');
    }

    public function destroy($id)
    {
        QuestionsPlacementRepository::delete($id);
        return redirect()->back()->with('success', 'تم  مسح السؤال بنجاح');

    }
}
