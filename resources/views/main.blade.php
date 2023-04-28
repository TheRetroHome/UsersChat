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
                <div class="col-12 d-flex justify-content-between">
                    <div>
                        <strong>@prefix($message)<span style="color: red;">Админ</span> @endprefix {{$message->user->name}}:</strong> {{$message->content}}
                    </div>
                    <div>
                        @candelete($message)
                        <form action="{{ route('message.destroy', $message) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm mr-1">Удалить</button>
                        </form>
                        @endcandelete
                        @admin
                        <button class="btn btn-danger btn-sm mr-1">Заблокировать</button>
                        <button class="btn btn-success btn-sm mr-1">Разблокировать</button>
                        <button class="btn btn-warning btn-sm mr-1">Мут</button>
                        @endadmin
                        <span class="text-muted" style="font-size: 0.8em;">{{ $message->created_at->format('H:i:s') }}</span>
                    </div>
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
