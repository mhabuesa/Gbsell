<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Order;
use App\Models\Review;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class MerchantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated with the 'merchant' guard
        if (!Auth::guard('merchant')->check()) {
            return redirect()->route('signin.view');
        }
        if (Auth::guard('merchant')->user()->shop_status == 0) {
            return redirect('shop/create')->with('error', 'Please Create your Shop first.');
        }

        if (Auth::guard('merchant')->user()->status == 0) {
            Auth::guard('merchant')->logout();
            return redirect()->route('signin.view')->with('error', 'Access Denied. Your account is deactivated by Shop Owner!');
        }

        if (Auth::guard('merchant')->user()->shop->status == 0) {
            Auth::guard('merchant')->logout();
            return redirect()->route('signin.view')->with('error', 'Access Denied. Your Shop is deactivated by Author!');
        }

        return $next($request);
    }
}
