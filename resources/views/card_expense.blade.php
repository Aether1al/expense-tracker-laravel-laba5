@extends('master')

@section('title', 'Просмотр траты')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Карточка траты</h4>
        <a href="{{ route('all_expenses') }}" class="btn btn-outline-secondary">Назад к списку</a>
    </div>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title mb-3">Сумма: {{ $expense->amount }}₽</h5>
            <p class="card-text"><strong>Категория:</strong> {{ $expense->category->name ?? 'Без категории' }}</p>
            <p class="card-text"><strong>Дата траты:</strong> {{ date('d.m.Y', strtotime($expense->spent_at)) }}</p>
            <p class="card-text"><strong>Описание:</strong> {{ $expense->description ?: 'Нет описания' }}</p>
            <p class="card-text text-muted small"><strong>Запись
                    создана:</strong>{{ $expense->created_at ? $expense->created_at->format('d.m.Y H:i') : '' }}</p>
            <hr>
            <div class="d-flex gap-2">
                <a href="{{ route('edit_expense', $expense->id) }}" class="btn btn-dark">Редактировать</a>
                <a href="{{ route('delete_expense', $expense->id) }}" class="btn btn-danger"
                    onclick="return confirm('Удалить?')">Удалить</a>
            </div>
        </div>
    </div>
@endsection
