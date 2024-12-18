<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\SmsConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SteadFast\SteadFastCourierLaravelPackage\Facades\SteadfastCourier;

class OrderDeliverController extends Controller
{


    // Steadfast Delivery
    public function steadfast_delivery(Request $request)
    {
        $shop_id = Auth::guard('merchant')->user()->shop_id;
        $invoice = $request->invoice;
        $recipient_name = $request->recipient_name;
        $recipient_phone = $request->recipient_phone;
        $recipient_address = $request->recipient_address;
        $cod_amount = $request->cod_amount;
        $note = $request->note;

        $orderData = [
            'invoice' => $invoice,
            'recipient_name' => $recipient_name,
            'recipient_phone' => $recipient_phone,
            'recipient_address' => $recipient_address,
            'cod_amount' => $cod_amount,
            'note' => $note,
            'shop_id' => $shop_id,

        ];


        // Place order via SteadfastCourier
        $response = SteadfastCourier::placeOrder($orderData);

        if (isset($response['status']) && $response['status'] == true) {
            if (isset($response['data']['errors']) && !empty($response['data']['errors'])) {
                $errorMessages = [];
                foreach ($response['data']['errors'] as $field => $messages) {
                    foreach ($messages as $message) {
                        $errorMessages[] = $message;
                    }
                }
                return back()->with('error', implode(', ', $errorMessages));
            }

            // If no errors, update the order with tracking code and status
            $tracking_code = $response['data']['consignment']['tracking_code']; // Corrected here
            $order_id = $request->order_id;

            // Update order status and tracking code
            Order::where('order_id', $order_id)->update([
                'tracking_code' => $tracking_code,
                'delivery_status' => 'sended',
                'delivery_method' => 'steadFast',
                'status' => 'delivering',
            ]);

            // Store success message in session and return back
            return back()->with('success', 'Order placed successfully and tracking code updated.');
        }

        // If the response status is not true, show the failure message
        return back()->with('error', 'Failed to place the order.');
    }

    //Pathao Delivery


}
