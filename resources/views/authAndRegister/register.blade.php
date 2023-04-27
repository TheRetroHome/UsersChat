@extends('layouts.layout')
@section('content')
 <div class="container mt-5">
        <h2>Регистрация</h2>
        <form>
            <div class="mb-3">
                <label for="name" class="form-label">Имя</label>
                <input type="text" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email">
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Пароль</label>
                <input type="password" class="form-control" id="password">
            </div>
            <div class="mb-3">
                <label for="confirm-password" class="form-label">Подтверждение пароля</label>
                <input type="password" class="form-control" id="confirm-password">
            </div>
            <button type="submit" class="btn btn-primary">Зарегистрироваться</button>
        </form>
    </div>
@endsection
