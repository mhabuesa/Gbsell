<?php

namespace App\Listeners;

use App\Events\MerchantMailVerify;
use App\Mail\MerchantVerifyMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMerchantVerifyEmail
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(MerchantMailVerify $event): void
    {
         Mail::to($event->merchant->email)->send(new MerchantVerifyMail($event->merchant));
    }
}
