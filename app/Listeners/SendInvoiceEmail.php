<?php

namespace App\Listeners;

use App\Models\Order;
use App\Models\Customer;
use App\Mail\InvoiceMail;
use App\Events\InvoiceGenerated;
use App\Models\Billing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendInvoiceEmail  implements ShouldQueue
{
    use InteractsWithQueue;
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
    public function handle(InvoiceGenerated $event): void
    {
        try {
            $order_id = $event->order_id;
            $billing = Billing::where('order_id', $order_id)->first();
            $email = $billing->email;

            Mail::to($email)->queue(new InvoiceMail($order_id));
        } catch (\Exception $e) {
            Log::error('Invoice email sending failed', ['order_id' => $order_id, 'error' => $e->getMessage()]);
        }
    }
}
