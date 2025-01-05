<?php

namespace App\Http\Controllers;

use App\Models\AdminInfo;
use App\Models\Shop;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use App\Traits\ImageSaveTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AdminController extends Controller
{
    use ImageSaveTrait;

    public function profile()
    {
        return view('admin.profile.index');
    }

    public function profile_update(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('image')) {
            if (!empty($user->image)) {
                $this->deleteImage(public_path($user->image));
            }

            $image_name = $this->saveImage('profile', $request->file('image'), 400, 400);

            // Update user details
            User::find($user->id)->update([
                'name' => $request->name,
                'image' => $image_name,
                'email'=> $request->email,
            ]);
        } else {
            // Update user details
            User::where('id', $user->id)->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);
        }

        return redirect()->route('admin.profile')->with('success', 'Profile Updated Successfully');
    }

    public function profile_password(Request $request){
         // Validate the request
         $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);

        // Get the user (profile)
        $user = Auth::user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('admin.profile')->with('error', 'Current Password does not match');
        }

        // Update the password
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('admin.profile')->with('success', 'Password Updated Successfully');
    }

    public function dashboard()
    {
        $shops = Shop::whereDate('expiry_date', '<=', Carbon::now()->addDays(15))->orderBy('expiry_date', 'asc')->get();

        // Analitics for dashboard
        $salesToday = Order::whereDate('created_at', Carbon::today())->sum('total');
        $salesThisWeek = Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total');
        $salesThisMonth = Order::whereMonth('created_at', Carbon::now()->month)->sum('total');
        $visitors = Shop::all()->sum('visitors');
        $ordersThisMonth = Order::whereMonth('created_at', Carbon::now()->month)->count();
        $orderstotal = Order::all()->count();

        return view('admin.index', [
            'shops' => $shops,
            'salesToday' => $salesToday,
            'salesThisWeek' => $salesThisWeek,
            'salesThisMonth' => $salesThisMonth,
            'visitors' => $visitors,
            'ordersThisMonth' => $ordersThisMonth,
            'orderstotal' => $orderstotal,
        ]);
    }

    public function shop(){
        $shops = Shop::all();
        return view('admin.shop.index', [
            'shops' => $shops
        ]);
    }

    public function shop_delete($id){
        $shop = Shop::find($id);
        try {
            $this->deleteImage(public_path($shop->logo));
            Order::where('shop_id', $shop->shop_id)->delete();
            Product::where('shop_id', $shop->shop_id)->delete();
            OrderProduct::where('shop_id', $shop->shop_id)->delete();
            $shop->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Shop Deleted Successfully'], 200);
    }

    public function shop_details($id){
        $shop = Shop::find($id);
        return view('admin.shop.details', [
            'shop' => $shop
        ]);
    }

    public function status_update($id){
        $shop = Shop::find($id);

        if (!$shop) {
            return response()->json(['success' => false, 'message' => 'Shop not found'], 404);
        }

        try {
            $shop->update([
                'status' => $shop->status == 0 ? 1 : 0,
            ]);

        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'message' => 'Shop Status Updated Successfully'], 200);
    }

    public function subscription_update(Request $request, $id){
        $shop = Shop::find($id);

        if (!$shop) {
            return redirect()->route('admin.shop')->with('error', 'Shop not found');
        }
        if (!$request->date) {
            return redirect()->route('admin.shop')->with('error', 'Date is required');
        }
        $shop->update([
            'expiry_date' => $request->date,
        ]);
        return redirect()->route('admin.shop')->with('success', 'Subscription Updated Successfully');
    }


    // Customize

    public function favicon(){
        $info = AdminInfo::first();
        $favicon = $info->favicon;
        return view('admin.customize.favicon', [
            'favicon' => $favicon
        ]);
    }

    public function favicon_update(Request $request){
        $request->validate([
            'favicon' => 'required|image|mimes:png,jpg,jpeg,webp',
        ]);
        $info = AdminInfo::first();

        if ($info->favicon) {
            $this->deleteImage(public_path($info->favicon));
        }

        $favicon_name = $this->saveImage('favicon', $request->file('favicon'));

        $info->update([
            'favicon' => $favicon_name,
        ]);

        return redirect()->back()->with('success', 'Favicon Updated Successfully');
    }

    public function logo(){
        $info = AdminInfo::first();
        $logo = $info->logo;
        return view('admin.customize.logo', [
            'logo' => $logo
        ]);
    }

    public function logo_update(Request $request){
        $request->validate([
            'logo' => 'required|image|mimes:png,jpg,jpeg,webp',
        ]);
        $info = AdminInfo::first();

        if ($info->logo) {
            $this->deleteImage(public_path($info->logo));
        }

        $logo_name = $this->saveImage('logo', $request->file('logo'));

        $info->update([
            'logo' => $logo_name,
        ]);

        return redirect()->back()->with('success', 'Logo Updated Successfully');
    }

    public function info(){
        $info = AdminInfo::first();
        return view('admin.customize.info', [
            'info' => $info
        ]);
    }

    public function info_update(Request $request){
        $info = AdminInfo::first();
        $info->update([
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
        ]);
        return redirect()->back()->with('success', 'Info Updated Successfully');
    }

    public function social(){
        $info = AdminInfo::first();
        return view('admin.customize.social', [
            'info' => $info
        ]);
    }

    public function social_update(Request $request){
        $info = AdminInfo::first();
        $info->update([
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
        ]);
        return redirect()->back()->with('success', 'Social Updated Successfully');
    }
}
