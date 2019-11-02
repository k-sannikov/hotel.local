@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-8 bg-white border rounded p-3 shadow-sm">
        <form method="post" action="{{ route('admin.settings.destroy', $item->id) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-link px-0">Удалить</button>
        </form>
        <form method="post" action="{{ route('admin.settings.user.update', $item->id) }}">
            @method('put')
            @csrf
            <h5 class="text-center">Редактирование пользователя</h5>
            @include('hotel.admin.settings.partials.form_user')
        </form>
    </div>
</div>
@endsection
