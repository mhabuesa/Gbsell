<?php

namespace App\Http\Controllers;

use App\Models\ChatConfig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{

    public function index()
    {
        $auth = Auth::guard('merchant')->user();

        if($auth->permission != 1){
            return redirect()->route('accessDeny');
        }
        $shop_id = $auth->shop_id;
        $chat = ChatConfig::where('shop_id', $shop_id)->first();
        return view('merchant.chat.index', [
            'shop_id' => $shop_id,
            'chat' =>  $chat,
        ]);
    }

    public function update(Request $request, $id)
    {
        $exists = ChatConfig::where('shop_id', $id)->exists();

        if($request->status == 'on'){
            $status = 1;
        }else{
            $status = 0;
        }

        if ($exists) {
            ChatConfig::where('shop_id', $id)->update([
                'phone'=> $request->input('phone'),
                'message'=> $request->input('message'),
                'status'=> $status,
            ]);
            return redirect()->back()->with('success', 'Chat Config Updated Successfully');
        } else {
            ChatConfig::create([
                'shop_id' => $id,
                'phone'=> $request->input('phone'),
                'message'=> $request->input('message'),
                'status'=> $status,
            ]);
            return redirect()->back()->with('success', 'Chat Config Created Successfully');
        }
    }
}
