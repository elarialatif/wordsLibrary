<?php

namespace App\Http\Controllers\QuestionCreator;

use App\Helper\IssuesSteps;
use App\Helper\UsersTypes;
use App\Http\Requests\Question;
use App\Models\AssignTask;
use App\Repository\IssuesRepository;
use App\Repository\NotificationRepository;
use Illuminate\Notifications\Notification;
use StreamLab\StreamLabProvider\Facades\StreamLabFacades;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helper\Steps;
use App\Models\Article;
use App\Models\ContentList;
use App\Repository\ContentListsRepository;
use App\Repository\GradesRepository;
use App\Repository\QuestionsRepository;
use App\Repository\TaskRepository;
use Illuminate\Validation\Rule;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        $current = AssignTask::where('step', Steps::Create_Question)->get()->pluck('list_id')->toArray();
        $list = ContentList::where('step', Steps::Create_Question)->whereNotIn('id', $current)->get();
        return view('questionCreator.question.index', compact('list'));
    }

    public function index()
    {

        $tasks = TaskRepository::userTasks(Steps::Create_Question, '\App\Models\ContentList');
        $list = ContentList::where('step', Steps::Create_Question)->whereIn('id',$tasks)->get();
//        dd($list);
        return view('questionCreator.question.myList', compact('list'));
    }
    public function backFromReviewer()
    {
        $tasks = TaskRepository::userTasks(Steps::Create_Question, '\App\Models\ContentList');

        $list = ContentList::where('step', Steps::ResendToQuestionCreator)->whereIn('id',$tasks)->get();
//        dd($list);
        return view('questionCreator.question.backContent', compact('list'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($artical_id)
    {

        $artical = Article::where('id', $artical_id)->first();
        if (auth()->user()->role != UsersTypes::SUPERADMIN && auth()->user()->role != UsersTypes::ADMIN) {
            $task = AssignTask::where(['list_id' => $artical->list_id, 'step' => Steps::Create_Question])->first();
            if ($task) {
                if ($task->user_id != auth()->id()) {
                    return redirect()->back()->withErrors('هذا الموضوع تابع لمستخدم اخر ');
                }
            } elseif (!$task) {
                TaskRepository::save($artical->list_id, Steps::Create_Question);
                //ContentListsRepository::updateStep($artical->list_id, Steps::Create_Question);
            }
        }
        $list = ContentList::find($artical->list_id);
        if ($list->step != Steps::Create_Question && $list->step != Steps::ResendToQuestionCreator) {
            return redirect('question/myList')->withErrors('غير مسموح لك الدخول الى هنا');
        }
        return view('questionCreator.question.create', compact('artical'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
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
            $rules_array["question.$arrIndex"]=["required","max:191"];
        }
        request()->validate($rules_array,$messages_array);
        $question = $request->except('_token');
        $question = QuestionsRepository::save($question);
        return redirect(url('question/myList'))->with('success', 'تم الاضافه بنجاح ');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($artical_id,$page = 'myList')
    {
        $questions = QuestionsRepository::findWhere('artical_id', $artical_id);
        $artical = Article::where('id', $artical_id)->first();
        return view('questionCreator.question.show', compact('questions','page','artical'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = QuestionsRepository::find($id);
        return view('questionCreator.question.edit', compact('question'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $question = $request->except('_token');
        $question = QuestionsRepository::update($id, $question);
        return redirect()->back()->with('success', 'تم التعديل بنجاح ');
    }

    public function send($list_id)
    {

        $questions=QuestionsRepository::findIds('list_id',$list_id);
        $currentIssues=IssuesRepository::findWhereIn($questions,'question');
        $issues=IssuesRepository::getIssuesForQuestion( $questions,'question',IssuesSteps::Open);

        if($currentIssues->count()>0){
            if($issues->count()>0){
                return redirect()->back()->withErrors( 'يوجد اسئله لم يتم الانتهاء من حل مشاكلها');
            }
            ContentListsRepository::updateStep($list_id, Steps::ResendToQuestionReviewer);
            //Notification/////
            NotificationRepository::notify($list_id,Steps::Review_Question);
            ///end Notification////
            return redirect()->back()->with('success', 'تم اعاده الارسال الي مراجع الاسئله بنجاح ');
        }
        ContentListsRepository::updateStep($list_id, Steps::Review_Question);
        return redirect()->back()->with('success', 'تم الارسال الي مراجع الاسئله بنجاح ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        QuestionsRepository::delete($id);
        return redirect(url('question/myList'))->with('success', 'تم المسح بنجاح ');
    }
}
