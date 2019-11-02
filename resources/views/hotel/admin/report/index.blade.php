@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-8 bg-white border rounded p-3 shadow-sm">
        <form action="{{ route('admin.report.generate') }}" method="POST">
            @csrf
            <div class="form-group">
                <div class="form-row">
                    <a class="btn btn-link px-1" href="{{ route('admin.report.index') }}">Сброс значений</a>
                </div>
                <div class="form-row">
                    <div class="col-3">
                        <label for="hotel_name">Отель</label>
                        <select class="custom-select @error('phone_number') is-invalid @enderror"
                            id="hotel_name"
                            name="hotel_name">
                            @foreach ($hotels as $hotel)
                                <option value="{{ $hotel->value }}"
                                    {{ (($item['hotel_name'] ?? old('hotel_name')) == $hotel->value) ? "selected" : ""}}>
                                        {{ $hotel->value }}
                                </option>
                                @error('hotel_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="beginning">Дата начала периода</label>
                        <input type="date"
                            class="form-control @error('beginning') is-invalid @enderror"
                            id="beginning"
                            name="beginning"
                            value="{{$item['beginning'] ?? old('beginning')}}">
                        @error('beginning')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col">
                        <label for="end">Дата окончания периода</label>
                        <div class="input-group mb-3">
                            <input type="date"
                            class="form-control @error('end') is-invalid @enderror"
                            id="end"
                            name="end"
                            value="{{$item['end'] ?? old('end')}}">
                            <div class="input-group-append">
                                <button class="btn btn-success rounded-right" type="submit">
                                    Генерация отчета
                                </button>
                            </div>
                            @error('end')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if (isset($item))
            <h5 class="text-center">
                Выручка для отеля "{{ $item['hotel_name'] }}" <br> с {{ $item['readable_format_beginning'] }}
                по {{ $item['readable_format_end'] }} составила: {{ $item['result'] }} руб.
            </h5>
        @endif
    </div>
</div>
@endsection
