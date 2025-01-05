<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Merchant;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Traits\ImageSaveTrait;

class ProfileController extends Controller
{
    use ImageSaveTrait;

    public function index()
    {
        return view('merchant.profile.index');
    }

    public function update(Request $request, Merchant $user)
    {

        // Validate the request
        $request->validate([
            'name' => 'required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            if (!empty($user->photo)) {
                $this->deleteImage(public_path($user->photo));
            }

            $photo_name = $this->saveImage('profile', $request->file('photo'), 400, 400);

            // Update user details
            Merchant::where('id', $user->id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'photo' => $photo_name,
            ]);
        } else {
            // Update user details
            Merchant::where('id', $user->id)->update([
                'name' => $request->name,
                'phone' => $request->phone,
            ]);
        }





        return redirect()->route('profile.index')->with('success', 'Profile Updated Successfully');
    }

    public function profile_password(Request $request, Merchant $user)
    {
        // Validate the request
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);


        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->route('profile.index')->with('error', 'Current Password does not match');
        }

        // Update the password
        $user->password = Hash::make($request->password);
        $user->save();

        // Redirect with success message
        return redirect()->route('profile.index')->with('success', 'Password Updated Successfully');
    }

}


