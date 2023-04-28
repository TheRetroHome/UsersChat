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
        <h2>Регистрация</h2>
        <form action="{{route('register.store')}}" method="POST">
        @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Подтверждение пароля</label>
                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
@endsection
