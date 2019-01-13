<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 11/12/2018
 * Time: 08:37 ص
 */

namespace App\Helper;


class ArticleLevels
{
    const   NumberOfLevels = 3;
    const   Easy = 0;
    const   Normal = 1;
    const   Hard = 2;
    //article Status of revision
    const   notReview = 0;
    const   Review = 1;

    static function getLevel($level)
    {
        if ($level == self::Easy) {
            return 'سهل';
        }
        if ($level == self::Normal) {
            return 'متوسط';
        }
        if ($level == self::Hard) {
            return 'صعب';
        }
    }
}