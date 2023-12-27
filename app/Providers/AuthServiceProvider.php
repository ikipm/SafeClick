<?php

namespace App\Providers;

use Illuminate\Auth\Notifications\VerifyEmail;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        // ...

        VerifyEmail::toMailUsing(function (object $notifiable, string $url) {
            return (new MailMessage)
                ->from('noreply@safeclick.cat', 'SafeClick')
                ->subject(trans('email_verification.subject'))
                ->greeting(trans('email_verification.greeting', ['username' => $notifiable->name]))
                ->line(trans('email_verification.message'))
                ->action(trans('email_verification.action'), $url)
                ->salutation(trans('email_verification.salutation'));
        });
    }
}
