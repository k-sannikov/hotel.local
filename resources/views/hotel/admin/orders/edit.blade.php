@extends('layouts.app')

@section('content')
@include('hotel.admin.orders.partials.result_messages')
<div class="row justify-content-center">
    <div class="col-8 bg-white border rounded p-3 shadow-sm">
        <form method="post" action="{{ route('orders.destroy', $item->id) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-link px-0">Удалить</button>
        </form>
        <h4 class="text-center">Редактирование записи</h4>
        <form id="order_form">
            @csrf
            @method('put')
            @include('hotel.admin.orders.partials.form')
        </form>
    </div>
</div>
@endsection
