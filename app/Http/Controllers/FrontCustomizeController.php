<?php

namespace App\Http\Controllers;

use App\Models\BannerContent;
use App\Models\BannerImage;
use App\Models\BannerItem;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Traits\ImageSaveTrait;
use Illuminate\Support\Facades\Auth;

class FrontCustomizeController extends Controller
{
    use ImageSaveTrait;

    public function banner_image()
    {
        if (!in_array(Auth::guard('merchant')->user()->permission, ['1', '2', '4'])) {
            return redirect()->route('accessDeny');
        }
        $shop_id = Auth::guard('merchant')->user()->shop_id;
        $banner = BannerImage::where('shop_id', $shop_id)->first();
        return view('merchant.frontend_customize.banner_image', [
            'banner' => $banner
        ]);
    }

    public function banner_image_update(Request $request)
    {

        $request->validate([
            'banner_image' => 'required|image|mimes:png,jpg,jpeg',
        ]);

        $shop_id = Auth::guard('merchant')->user()->shop_id;
        $image = BannerImage::where('shop_id', $shop_id)->first();

        if ($image) {

            $this->deleteImage(public_path($image->image));
            $image_name = $this->saveImage('banner', $request->file('banner_image'));
            BannerImage::where('shop_id', $shop_id)->update([
                'image' => $image_name
            ]);

        } else {

            $image_name = $this->saveImage('banner', $request->file('banner_image'));
            BannerImage::create([
                'shop_id' => $shop_id,
                'image' => $image_name
            ]);
        }

        return redirect()->back()->with('success', 'Banner Image Updated Successfully');
    }


    function banner_item()
    {
        if (!in_array(Auth::guard('merchant')->user()->permission, ['1', '2', '4'])) {
            return redirect()->route('accessDeny');
        }
        $products = Product::where('shop_id', Auth::guard('merchant')->user()->shop_id)->where('status', 1)->get();
        $banners = BannerItem::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        return view('merchant.frontend_customize.banner_item', [
            'products' => $products,
            'banners' => $banners
        ]);
    }

    function banner_item_create(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'product_id' => 'required'
        ]);
        $shop_id = Auth::guard('merchant')->user()->shop_id;
        BannerItem::create([
            'shop_id' => $shop_id,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'product_id' => $request->product_id
        ]);
        return redirect()->back()->with('success', 'Banner Item Create Successfully');
    }


    function banner_item_edit($id)
    {
        if (!in_array(Auth::guard('merchant')->user()->permission, ['1', '2'])) {
            return redirect()->route('accessDeny');
        }
        $products = Product::where('shop_id', Auth::guard('merchant')->user()->shop_id)->where('status', 1)->get();
        $banner = BannerItem::find($id);
        return view('merchant.frontend_customize.banner_item_edit', [
            'banner' => $banner,
            'products'=>$products,
        ]);
    }
    function banner_item_update(Request $request, $id)
    {

        $request->validate([
            'title' => 'required',
            'product_id' => 'required'
        ]);
        $shop_id = Auth::guard('merchant')->user()->shop_id;
        BannerItem::where('id', $id)->update([
            'shop_id' => $shop_id,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'product_id' => $request->product_id
        ]);
        return redirect()->back()->with('success', 'Banner Item Update Successfully');
    }

    public function banner_item_delete(string $id)
    {

        $banner = BannerItem::find($id);

        try {
            $banner->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Banner Item Deleted Successfully'], 200);
    }

    public function banner_status_update($id)
    {
        $banner = BannerItem::find($id);
        try {
            $banner->update([
                'status' => $banner->status == 0 ? 1 : 0,
            ]);
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Banner Status Updated Successfully'], 200);
    }
}
