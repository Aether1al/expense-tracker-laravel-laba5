@extends('master')

@section('title', 'Мои траты')

@section('content')
    <h4 class="mb-3">Мои траты</h4>

    <form method="GET" action="{{ route('all_expenses') }}" class="d-flex gap-2 mb-3">
        <select name="category" class="form-select">
            <option value="">Все категории</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <input type="month" name="month" class="form-control" value="{{ request('month') }}">

        <button type="submit" class="btn btn-dark">Найти</button>
        <a href="{{ route('all_expenses') }}" class="btn btn-outline-secondary">Сброс</a>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Дата</th>
                <th>Категория</th>
                <th>Описание</th>
                <th>Сумма</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($expenses as $expense)
                <tr>
                    <td>{{ date('d.m.Y', strtotime($expense->spent_at)) }}</td>
                    <td>{{ $expense->category->name ?? '-' }}</td>
                    <td>{{ $expense->description }}</td>
                    <td>{{ $expense->amount }} ₽</td>
                    <td>
                        <a href="{{ route('edit_expense', $expense->id) }}" class="btn btn-sm btn-dark">Редактировать</a>
                        <a href="{{ route('delete_expense', $expense->id) }}" class="btn btn-sm btn-danger mt-2"
                            onclick="return confirm('Удалить?')">Удалить</a>
                        <a href="{{ route('card_expense', $expense->id) }}" class="btn btn-sm btn-dark mt-2">Перейти</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="class="mt-3">
        {{ $expenses->links() }}
    </div>

@endsection
