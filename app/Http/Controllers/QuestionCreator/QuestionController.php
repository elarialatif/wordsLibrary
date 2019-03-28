<?php

namespace App\Http\Controllers\QuestionCreator;

use App\Helper\IssuesSteps;
use App\Helper\UsersTypes;
use App\Http\Requests\Question;
use App\Models\AssignTask;
use App\Repository\IssuesRepository;
use App\Repository\NotificationRepository;
use App\Repository\UserRateRepository;
use App\Repository\UsersRepository;
use Carbon\Carbon;
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
        $list = ContentList::where('step', Steps::Create_Question)->whereIn('id', $tasks)->get();
//        dd($list);
        return view('questionCreator.question.myList', compact('list'));
    }

    public function backFromReviewer()
    {
        $tasks = TaskRepository::userTasks(Steps::Create_Question, '\App\Models\ContentList');

        $list = ContentList::where('step', Steps::ResendToQuestionCreator)->whereIn('id', $tasks)->get();
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
                    return redirect()->back()->withErrors('هذا الموضوع تابع لمستخدم آخر ');
                }
            } elseif (!$task) {
                TaskRepository::save($artical->list_id, Steps::Create_Question);
                //ContentListsRepository::updateStep($artical->list_id, Steps::Create_Question);
            }
        }
        $list = ContentList::find($artical->list_id);
        if ($list->step != Steps::Create_Question && $list->step != Steps::ResendToQuestionCreator) {
            return redirect('question/myList')->withErrors('غير مسموح لك الدخول إلى هنا');
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
            'question.*.ans1.required' => 'من فضلك الإجابة الأولى',
            'question.*.ans2.required' => 'من فضلك الإجابة الثانية',
            'question.*.ans3.required' => 'من فضلك الإجابة الثالثة',
            'question.*.ans4.required' => 'من فضلك الإجابة الرابعة',
            'question.*.ans1.max' => 'الإجابة الأولى يجب الا تزيد عن 191 حرف',
            'question.*.ans2.max' => 'الإجابة الثانية يجب الا تزيد عن 191 حرف',
            'question.*.ans3.max' => 'الإجابة الثالثة يجب الا تزيد عن 191 حرف',
            'question.*.ans4.max' => 'الإجابة الرابعة يجب الا تزيد عن 191 حرف',
        ];
        foreach ($request->question as $arrIndex => $arrValue) { //add unqiue constraint of answers to each question answers
            $messages_array["ans1.$arrIndex.not_in"] = "لابد ان تكون الإجابة الأولى مختلفه";
            $messages_array["ans2.$arrIndex.not_in"] = "لابد ان تكون الإجابة الثانية مختلفه";
            $messages_array["ans3.$arrIndex.not_in"] = "لابد ان تكون الإجابة الثالثة مختلفه";
            $messages_array["ans4.$arrIndex.not_in"] = "لابد ان تكون الإجابة الرابعة مختلفه";
            $rules_array ["ans1.$arrIndex"] = ["required", Rule::notIn([$request->ans2[$arrIndex], $request->ans3[$arrIndex], $request->ans4[$arrIndex]]), "max:191"];
            $rules_array ["ans2.$arrIndex"] = ["required", Rule::notIn([$request->ans1[$arrIndex], $request->ans3[$arrIndex], $request->ans4[$arrIndex]]), "max:191"];
            $rules_array ["ans3.$arrIndex"] = ["required", Rule::notIn([$request->ans1[$arrIndex], $request->ans2[$arrIndex], $request->ans4[$arrIndex]]), "max:191"];
            $rules_array ["ans4.$arrIndex"] = ["required", Rule::notIn([$request->ans1[$arrIndex], $request->ans2[$arrIndex], $request->ans3[$arrIndex]]), "max:191"];
            $rules_array["question.$arrIndex"] = ["required"];
        }
        request()->validate($rules_array, $messages_array);
        $question = $request->except('_token');
        $question = QuestionsRepository::save($question);
        if($request->submitType && $request->submitType=='lastQuestion' ){
            return redirect(url('question/myList'))->with('success', 'تمت الإضافة بنجاح ');
        }
        else{
            $artical = Article::where('id', $question[0]->artical_id)->first();
            return view('questionCreator.question.createBefore', compact('artical'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($artical_id, $page = 'myList')
    {
        $questionType=new Article();

        $questions=\App\Models\Question::where(['artical_id'=>$artical_id,'type'=>$questionType->getNormalArticleValue()])->get();
        $questionStretch=\App\Models\Question::where(['artical_id'=>$artical_id,'type'=>$questionType->getStretchArticleValue()])->get();
        $artical = Article::where('id', $artical_id)->first();
        $list = ContentList::find($artical->list_id);
        if ($list == null) {
            return redirect()->back()->with('error', 'المقال غير موجود');
        }
        return view('questionCreator.question.show', compact('questions','questionStretch', 'page', 'artical'));
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
        $messages_array = [
            'question.question.required' => 'من فضلك ادخل اسم السؤال',
            'question.question.max' => 'اسم السوال يجب الا يزيد عن 191 حرف',
            'question.ans1.required' => 'من فضلك الإجابة الأولى',
            'question.ans2.required' => 'من فضلك الإجابة الثانية',
            'question.ans3.required' => 'من فضلك الإجابة الثالثة',
            'question.ans4.required' => 'من فضلك الإجابة الرابعة',
            'question.ans1.max' => 'الإجابة الأولى يجب الا تزيد عن 191 حرف',
            'question.ans2.max' => 'الإجابة الثانية يجب الا تزيد عن 191 حرف',
            'question.ans3.max' => 'الإجابة الثالثة يجب الا تزيد عن 191 حرف',
            'question.ans4.max' => 'الإجابة الرابعة يجب الا تزيد عن 191 حرف',
        ];

        $messages_array["ans1.not_in"] = "لابد ان تكون الإجابة الأولى مختلفه";
        $messages_array["ans2.not_in"] = "لابد ان تكون الإجابة الثانية مختلفه";
        $messages_array["ans3.not_in"] = "لابد ان تكون الإجابة الثالثة مختلفه";
        $messages_array["ans4.not_in"] = "لابد ان تكون الإجابة الرابعة مختلفه";
        $rules_array ["ans1"] = ["required", Rule::notIn([$request->ans2, $request->ans3, $request->ans4]), "max:191"];
        $rules_array ["ans2"] = ["required", Rule::notIn([$request->ans1, $request->ans3, $request->ans4]), "max:191"];
        $rules_array ["ans3"] = ["required", Rule::notIn([$request->ans1, $request->ans2, $request->ans4]), "max:191"];
        $rules_array ["ans4"] = ["required", Rule::notIn([$request->ans1, $request->ans2, $request->ans3]), "max:191"];
        $rules_array["question"] = ["required"];

        request()->validate($rules_array, $messages_array);
        $question = $request->except('_token');
        $question = QuestionsRepository::update($id, $question);
        return redirect()->back()->with('success', 'تم التعديل بنجاح ');
    }

    public function send($list_id)
    {

        $questions = QuestionsRepository::findIds('list_id', $list_id);
        $currentIssues = IssuesRepository::findWhereIn($questions, 'question');
        $issues = IssuesRepository::getIssuesForQuestion($questions, 'question', IssuesSteps::Open);

        if ($currentIssues->count() > 0) {
            if ($issues->count() > 0) {
                return redirect()->back()->withErrors('يوجد اسئله لم يتم الانتهاء من حل مشاكلها');
            }
            ContentListsRepository::updateStep($list_id, Steps::ResendToQuestionReviewer);
            //Notification/////
            NotificationRepository::notify($list_id, Steps::Review_Question);
            ///end Notification////
            $user_id = TaskRepository::findWhereAndStep('list_id', $list_id, Steps::Review_Question);
            $user = UsersRepository::find($user_id);
            $name = Carbon::now() . "بتاريخ" . $user->name . "تمت إعادة الإرسال إلى مراجع الأسئلة ";
            Steps::SaveLogRow($name, 'إعادة إرسال', 'content_lists', $list_id);
            $data['active'] = 1;
            UserRateRepository::update(auth()->id(), $list_id, $data);
            return redirect()->back()->with('success', 'تم إعادة الإرسال الي مراجع الأسئلة بنجاح ');
        }
        $data['user_id'] = auth()->id();
        $data['list_id'] = $list_id;
        $data['active'] = 1;
        UserRateRepository::save($data);
        ContentListsRepository::updateStep($list_id, Steps::Review_Question);
        $name = Carbon::now() . " تمت إعادة الإرسال إلى مراجع الأسئلة بتاريخ ";
        Steps::SaveLogRow($name, ' إرسال', 'content_lists', $list_id);
        return redirect()->back()->with('success', 'تم الإرسال الي مراجع الأسئلة بنجاح ');
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
