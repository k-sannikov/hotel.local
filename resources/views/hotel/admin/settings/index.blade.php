@extends('layouts.app')

@section('content')

@include('hotel.admin.settings.partials.result_messages')
<div class="row justify-content-center">
    <div class="col-8 bg-white border rounded p-3 shadow-sm">
        <h3 class="text-center">Настройки приложения</h3>
        @include('hotel.admin.settings.partials.form_settings')
    </div>
</div>
@endsection
