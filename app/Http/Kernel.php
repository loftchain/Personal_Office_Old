<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Console\Scheduling\Schedule;

class Kernel extends HttpKernel
{

	protected $commands = [
		'App\Console\Commands\StoreTransactions'
	];

	protected function schedule(Schedule $schedule)
	{
		$schedule->command('store:transactions')
			->everyMinute();
	}

    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [

        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        \App\Http\Middleware\TrustProxies::class,
        \Illuminate\Session\Middleware\StartSession::class,
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
          \Illuminate\Session\Middleware\AuthenticateSession::class,
          \Illuminate\View\Middleware\ShareErrorsFromSession::class,
          \App\Http\Middleware\VerifyCsrfToken::class,
          \Illuminate\Routing\Middleware\SubstituteBindings::class,
          \App\Http\Middleware\Language::class,
          \App\Http\Middleware\CheckReferral::class,
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
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'agreement1' =>  \App\Http\Middleware\agreement1::class,
        'agreement2' =>  \App\Http\Middleware\agreement2::class,
        'valid' =>  \App\Http\Middleware\ValidateUser::class,
        'admin' => \App\Http\Middleware\IsAdmin::class
    ];
}
