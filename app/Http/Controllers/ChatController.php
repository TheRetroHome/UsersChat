<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;
Use App\Models\User;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
class ChatController extends Controller
{
    public function index(){
        $messages = Message::with('user')->orderBy('created_at','asc')->paginate(25);
        return view('main',compact('messages'));
    }
    public function store(MessageRequest $request){
        $user = Auth::user();
        if($user->is_blocked){
            return redirect()->route('home')->with('error','Вы заблокированы');
        }
        if($user->mute_until && Carbon::parse($user->mute_until)->isFuture()){
            return redirect()->route('home')->with('error','Вы были заглушены');
        }
        Message::create([
        'content'=>$request->input('content'),
        'user_id'=>Auth::id(),
        ]);
        return redirect()->route('home');
    }
    public function destroy(Message $message){
        if(auth()->user()->is_admin||auth()->id() == $message->user_id){
            $message->delete();
            return redirect()->route('home');
        }
        else{
            return redirect()->route('home')->with('error','У вас нет прав для удаления этого сообщения');
        }
    }
    public function block(User $user){
        if($user->is_admin){
            return redirect()->route('home')->with('error','Нельзя заблокировать администратора');
        }
    $user->update(['is_blocked' => true]);
    return redirect()->route('home')->with('success',"Пользователь $user->name был успешно заблокирован");
    }
    public function unblock(User $user){
        if($user->is_admin){
            return redirect()->route('home')->with('error','Нельзя разблокировать администратора');
        }
        $user->update(['is_blocked' => false]);
        return redirect()->route('home')->with('success',"Пользователь $user->name был успешно разблокирован");
    }
    public function mute(User $user){
        if($user->is_admin){
            return redirect()->route('home')->with('error','Нельзя замутить администратора');
        }
    $muteTime = 300;
    $muteUntil = now()->addSeconds($muteTime);
    $user->update(['mute_until'=>$muteUntil]);
    return redirect()->route('home')->with('success',"Пользователь $user->name был успешно замучен на 5 минут");
    }
    public function unmute(User $user){
        if($user->is_admin){
            return redirect()->route('home')->with('error','Нельзя размутить администратора');
        }
    $user->update(['mute_until'=>NULL]);
        return redirect()->route('home')->with('success',"Пользователь $user->name был успешно размучен");
    }
}
