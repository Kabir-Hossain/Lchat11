<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ChatApp;
use Illuminate\Http\Request;

class ChatAppController extends Controller
{
    public function chatapp(Request $request){
        // dd($_POST); 
        $request->validate([
            'username' => 'required',
        ]);
        $username = $request->username;
        // dd($username);
        return view('chat', ['username'=> $username]);
    }

    public function firemsg(Request $request){  
        
        // dd($request->all());
        
        // Insert message into database
        $message = ChatApp::create([
            'sender_id' => 2,
            'receiver_id' => 1,
            'message' => $request->msg,
            'is_read' => false,
            'sent_at' => now(),
        ]);
        
        // MessageSent::dispatch($request->sender, $request->msg);
        MessageSent::dispatch($message);
        return $request->all();
    }
}
