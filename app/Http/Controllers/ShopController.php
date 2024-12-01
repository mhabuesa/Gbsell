<?php

namespace App\Http\Controllers;

use App\Models\Shop;
use App\Models\District;
use App\Models\Merchant;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\ImageSaveTrait;


use BaconQrCode\Renderer\ImageRenderer;
use BaconQrCode\Renderer\Image\ImagickImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use BaconQrCode\Writer;



class ShopController extends Controller
{

    use ImageSaveTrait;

    public function index()
    {
        $id = Auth::guard('merchant')->user()->shop->id;

        $shop = Shop::find($id);

        $cities = District::all();
        return view('merchant.shop.index', [
            'cities'=>$cities,
            // 'qr_image'=>$qr_image,
            'shop'=>$shop
        ]);
    }

    public function create()
    {

        $merchant = Auth::guard('merchant')->user();

        if($merchant){
            if($merchant->shop_status == 0){
                if($merchant->verification == 1){
                    $cities = District::all();
                    return view('merchant.shop.shop_create', [
                        'id'=>$merchant->id,
                        'cities'=>$cities,
                    ]);
                }
                else{
                    return redirect()->route('merchant.verify', $merchant->email);
                }
            }
            else{
                return redirect()->route('signup.view');
            }
        }
        else{
            return redirect()->route('signin.view');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {



        $request->validate([
            'shop_name' => ['required', 'string', 'max:255'],
            'shop_phone' => 'required|numeric|digits:11',
            'shop_type' => ['required', 'string', 'max:255'],
            'shop_city' => ['required', 'string', 'max:255'],
            'shop_address' => ['required', 'string', 'max:255'],
        ]);



        $merchant = Auth::guard('merchant')->user();


        $shop_name = strtolower($request->shop_name);
        $shop_name = str_replace(' ', '_', $shop_name);
        $shopUrl = $merchant->shop_id . '_' . $shop_name;

        Shop::create([
            'shop_id' => $merchant->shop_id,
            'name' => $request->shop_name,
            'email' => $merchant->email,
            'phone' => $request->shop_phone,
            'type' => $request->shop_type,
            'city' => $request->shop_city,
            'address' => $request->shop_address,
            'url' => $shopUrl,
        ]);

        Merchant::where('id', $merchant->id)->update([
            'shop_status' => 1
        ]);

        return redirect()->route('dashboard')->with('success', 'Shop Created Successfully');


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {

    }

    public function getQrCode(string $id)
    {
        $shop = Shop::find($id);
        $renderer = new ImageRenderer(
            new RendererStyle(200),
            new ImagickImageBackEnd()
        );
        $writer = new Writer($renderer);
        $qr_image = base64_encode($writer->writeString($shop->url));

        return response()->json(['qr_image' => $qr_image]);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'shop_name' => ['required', 'string', 'max:255'],
            'shop_phone' => 'required|numeric|digits:11',
            'shop_address' => ['required', 'string', 'max:255'],
        ]);

        $shop = Shop::find($id);

        if ($request->hasFile('logo')) {
            if (!empty($shop->logo)) {
                $this->deleteImage(public_path($shop->logo));
            }

            $shop_logo = $this->saveImage('shop', $request->file('logo'));

             // Update shop details
             Shop::find($id)->update([
                'name' => $request->shop_name,
                'phone' => $request->shop_phone,
                'type' => $request->shop_type,
                'city' => $request->shop_city,
                'address' => $request->shop_address,
                'description' => $request->description,
                'logo' => $shop_logo,
            ]);
        }
        else{
             // Update shop details
             Shop::find($id)->update([
                'name' => $request->shop_name,
                'phone' => $request->shop_phone,
                'type' => $request->shop_type,
                'city' => $request->shop_city,
                'address' => $request->shop_address,
                'description' => $request->description,
            ]);
        }

        return redirect()->route('shop.index')->with('success', 'Shop Updated Successfully');

    }


    public function checkShopUrl(Request $request)
    {
        $userShopUrl = Auth::guard('merchant')->user()->shop->url;

        if ($request->shop_url != $userShopUrl) {
            $shopUrl = $request->input('shop_url');
            $exists = Shop::where('url', $shopUrl)->exists();

            return response()->json(['exists' => $exists]);
        } else {
            return response()->json(['available' => true]);
        }
    }



    public function url_update(Request $request, $id)
    {

        $request->validate([
            'shop_url' => ['required', 'min:5'],
        ]);

        $userShopUrl = Auth::guard('merchant')->user()->shop->url;
        $lower = strtolower($request->shop_url);
        $shopUrl = str_replace(' ', '_', $lower);



        if ($shopUrl != $userShopUrl) {

            if(Shop::where('url', $shopUrl)->exists()){
                return redirect()->route('shop.index', $id)->with('error', 'Shop Url Already Exists');
            }
            else{
                Shop::find($id)->update([
                    'url' => $shopUrl
                ]);
                return redirect()->route('shop.index', $id)->with('success', 'Shop Url Updated Successfully');
            }


        } else {
            return redirect()->route('shop.index');
        }

    }


}
