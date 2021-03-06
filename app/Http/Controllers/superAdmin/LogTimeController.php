<?php

namespace App\Http\Controllers\superAdmin;

use App\Helper\UsersTypes;
use App\Http\Controllers\Controller;

use App\Models\Article;
use App\Models\ArticleFiles;
use App\Models\ContentList;
use App\Models\LogTime;
use App\Models\Question;
use App\Models\Sound;
use Illuminate\Http\Request;
use DateTime;

class LogTimeController extends Controller
{
    /**
     * @param $arry
     * @return bool
     * @todo saveLogesTimesForEveryActionInDataBase
     */
    static function saveLogesTimes($arry)
    {
        $row = new LogTime();
        $row->name = $arry['name'];
        $row->user_id = auth()->id();
        $row->type = $arry['type'];
        $row->table_name = $arry['table_name'];
        $row->row_id = $arry['row_id'];
        $row->save();
        return true;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {
        $logtimes = self::getDetailsOfLogtimesRows();

        return view('superadmin.logtime.index')->with(compact('logtimes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function logfiltertime(Request $request)
    {
        $timeStart = $request->timeStart;
        $timeEnd = $request->timeEnd;
        $table = array($request->table);

        $arr = self::getDetailsOfLogtimesRows($timeStart, $timeEnd, $table);

        return response($arr);
    }

    static function getDetailsOfLogtimesRows($timeStart = null, $timeEnd = null, $table = null, $filed_id = null)
    {
        if ($table[0] == "content_lists") {
            $table = array('article', 'article_files', 'sounds', 'questions', 'content_lists');
        }

        $res = LogTime::orderBy('created_at', 'desc')->paginate(1500);
        if ($filed_id != null) {

            $table = array('article', 'article_files', 'sounds', 'questions', 'content_lists');
            $articles = Article::where('list_id', $filed_id)->get()->pluck('id')->toArray();
            $questions = Question::where('list_id', $filed_id)->get()->pluck('id')->toArray();
            $article_files = ArticleFiles::where('list_id', $filed_id)->get()->pluck('id')->toArray();
            $Sounds = Sound::whereIn('article_id', $articles)->get()->pluck('id')->toArray();
        //    $FinalArray = array_merge($articles, $questions, $article_files, $Sounds);

            $res = LogTime::with('user')->orderBy('created_at', 'desc')->where(['row_id' => $filed_id, 'table_name' => 'content_lists'])
                ->orWhere(function ($query) use ($questions) {
                    $query->WhereIn('row_id', $questions)->where('table_name', 'questions');
                })
                ->orWhere(function ($query) use ($article_files) {
                    $query->WhereIn('row_id', $article_files)->where('table_name', 'article_files');
                })
                ->orWhere(function ($query ) use ($Sounds) {
                    $query->WhereIn('row_id', $Sounds)->where('table_name', 'sounds');
                })
                ->orWhere(function ($query )  use ($articles) {
                    $query->WhereIn('row_id', $articles)->where('table_name', 'article');
                })->get();


        }
        if ($timeStart != null && $timeEnd != null && $table[0] != 'all') {

            $res = LogTime::with('user')->orderBy("id", "desc")->whereBetween('created_at', array($timeStart . '%', date('Y-m-d', strtotime($timeEnd . ' + 1 days')) . '%'))->whereIn('table_name', $table)->get();
        }
        if ($timeStart != null && $timeEnd != null && $table[0] == 'all') {

            $res = LogTime::with('user')->orderBy("id", "desc")->whereBetween('created_at', array($timeStart . '%', date('Y-m-d', strtotime($timeEnd . ' + 1 days')) . '%'))->get();
        }
        if ($timeStart == null && $timeEnd != null && $table[0] == 'all') {
            $res = LogTime::with('user')->orderBy("id", "desc")->where('created_at', '<=', date('Y-m-d', strtotime($timeEnd . ' + 1 days')))->get();

        }
        if ($timeStart == null && $timeEnd != null && $table[0] != 'all') {
            $res = LogTime::with('user')->orderBy("id", "desc")->where('created_at', '<=', date('Y-m-d', strtotime($timeEnd . ' + 1 days')))->whereIn('table_name', $table)->get();

        }
        $arr = [];

        foreach ($res as $data) {
            if( $data->user->role==6|| $data->user->role==7){
                continue;
            }
            $userPermission = UsersTypes::ArrayOfPermission[ $data->user->role];
            $date = $data->created_at->format('Y:m:d') . " الساعه " . $data->created_at->format('H');
            $table_name = \App\Helper\TABLES_NAMES_IN_ARABIC::getTableNameInArabic($data->table_name);
            if ($data->name != 'null') {

                $name = $data->name;
                $arr[] = array('name' => $name, 'user_name' => $data->user->name . '    رقم  ' . $data->user->id . ' ' . ' ' . $userPermission . ' ', 'type' => $data->type, 'created_at' => $date, 'table' => $table_name);
                continue;

            }
            $table = $data->table_name;


            $row = \Illuminate\Support\Facades\DB::table($table)->where('id', $data->row_id)->first();

            $name = ' رقم ' . $data->row_id;
//            if ($data->name != 'null') {
//                $name = 'رقم' . $data->row_id . '(' . $data->name . ')';
//            }
            $row = \Illuminate\Support\Facades\DB::table($table)->where('id', $data->row_id)->first();

            if (isset($row) && $table == 'content_lists') {
                $name = $row->list . ' رقم ' . $data->row_id;
            }
            if (isset($row) && $table != 'content_lists' && isset($row->list_id)) {

                $list = ContentList::withTrashed()->find($row->list_id);
                $name = ' رقم ' . $data->row_id . '  للموضوع  ' . $list->list . ' رقم ' . $list->id;

            }
            if (isset($row) && $table != 'content_lists' && isset($row->name)) {


                $name = ' رقم ' . $data->row_id . '    ' . $row->name;

            }

            $arr[] = array('name' => $name, 'user_name' => $data->user->name . '    رقم  ' . $data->user->id . ' ' . ' ' . $userPermission . ' ', 'type' => $data->type, 'created_at' => $date, 'table' => $table_name);
        }

        return $arr;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\LogTime $logTime
     * @return \Illuminate\Http\Response
     */
    public function show(LogTime $logTime)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LogTime $logTime
     * @return \Illuminate\Http\Response
     */
    public function edit(LogTime $logTime)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\LogTime $logTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LogTime $logTime)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LogTime $logTime
     * @return \Illuminate\Http\Response
     */
    public function destroy(LogTime $logTime)
    {
        //
    }


}
