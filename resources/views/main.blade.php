@extends('layouts.layout')
@section('content')
<div class="container mt-5">
        <div class="card">
            <div class="card-header">
                Chat Room
            </div>
            <div class="card-body" style="height: 400px; overflow-y: auto;">
            @foreach($messages as $message)
                <div class="row mb-2">
                    <div class="col-12">
                        <strong>@if($message->user->is_admin)<span style="color: red;">Админ</span> @endif {{$message->user->name}}:</strong> {{$message->content}}
                    </div>
                </div>
            @endforeach
            </div>
            @auth
            <div class="card-footer">
                <form action="{{route('chat.store')}}" method="POST">
                @csrf
                    <div class="input-group">
                        <input type="text" name="content" class="form-control" placeholder="Type your message...">
                        <button class="btn btn-primary" type="submit">Send</button>
                    </div>
                </form>
            </div>
            @endauth
            @guest
            <div class="card-footer">
                <div class="text-center">
                    <span>Для использования чата авторизуйтесь</span>
                </div>
            </div>
            @endguest
        </div>
    </div>
@endsection
