<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 03/12/2018
 * Time: 12:24 م
 */

namespace App\Helper;


class UsersTypes
{
    const SUPERADMIN = 0;
    const ADMIN = 1;
    const EDITOR = 2;
    const LISTMAKER = 3;
    const LISTANALYZER = 4;
    const REVIEWER = 5;
    const QuestionCreator = 6;
    const QuestionReviewer = 7;
    const Languestic = 8;
    const Sound = 9;
    const quality = 10;
    const PlacementTestEditor = 11;

    const ArrayOfPermission = array(
        '0' => 'الادراة',
        '1' => 'رئيس',
        '2' => 'مدخل مقالات',
        '3' => 'معد مواضيع',
        '4' => 'محلل مقالات',
        '5' => 'مراجع محتوى',
        '6' => 'مدخل اسئلة',
        '7' => 'مراجع اسئلة',
        '8' => 'مراجع لغوى',
        '9' => 'تسجيل صوت ',
        '10' => 'الجودة',
        '11' => 'مدخل اختبارات',
    );
}