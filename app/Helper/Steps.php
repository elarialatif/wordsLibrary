<?php
/**
 * Created by PhpStorm.
 * User: badr.abed
 * Date: 04/12/2018
 * Time: 02:30 م
 */

namespace App\Helper;


use App\Models\LogTime;

class Steps
{
    const UPLOADING_FILE = 0;
    const ANALYZING_FILE = 1;
    const INSERTING_ARTICLE = 2;
    const REVIEW_ARTICLE = 3;
    const reSendToEditorFormReviewer = 4;
    const reSendToReviewerFormEditor = 5;
//    const Create_Question = 6;
//    const Review_Question = 7;
//    const ResendToQuestionCreator = 8;
//    const ResendToQuestionReviewer = 9;
    const Languestic = 10;
    const ResendToLanguestic = 11;
    const Sound = 12;
    const ResendToSound = 13;
    const Quality = 14;
    const ResendToQuality = 15;
    const Publish = 16;
    const numberOFSteps = 16;
    const ArrayOfSteps = array(
        '0' => 'رفع ملف ',
        '1' => 'تحليل ملف',
        '2' => 'إدخال المقالات',
        '3' => 'مراجعه المقالات',
        '4' => 'إعادة إرسال إلى المحرر',
        '5' => 'إعادة إرسال إلى المراجع',
//        '6' => 'إدخال الأسئلة',
//        '7' => 'مراجعه الأسئلة',
//        '8' => 'إعادة إرسال إلى إلى محرر الأسئلة',
//        '9' => 'إعادة إرسال إلى مراجع الأسئلة ',
        '10' => 'مراجعه لغويه ',
        '11' => 'إعادة إرسال إلى المراجعة لغويه   ',
        '12' => 'تسجيل الصوت ',
        '13' => 'إعادة الي مسجل الصوت',
        '14' => 'الجودة ',
        '15' => 'إعادة إرسال إلى الجودة ',
        '16' => ' تم  النشر ',
    );

    static function step($step)
    {
        if ($step == self::UPLOADING_FILE) {
            return 'جارى رفع الملف';
        }
        if ($step == self::ANALYZING_FILE) {
            return 'جارى تحليل  الملف';
        }
        if ($step == self::INSERTING_ARTICLE) {
            return 'جارى إدخال المقال ';
        }
        if ($step == self::REVIEW_ARTICLE) {
            return 'جارى مراجعه المقال ';
        }
//        if ($step == self::Create_Question) {
//            return 'جارى إدخال الأسئلة ';
//        }
//        if ($step == self::Review_Question) {
//            return 'جارى مراجعه الأسئلة ';
//        }
        if ($step == self::reSendToEditorFormReviewer) {
            return ' تم رفضه من مراجع المحتوى';
        }
        if ($step == self::Quality) {
            return 'جارى فحص الجوده ';
        }
//        if ($step == self::ResendToQuestionCreator) {
//            return 'تم رفضه من مراجع الأسئلة';
//        }
//        if ($step == self::ResendToQuestionReviewer) {
//            return 'إعادة الي مراجع الأسئلة';
//        }
        if ($step == self::ResendToSound) {
            return 'إعادة الي مسجل الصوت ';
        }
        if ($step == self::ResendToQuality) {
            return 'إعادة الي الجودة ';
        }
        if ($step == self::Publish) {
            return 'تم النشر ';
        }
    }

    static function SaveLogRow($name, $type, $table_name, $row_id)
    {
        $newRow = new LogTime();
        $newRow->name = $name;
        $newRow->type = $type;
        $newRow->row_id = $row_id;
        $newRow->table_name = $table_name;
        $newRow->user_id = auth()->id();
        $newRow->save();
    }

}