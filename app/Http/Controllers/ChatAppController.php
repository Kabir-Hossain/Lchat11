<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use Illuminate\Http\Request;

class ChatAppController extends Controller
{
    public function chatapp(Request $request){
        // dd($_POST); `
        $request->validate([
            'username' => 'required',
        ]);
        $username = $request->username;
        // dd($username);
        return view('chat', ['username'=> $username]);
    }

    public function firemsg(Request $request){  
        
        MessageSent::dispatch($request->sender, $request->msg);
        return $request->all();
    }
}
