<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'color' => 'required',
        ]);

        $exists = Color::where('shop_id', Auth::guard('merchant')->user()->shop_id)->where('name', $request->name)->exists();
        if ($exists) {
            return redirect()->back()->with('error', 'Color Already Exists');
        }

        $colors =  $request->color;
        foreach ($colors as $color) {

            Color::create([
                'name' => $color,
                'shop_id' => Auth::guard('merchant')->user()->shop_id,
            ]);
        }

        return redirect()->back()->with('success', 'Color created successfully.');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
