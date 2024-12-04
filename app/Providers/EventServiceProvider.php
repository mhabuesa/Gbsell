<?php

namespace App\Providers;

use App\Events\InvoiceGenerated;
use App\Events\MerchantMailVerify;
use App\Listeners\SendInvoiceEmail;
use Illuminate\Support\Facades\Event;
use App\Listeners\SendMerchantVerifyEmail;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        MerchantMailVerify::class => [
            SendMerchantVerifyEmail::class,
        ],
        InvoiceGenerated::class => [
            SendInvoiceEmail::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        //
    }
}
