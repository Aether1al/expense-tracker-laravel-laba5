@extends('master')

@section('title', 'Редактировать трату')

@section('content')
    <h4 class="mb-3">Редактировать трату</h4>

    <form method="POST" action="{{ route('update_expense', $expense->id) }}">
        @csrf
        <div class="mb-3">
            <label class="form-label">Категория</label>
            <select class="form-select" name="category">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $expense->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Сумма</label>
            <input type="number" step="0.01" class="form-control" name="sum" value="{{ $expense->amount }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Описание</label>
            <input type="text" class="form-control" name="text" value="{{ $expense->description }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Дата</label>
            <input type="date" class="form-control" name="date" value="{{ $expense->spent_at }}" required>
        </div>

        <button type="submit" class="btn btn-dark">Сохранить</button>
        <a href="{{ route('all_expenses') }}" class="btn btn-outline-secondary">Назад</a>
    </form>
@endsection
