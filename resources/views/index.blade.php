@extends('master')

@section('title', 'Дашборд')

@section('content')
    <div class="container mt-4">
        <h3>Мои расходы за этот месяц</h3>

        <table class="table table-bordered mt-3">
            <thead class="table-light">
                <tr>
                    <th>Категория</th>
                    <th>Потрачено</th>
                    <th>Лимит</th>
                    <th>Остаток</th>
                    <th>Процент</th>
                    <th>Статус</th>
                </tr>
            </thead>
            <tbody>
                @foreach($dashboardData as $item)
                    <tr>
                        <td>
                            <span style="display:inline-block; width:15px; height:15px; background-color: {{ $item['category']->color }}; border-radius: 50%;"></span>
                            {{ $item['category']->name }}
                        </td>
                        <td>{{ number_format($item['spent']) }}₽</td>
                        <td>
                            @if($item['limit'] !== null)
                                {{ number_format($item['limit']) }}₽
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($item['remainder'] !== null)
                                {{ number_format($item['remainder']) }}₽
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($item['status'] !== 'no_limit')
                                {{ $item['percent'] }}%
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if($item['status'] === 'ok')
                                <span class="text-success">В норме</span>
                            @elseif($item['status'] === 'warning')
                                <span class="text-warning">Приближение</span>
                            @elseif($item['status'] === 'danger')
                                <span class="text-danger">Перерасход</span>
                            @else
                                <span class="text-secondary">Без лимита</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
