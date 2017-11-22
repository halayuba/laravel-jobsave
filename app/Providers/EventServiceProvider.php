<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
      'App\Events\FileWasUploadedToResume' => [
          'App\Listeners\ResumeFileUploadProcessing',
      ],
      'App\Events\FileWasUploadedToJob' => [
          'App\Listeners\JobFileUploadProcessing',
      ],
      'App\Events\ActionDeleteEmployerInUse' => [
          'App\Listeners\ExtendInactivatingAssociatedModels',
      ],
      'App\Events\ActivationEmailRequested' => [
          'App\Listeners\SendActivationEmail',
      ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
