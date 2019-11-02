@extends('layouts.app')

@section('content')
@include('hotel.admin.settings.partials.result_messages')
<div class="row justify-content-center">
    <div class="col-8 bg-white border rounded p-3 shadow-sm">
        <form method="post" action="{{ route('admin.settings.destroy', $item->id) }}">
            @method('delete')
            @csrf
            <button type="submit" class="btn btn-link px-0">Удалить</button>
        </form>
        @include('hotel.admin.settings.partials.form_edit')
    </div>
</div>
@endsection
