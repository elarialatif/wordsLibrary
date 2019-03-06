<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 11/12/2018
 * Time: 08:37 ص
 */

namespace App\Helper;


class QuestionType
{
    const   beforeQuestion = 0;
    const   afterQuestion = 1;

    static function getQuestion($question)
    {
        if ($question == self::beforeQuestion) {
            return 'سؤال قبلي';
        }
        if ($question == self::afterQuestion) {
            return 'سؤال بعدي';
        }
    }
}