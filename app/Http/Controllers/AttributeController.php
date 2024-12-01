<?php

namespace App\Http\Controllers;

use App\Models\Size;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        $attributes = Attribute::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        $colors = Color::where('shop_id', Auth::guard('merchant')->user()->shop_id)->get();
        return view('merchant.attribute.index', compact('categories', 'attributes' , 'colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'attribute' => 'required',
        ]);

        $exists = Attribute::where('shop_id', Auth::guard('merchant')->user()->shop_id)->where('name', $request->attribute)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Attribute Already Exists');
        } else {
            $attribute = Attribute::find($id);
            $attribute->name = $request->attribute;
            $attribute->save();
            return redirect()->back()->with('success', 'Attribute Updated Successfully');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $attribute = Attribute::find($id);
        try {
            $attribute->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'Attribute Deleted Successfully'], 200);
    }

    public function size_store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'attribute' => 'required',
        ]);

        $attributes = $request->attribute;

        foreach ($attributes as $attribute) {
            Attribute::create([
                'shop_id' => Auth::guard('merchant')->user()->shop_id,
                'category_id' => $request->category_id,
                'name' => $attribute,
            ]);
        }

        return redirect()->back()->with('success', 'Attribute Added Successfully');
    }

    public function getAttributes($category_id)
    {
        // Category ID er basis e attributes fetch
        $attributes = Attribute::where('category_id', $category_id)->get();

        // JSON response pathano
        $formattedAttributes = [];
        foreach ($attributes as $attribute) {
            $formattedAttributes[] = [
                'id' => $attribute->id,
                'name' => $attribute->name,
            ];
        }

        return response()->json($formattedAttributes);
    }
}
