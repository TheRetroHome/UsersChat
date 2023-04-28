@extends('layouts.layout')
@section('content')
     @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                 @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                 @endforeach
            </ul>
        </div>
    @endif
<div class="container mt-5">
        <h2>Авторизация</h2>
        <form action="{{route('login.store')}}" method="POST">
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" class="btn btn-primary">Войти</button>
        </form>
    </div>
@endsection
