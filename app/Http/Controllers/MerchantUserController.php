<?php

namespace App\Http\Controllers;

use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\ImageSaveTrait;

class MerchantUserController extends Controller
{
    use ImageSaveTrait;
    function index()
    {
        $auth = Auth::guard('merchant')->user();

        if($auth->permission != 1){
            return redirect()->route('accessDeny');
        }

        $users = Merchant::where('shop_id', $auth->shop_id)
                        ->where('id', '!=', $auth->id)
                        ->where('permission', '!=', '1')
                        ->get();
        return view('merchant.user.index', compact('users'));
    }

    function create()
    {
        return view('merchant.user.create');
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:merchants',
            'password' => 'required',
            'password_confirmation' => 'required|same:password',
            'permission' => 'required',
        ]);

        Merchant::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'permission' => $request->permission,
            'shop_id' => Auth::guard('merchant')->user()->shop_id,
            'shop_status' => 1,
            'verification' => 1,
            'status' => 1
        ]);

        return redirect()->route('user.index')->with('success', 'Merchant User created successfully');
    }


    public function edit($id)
    {
        $user = Merchant::find($id);
        return view('merchant.user.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:merchants,email,' . $id,
            'password' => 'nullable',
            'password_confirmation' => 'nullable|same:password',
            'permission' => 'required',
        ]);

        $user = Merchant::find($id);
        if($request->password != null){
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password),
                'permission' => $request->permission,
            ]);
        }else{
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
                'permission' => $request->permission,
            ]);
        }

        return redirect()->route('user.index')->with('success', 'Merchant User updated successfully');
    }

    public function delete($id)
    {
        $user = Merchant::find($id);
        if ($user->id == Auth::guard('merchant')->user()->id) {
            return response()->json(['error' => true, 'message' => 'You cant delete yourself'], 200);
        }

        try {
            $this->deleteImage(public_path($user->photo));
            $user->delete();
        } catch (\Exception $e) {
            Log::error($e);
            return error($e->getMessage());
        }

        return response()->json(['success' => true, 'message' => 'User Deleted Successfully'], 200);
    }


    public function user_status_update($id)
    {
        $user = Merchant::find($id);

        if (!$user) {
            return response()->json(['success' => false, 'message' => 'User not found'], 404);
        }

        try {
            $user->update([
                'status' => $user->status == 0 ? 1 : 0,
            ]);

        } catch (\Exception $e) {
            Log::error($e);
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }

        return response()->json(['success' => true, 'message' => 'User Status Updated Successfully'], 200);
    }

}
