<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 8/30/2018
 * Time: 2:23 PM
 */

namespace App\Helper;

class TABLES_NAMES_IN_ARABIC
{


    const categories = 'التصنيفات';
    const article = 'المقالات';
    const article_files = 'ملفات المقالات';
    const country = 'الدولة';
    const assign_tasks = 'تكليف المهام';
    const issues = 'الملاحظات';
    const content_lists = 'الموضوعات';
    const grades = 'الصفوف';
    const links = 'اللينكات';
    const list_categories = 'تصنيفات الموضوعات';
    const questions = 'الانشطه';
    const sounds = 'ملفات الصوت';
    const users = 'المستخدمين';
    const vocabs = 'المصطلحات';


    static function getTableNameInArabic($table)
    {
        $array = array(

            'المقالات' => 'article',
            'ملفات المقالات' => 'article_files',
            'الدولة' => 'country',
            'تكليف المهام' => 'assign_tasks',
            'الملاحظات' => 'issues',
            'الموضوعات' => 'content_lists',
            'الصفوف' => 'grades',
            'اللينكات' => 'links',
            'تصنيفات الموضوعات' => 'list_categories',
            'الانشطه' => 'questions',
            'ملفات الصوت' => 'sounds',
            'المستخدمين' => 'users',
            'المصطلحات' => 'vocabs',
        );
        $key = array_search($table, $array);
        return $key;
    }
}
