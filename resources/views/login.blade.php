@extends('master')

@section('title')
    Авторизация
@endsection

@section('content')
    <h4>Авторизация</h4>
    <form method="POST" action="{{ route('auth_user') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <p>Нет акка? <a href="{{ route('reg') }}">Зарегистрируйтесь</a></p>
        </div>
        <button type="submit" class="btn btn-dark">Войти</button>
    </form>
@endsection
