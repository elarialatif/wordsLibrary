<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Auth::routes();
Route::group(['middleware' => 'auth'], function () {
    Route::get('profileFilter/{grade_id}/{date}', 'superAdmin\UserController@filter');
    Route::get('/', function () {
        return redirect('/home');
    });
    Route::get('notify', 'HomeController@notify');
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');//add to fix an issues

    Route::get('profile', 'superAdmin\UserController@profile');
    Route::post('profile/{id}', 'superAdmin\UserController@updateProfile');
    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/tashkel', 'WordController@teshkelGet');
    Route::get('/MarkAllSeen', function () {
        auth()->user()->notifications->markAsRead();
    });
    Route::post('/tashkel', 'WordController@teshkelpost');
    Route::get('update/article/status/{article_id}', function () {
        $article_id = \Illuminate\Support\Facades\Route::current()->article_id;

        \App\Repository\ArticalRepository::updateArticleStatusToReview($article_id);
        return redirect()->back()->with('success', 'تمت المراجعة بنجاح');
    });
    Route::post('issues/create', 'IssuesController@save');
    Route::post('issues/edit/{id}', 'IssuesController@edit');
    Route::get('issues/delete/{id}', 'IssuesController@destroy');
    Route::get('issues/chang/step/{artical_id}/{step}', 'IssuesController@ChangeStep');
    Route::post('editor/save/article', 'editor\EditorController@saveArticle');
    Route::post('question/edit/{id}', 'QuestionCreator\QuestionController@update');

});

Route::group(['middleware' => 'editor'], function () {
    /////upload Artical/////
    Route::get('saveUploadArticle/{list_id}', 'ArticalController@uploadArticleFile');
    Route::get('exportcsv', 'ArticalController@exportCSV');
    Route::post('saveUploadArticle', 'ArticalController@saveUploadedArticleFile');
    Route::get('saveUploadArticleFilter', 'ArticalController@filter');


    //get Lists by grade and country when upload file
    Route::get('Ajax/getLists/{grade_id}/{country_id}', 'ContentListController@AjaxGetLists');

    Route::group(['namespace' => 'editor', 'prefix' => 'editor'], function () {
        Route::get('index', 'EditorController@index');
        Route::get('mylists', 'EditorController@myLists');
        Route::get('add/article/{file_id}/{level_id}/{page?}', 'EditorController@createArticle');
        //   Route::post('save/article', 'EditorController@saveArticle');
        Route::get('sendArticleOfListToReviewer/{list_id}', 'EditorController@sendArticleOfListToReviewer');
        Route::get('refused/lists', 'EditorController@refusedLists');
        Route::get('reSendListOfArticleToReviewer/{list_id}', 'EditorController@reSendListOfArticleToReviewer');
    });
});
Route::group(['middleware' => 'listmaker'], function () {
    ///ContentLists//////////

    Route::get('createList', 'ContentListController@create');
    Route::post('createList', 'ContentListController@save');
    Route::get('editList/{id}', 'ContentListController@edit');
    Route::post('editList/{id}', 'ContentListController@update');
    Route::get('deleteList/{id}', 'ContentListController@delete');

    Route::get('showLists/{grade_id}', 'ContentListController@listsFilter');

    ///levels///
    Route::resource('levels', 'LevelController');
    Route::get('levels/delete/{id}', 'LevelController@destroy');
    ///grades///
    Route::resource('grades', 'GradeController');
    Route::get('grades/delete/{id}', 'GradeController@destroy');
    /////

});
Route::group(['middleware' => 'listanalyzer'], function () {
    ////createWords////
    Route::get('createWords', 'WordController@create');
    Route::post('createWords', 'WordController@save');
    Route::get('allWords', 'WordController@index');
    Route::get('wordsFilter/{grade_id}', 'WordController@wordsFilter');
    Route::post('Ajax/createWords', 'WordController@AjaxSave');

    //analyze files

    Route::get('analysisUploadFiles/{file_id}', 'ArticalController@analysisUploadFiles');
    Route::group(['namespace' => 'analyzer', 'prefix' => 'analyzer'], function () {
        Route::get('index', 'AnalyzerController@index');
        Route::get('myLists', 'AnalyzerController@myLists');
        Route::get('SendListToEditor/{list_id}/{step}', 'AnalyzerController@SendListToEditor');

    });

});
Route::group(['middleware' => 'reviewer', 'namespace' => 'reviewer', 'prefix' => 'reviewer'], function () {
    Route::get('index', 'ReviewerController@index');
    Route::get('view/article/{list_id}/{level}/{page?}', 'ReviewerController@viewArticle');
    Route::get('mylists/{page?}', 'ReviewerController@myLists');
    Route::get('sendto/create/question/{list_id}', 'ReviewerController@SendToCreateQuestion');
    Route::get('reSendTo/editor/{list_id}', 'ReviewerController@reSendToEditor');
    Route::get('resending/lists', 'ReviewerController@resendingLists');
});
Route::get('allLists', 'ContentListController@index')->middleware('listmaker:role');
Route::get('getGradeList/{level_id}', 'ContentListController@getGradeList')->middleware('listmaker:role');
Route::post('listsFilter', 'ContentListController@listsFilter')->middleware('listmaker:role');
Route::group(['middleware' => 'superadmin'], function () {
    Route::get('allFiles', 'ArticalController@allFiles');
    Route::get('filterFiles/{grade_id}', 'ArticalController@filterFiles');
    Route::get('Rates/{userRole}/{time}', 'HomeController@Rates');
    Route::group(['namespace' => 'superAdmin', 'middleware' => 'superadmin'], function () {
        Route::resource('users', 'UserController');
        Route::get('users/delete/{user_id}', 'UserController@destroy');
        Route::get('viewArticle/{article_id}', 'SuperAdminController@viewArticle');
        Route::post('add/school', 'SchoolController@save');
        Route::get('add/school', 'SchoolController@create');
        Route::get('view/schools', 'SchoolController@index');
        Route::get('edit/school/{school_id}', 'SchoolController@edit');
        Route::post('edit/school/{school_id}', 'SchoolController@update');

        Route::resource('categories', 'CategoriesController')->except([
            'destroy'
        ]);
        Route::get('archive/{id}', 'UserController@userArchive');
        Route::get("categories/{id}/delete", "CategoriesController@destroy");
        Route::get("log", "LogTimeController@index");
        Route::get('logfiltertime', ['as' => 'logfiltertime', 'uses' => 'LogTimeController@logfiltertime']);
        // show is reserved to another routes written bello

        Route::resource('country', 'CountryController');
        Route::get('country/delete/{id}', 'CountryController@destroy');
    });
    // Registration Routes...
    Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'Auth\RegisterController@register');
});

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Password Reset Routes...

////QUESTIONCREATOR///
Route::group(['middleware' => 'questionCreator', 'namespace' => 'QuestionCreator', 'prefix' => 'question'], function () {
    Route::get('', 'QuestionController@home');
    Route::get('create/{artical_id}', 'QuestionController@create');
    Route::post('create/{artical_id}', 'QuestionController@store');
    Route::get('show/{artical_id}/{page?}', 'QuestionController@show');
    Route::get('edit/{id}', 'QuestionController@edit');
//    Route::post('edit/{id}', 'QuestionController@update');
    Route::get('sendToReviwer/{list_id}', 'QuestionController@send');
    Route::get('myList', 'QuestionController@index');
    Route::get('resend', 'QuestionController@backFromReviewer');
    Route::get('delete/{id}', 'QuestionController@destroy');
});
/// QuestionReviewer
Route::group(['middleware' => 'questionReviewer', 'namespace' => 'QuestionReviewer', 'prefix' => 'questionReviewer'], function () {
    Route::get('', 'QuestionReviewerController@home');
    Route::get('myList', 'QuestionReviewerController@index');
    Route::get('review/{artical_id}/{page?}', 'QuestionReviewerController@review');
    Route::get('done/{artical_id}', 'QuestionReviewerController@done');
    Route::get('send/{list_id}', 'QuestionReviewerController@send');
    Route::get('resend', 'QuestionReviewerController@backFromCreator');

});
Route::group(['middleware' => 'languestic', 'namespace' => 'LanguesticReviewer', 'prefix' => 'languestic'], function () {
    Route::get('', 'LanguesticController@home');
    Route::get('myList', 'LanguesticController@index');
    Route::get('review/{artical_id}/{page?}', 'LanguesticController@review');
    Route::get('done/{artical_id}', 'LanguesticController@done');
    Route::get('send/{list_id}', 'LanguesticController@send');
    Route::get('resend', 'LanguesticController@backFromCreator');

});
Route::group(['middleware' => 'sound', 'namespace' => 'VoiceRecorder', 'prefix' => 'VoiceRecorder'], function () {
    Route::get('index', 'SoundController@index');
    Route::get('upload/sound/{list_id}/{article_level}/{page?}', 'SoundController@upload');
    Route::get('mySounds/{page?}', 'SoundController@mySounds');
    Route::get('sendTo/quality/{list_id}/{step}', 'SoundController@sendToQuality');
    Route::get('refused', 'SoundController@refused');
    Route::post('sound/save/{article_id}', 'SoundController@save');
});

Route::group(['middleware' => 'quality', 'namespace' => 'Quality', 'prefix' => 'quality'], function () {
    Route::get('', 'QualityController@home');
    Route::get('myList', 'QualityController@index');
    Route::get('review/{artical_id}/{page?}', 'QualityController@review');
    Route::get('done/{artical_id}', 'QualityController@done');
    Route::get('send/{list_id}', 'QualityController@send');
    Route::get('resend', 'QualityController@backFromCreator');

});

Route::group(['middleware' => 'placement_editor', 'namespace' => 'PlacementTest'], function () {
    Route::get('PlacementTests', 'PlacementTestController@index');
    Route::post('PlacementTests/save', 'PlacementTestController@save');
    Route::post('PlacementTests/update/{id}', 'PlacementTestController@update');
    Route::get('PlacementTests/delete/{id}', 'PlacementTestController@delete');
//-------------------------------------------------------------------------------------------------
    Route::get('PlacementTests/questions/index/{placement_id}', 'PlacementTestQuestionsController@index');
    Route::get('PlacementTests/questions/create/{placement_id}', 'PlacementTestQuestionsController@create');
    Route::post('PlacementTests/questions/save', 'PlacementTestQuestionsController@save');
    Route::post('PlacementTests/questions/update/{id}', 'PlacementTestQuestionsController@update');
    Route::get('PlacementTests/question/delete/{id}', 'PlacementTestQuestionsController@destroy');

});