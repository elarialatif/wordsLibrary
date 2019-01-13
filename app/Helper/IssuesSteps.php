<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 13/12/2018
 * Time: 03:50 م
 */

namespace app\Helper;


class IssuesSteps
{
    const Open = 0;
    const DoneByEditor = 1;
    const CloseByCreator = 2;

    static function IssuesStep($step)
    {
        if ($step == self::Open) {
            return 'لم يتم العمل ';
        }
        if ($step == self::DoneByEditor) {
            return 'تم الانتهاء ';
        }
        if ($step == self::CloseByCreator) {
            return 'تم الغلق ';
        }

    }
}