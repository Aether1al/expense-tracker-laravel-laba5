@extends('master')

@section('title')
    Добавление трат
@endsection

@section('content')
    <h4 class="mb-3">Добавить трату</h4>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('add_expense') }}">
        @csrf

        <div class="mb-3">
            <label for="category" class="form-label">Выберите категорию</label>
            <select class="form-select" id="category" name="category" required>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="sum" class="form-label">Сумма</label>
            <input type="number" step="0.01" class="form-control" id="sum" name="sum" value="{{ old('sum') }}" required>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Описание</label>
            <input type="text" class="form-control" id="text" name="text" value="{{ old('text') }}">
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Дата траты</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ old('date', date('Y-m-d')) }}" required>
        </div>

        <button type="submit" class="btn btn-dark">Добавить</button>
    </form>
@endsection
