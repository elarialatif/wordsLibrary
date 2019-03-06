<?php

namespace App\Models;

use App\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Article extends Model
{
    protected $table = 'article';

    private $normalArticle = "Normal";
    private $stretchArticle = "Stretch";


    private $Vocabulary = "Vocab";

    public function getNormalArticleValue()
    {
        return $this->normalArticle;
    }

    public function getStretchArticleValue()
    {
        return $this->stretchArticle;
    }

    public function getVocabularyValue()
    {
        return $this->Vocabulary;
    }

    public function lists()
    {
        return $this->belongsTo('App\Models\ContentList', 'list_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public static function boot()
    {
        parent::boot();

        Article::observe(UserActionsObserver::class);
    }
}
