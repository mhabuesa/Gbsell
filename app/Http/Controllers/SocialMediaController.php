<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\Merchant;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class SocialMediaController extends Controller
{
    public function index(){
        $auth = Auth::guard('merchant')->user();

        if($auth->permission != 1){
            return redirect()->route('accessDeny');
        }

        $shop_id = $auth->shop_id;
        $mediaLinks = SocialMedia::where('shop_id', $shop_id)->get();
        return view('merchant.socialMedia.socialMedia', compact('mediaLinks'));
    }

    public function store(Request $request){
        $request->validate([
            'icon' => 'required',
            'link' => 'required',
        ]);
        $name = $request->social_media;
        $icon = $request->icon;
        $link = $request->link;

        $shop_id = Auth::guard('merchant')->user()->shop_id;

        if (SocialMedia::where('shop_id', $shop_id)->where('name', $name)->exists()) {
            return redirect()->back()->with('error', 'This Social Media Already Exists');
        }
        SocialMedia::create([
            'shop_id' => $shop_id,
            'icon' => $icon,
            'name' => $name,
            'link' => $link,
        ]);
        return redirect()->back()->with('success', 'Social Media Added Successfully');

    }

    public function update(Request $request, $id){
        $socialMedia = SocialMedia::find($id);
        $socialMedia->update($request->all());
        return redirect()->back()->with('success', 'Social Media Updated Successfully');
    }

    public function delete($id)
    {
        $socialMedia = SocialMedia::find($id);
        try {
            $socialMedia->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Social Media Deleted Successfully'], 200);
    }
}
