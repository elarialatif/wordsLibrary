<?php

namespace App\Http;

use App\Http\Middleware\Editor;
use App\Http\Middleware\Languestic;
use App\Http\Middleware\ListAnalyzer;
use App\Http\Middleware\ListsMaker;
use App\Http\Middleware\PlacementTestEditor;
use App\Http\Middleware\Quality;
use App\Http\Middleware\QuestionCreator;
use App\Http\Middleware\QuestionReviewer;
use App\Http\Middleware\Reviewer;
use App\Http\Middleware\Sound;
use App\Http\Middleware\SuperAdmin;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
        'placement_editor' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            PlacementTestEditor::class,

        ],
        'editor' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            Editor::class,

        ],
        'listmaker' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            ListsMaker::class,

        ], 'reviewer' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            Reviewer::class,

        ],
        'listanalyzer' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            ListAnalyzer::class,

        ],
        'questionCreator' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            QuestionCreator::class,

        ],
        'questionReviewer' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            QuestionReviewer::class,

        ],
        'languestic' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            Languestic::class,

        ],
        'superadmin' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            SuperAdmin::class,

        ],
        'sound' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            Sound::class,

        ],
        'quality' => [
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\Auth\Middleware\Authenticate::class,
            Quality::class,

        ],
        'api' => [
            'throttle:60,1',
            'bindings',
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'listmaker' => ListsMaker::class,
    ];

    /**
     * The priority-sorted list of middleware.
     *
     * This forces the listed middleware to always be in the given order.
     *
     * @var array
     */
    protected $middlewarePriority = [
        \Illuminate\Session\Middleware\StartSession::class,
        \Illuminate\View\Middleware\ShareErrorsFromSession::class,
        \App\Http\Middleware\Authenticate::class,
        \Illuminate\Session\Middleware\AuthenticateSession::class,
        \Illuminate\Routing\Middleware\SubstituteBindings::class,
        \Illuminate\Auth\Middleware\Authorize::class,
    ];
}
