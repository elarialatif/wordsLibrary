<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 04/12/2018
 * Time: 12:21 م
 */

namespace App\Repository;


use App\Models\ArticleFiles;
use App\Models\AssignTask;
use App\Models\ContentList;

class TaskRepository
{
    static function save($list_id, $step)
    {
        $data['user_id'] = auth()->id();
        $data['list_id'] = $list_id;
        $data['step'] = $step;
        AssignTask::create($data);
    }

    static function findWhere($att, $value)
    {
        $task = AssignTask::where($att, $value)->first();
        return $task;
    }

    static function findAllWhere($att, $value)
    {
        $task = AssignTask::where($att, $value)->get();
        return $task;
    }
    static function findTasksOfUser($step)
    {

        $tasks = AssignTask::where(['step' => $step, 'user_id' => auth()->id()])->get()->pluck('list_id')->toArray();
        $lists = ArticleFiles::whereIn('list_id', $tasks)->get();
        return $lists;
    }

    static function findTasksOfallUser($step)
    {
        $tasks = AssignTask::where(['step' => $step])->get()->pluck('list_id')->toArray();
        return $tasks;
    }

    static function userTasks($step, $model=null)
    {

        $tasks = AssignTask::where(['step' => $step, 'user_id' => auth()->id()])->get()->pluck('list_id')->toArray();
       // $lists = $model::whereIn('id', $tasks)->where('step',$step)->get();
        return $tasks;
    }


   static function findWhereAndStep($att, $value, $step)
    {

        $task = AssignTask::where([$att => $value, 'step' => $step])->first();
        if ($task) {
            $array = $task->toArray();

            return $array['user_id'];
        } else return null;
    }
    static function filter($data){
        $query = AssignTask::where('user_id',auth()->id());
            if ($data['grade_id'] != null &&$data['grade_id'] !='null' && $data['grade_id'] !='all') {
                $lists = ContentList::where('grade_id', $data['grade_id'])->get()->pluck('id')->toArray();
                $query->whereIn('list_id',$lists);
            }
            if ($data['date'] != null &&$data['date'] !='null') {
               $query->whereDate('created_at','=',$data['date']);
            }
        $list = $query->get();
        return $list;
    }
}