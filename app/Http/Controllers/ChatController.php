<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
Use App\Models\User;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Auth;
class ChatController extends Controller
{
    public function index(){
        $messages = Message::with('user')->orderBy('created_at','asc')->paginate(25);
        return view('main',compact('messages'));
    }
    public function store(MessageRequest $request){
        Message::create([
        'content'=>$request->input('content'),
        'user_id'=>Auth::id(),
        ]);
        return redirect()->route('home');
    }
}
