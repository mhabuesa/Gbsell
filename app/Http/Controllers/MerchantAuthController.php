<?php

namespace App\Http\Controllers;

use App\Events\MerchantMailVerify;
use App\Mail\MerchantVerifyMail;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MerchantAuthController extends Controller
{

    public function signup_view()
    {
        if(Auth::guard('merchant')->check()){
            return redirect()->route('dashboard');
        }
        return view('merchant.auth.signup');
    }

    public function signup(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:merchants'],
            'password' => ['required', 'min:8'],
            'password_confirmation' => ['required', 'min:8', 'same:password'],
        ]);

        $otp = random_int(100000, 999999);

        $merchant = Merchant::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'permission' => 1,
            'otp' => $otp
        ]);



        event(new MerchantMailVerify($merchant));


        return redirect()->route('merchant.verify', ['email' => $request->email]);

    }


    public function merchant_verify($email)
    {
        if(!Merchant::where('email', $email)->first()){
            return redirect()->route('signup.view');
        }
        if(Merchant::where('email', $email)->first()->verification == 1){
            return redirect()->route('signin.view');
        }

        if(Merchant::where('email', $email)->first()->verification == 0){
            return view('merchant.auth.verify', ['email' => $email]);
        }

    }


    public function merchant_verified(Request $request, $email)
    {
        $request->validate([
            'num1' => 'required|numeric',
            'num2' => 'required|numeric',
            'num3' => 'required|numeric',
            'num4' => 'required|numeric',
            'num5' => 'required|numeric',
            'num6' => 'required|numeric',
        ]);

        // Combine all digits into a full code
        $code = $request->num1 . $request->num2 . $request->num3 . $request->num4 . $request->num5 . $request->num6;

        if(Merchant::where('email', $email)->first()->otp != $code){
            return redirect()->back()->with('error', 'Invalid OTP. Please check the code and try again.');
        }

        $shop_id = random_int(1000000, 9999999);
        Merchant::where('email', $email)->update([
            'verification' => 1,
            'otp' => null,
            'status' => 1,
            'shop_id' => $shop_id,
        ]);

        $merchant = Merchant::where('email', $email)->first();
        Auth::guard('merchant')->login($merchant);

        return  redirect()->route('shop.create')->with('success', 'Merchant verified successfully. You can create your shop. ');
    }


    public function signin_view()
    {
        if(Auth::guard('merchant')->check()){
            return redirect()->route('dashboard');
        }
        return view('merchant.auth.signin');
    }

    public function signin(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required'],
        ]);

        if (Auth::guard('merchant')->attempt(['email' => $request->email, 'password' => $request->password])) {
            if(Merchant::where('email', $request->email)->first()->shop_status == 0){
                return redirect()->route('shop.create');
            }
            else{
                return redirect()->route('dashboard')->with('success', 'Welcome back!');
            }
        }

        return redirect()->back()->with('error', 'Invalid credentials. Please check your email and password and try again.');
    }


    public function sign_out()
    {
        Auth::guard('merchant')->logout();
        return redirect()->route('signin.view');
    }

    function change_email_view($email)
    {
        $id = Merchant::where('email', $email)->first()->id;
        return view('merchant.auth.change_email', compact('id'));
    }


    function changed_email(Request $request, $id)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
        $merchant = Merchant::find($id);

        if($merchant->email == $request->email){
            return redirect()->back()->with('error', 'You already entered this Email. Please try another one.');
        }
        else{
            $request->validate([
                'email' => ['required', 'email', 'unique:merchants'],
            ]);

            $otp = random_int(100000, 999999);

            $merchant->update([
                'email' => $request->email,
                'otp' => $otp
            ]);

            event(new MerchantMailVerify($merchant));


            return redirect()->route('merchant.verify', ['email' => $request->email]);

        }
    }



}
