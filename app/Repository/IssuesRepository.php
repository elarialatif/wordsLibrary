<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 11/12/2018
 * Time: 04:31 م
 */

namespace App\Repository;


use App\Helper\IssuesSteps;
use App\Models\Issues;

class IssuesRepository
{
    static function all()
    {
        $issues = Issues::all();
        return $issues;
    }

    static function findWhereIn($id, $table)
    {
        $issues = Issues::WhereIn('field_id', $id)->where('table', $table)->get();
        return $issues;
    }

    static function findWhereInAndStatus($id, $table, $step)
    {
        $issues = Issues::WhereIn('field_id', $id)->where(['table' => $table, 'step' => $step])->get();
        return $issues;
    }

    static function find($id)
    {
        $issues = Issues::find($id);
        return $issues;
    }

    static function save($request)
    {
        $issue = new Issues();
        $issue->user_id = auth()->id();
        $issue->field_id = $request->field_id;
        $issue->name = $request->name;
        $issue->title = $request->title;
        $issue->table = $request->table;
        if (isset($request->type)) {
            $issue->type = $request->type;
        }
        $issue->step = IssuesSteps::Open;
        $issue->save();
    }

    static function getAllIssuesForArticle($field_id, $table, $step = -1, $step2 = -1, $user_id = null)
    {
        $query = Issues::where(['table' => $table, 'field_id' => $field_id]);

        if ($step != -1 && $step2 == -1) {

            $query->where('step', $step);
        }
        if ($step2 != -1 && $step2 != -1) {

            $query->whereIn('step', [$step2, $step]);
        }
        if ($user_id && $user_id != null) {
            $query->where('user_id', $user_id);
        }

        $issues = $query->get();

        return $issues;
    }


    static function getAllIssuesForQuestion($field_id, $table, $step, $user_id = null)
    {
        $issues = Issues::where(['table' => $table])->where('step', '!=', $step)->whereIn('field_id', $field_id);
        if ($user_id && $user_id != null) {
            $issues->where('user_id', $user_id);
        }
        $issues = $issues->get();
        return $issues;
    }

    static function getIssuesForQuestion($field_id, $table, $step, $user_id = null)
    {
        $issues = Issues::where(['table' => $table, 'step' => $step])->whereIn('field_id', $field_id);
        if ($user_id && $user_id != null) {
            $issues->where('user_id', $user_id);
        }
        $issues = $issues->get();
        return $issues;
    }

    static function ChangeStep($id, $step)
    {
        $issue = Issues::find($id);
        $issue->step = $step;
        $issue->save();
        return $issue;
    }

    static function update($id, $data)
    {
        $issues = Issues::find($id);
        $issues = $issues->update($data);
        return $issues;
    }

    static function updateArray($id, $data)
    {
        $issues = Issues::whereIn('id', $id)->update($data);
        return $issues;
    }

    static function delete($id)
    {
        try {
            Issues::destroy($id);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }
}