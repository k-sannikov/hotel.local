@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-8 bg-white border rounded p-3 shadow-sm">
        <h4 class="text-center">Расчет и бронирование номера</h4>
        <form id="order_form">
            @csrf
            @include('hotel.admin.orders.partials.form')
        </form>
    </div>
</div>
@endsection
