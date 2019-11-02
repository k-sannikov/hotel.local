@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-10 bg-white border rounded p-3 shadow-sm">
        <h4 class="text-center">Список гостей</h4>
        <a class="btn btn-primary my-3" href="{{ route('orders.create') }}">
            Расчет и бронирование номера
        </a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>ФИО гостя</th>
                    <th>Дата прибытия</th>
                    <th>Дата отбытия</th>
                    <th>ИТОГО</th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('orders.edit', $item->id) }}">
                                {{ $item->guest_name }}
                            </a>
                        </td>
                        <td> {{ $item->arrival }} </td>
                        <td> {{ $item->departure }} </td>
                        <td> {{ $item->total_cost }} руб.</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="row justify-content-center">
    <div class="col-10 bg-white border rounded shadow-sm pt-3 mt-3">
        @if($items->total() > $items->count())
                {{ $items->links() }}
        @endif
    </div>
</div>
@endsection
