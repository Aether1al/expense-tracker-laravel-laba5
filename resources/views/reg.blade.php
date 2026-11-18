@extends('master')

@section('title')
    Регистрация
@endsection

@section('content')
    <h4>Регистрация</h4>

    <form method="POST" action="{{ route('add_user') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">ФИО</label>
            <input type="email" class="form-control" name="fio" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Пароль</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>
        <div class="mb-3">
            <p>Есть акк? <a href="{{ route('login') }}">Войдите</a></p>
        </div>
        <button type="submit" class="btn btn-dark">Зарегистрироваться</button>
    </form>
@endsection
