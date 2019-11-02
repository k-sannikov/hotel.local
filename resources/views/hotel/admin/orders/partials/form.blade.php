<div class="form-group">
    <div class="form-row">
        <div class="col">
            <input type="hidden" name="id" value="{{ $item->id ?? '' }}">
            <input type="hidden" name="room_cost" value="">
            <label for="guest_name">ФИО гостя</label>
            <input type="text"
                class="form-control @error('guest_name') is-invalid @enderror"
                id="guest_name"
                name="guest_name"
                value="{{$item->guest_name ?? old('guest_name')}}">
            @error('guest_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
        <div class="col">
            <label for="passport_series">Серия паспорта</label>
            <input type="text"
                class="form-control @error('passport_series') is-invalid @enderror"
                id="passport_series"
                name="passport_series"
                value="{{$item->passport_series ?? old('passport_series')}}">
            @error('passport_series')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="passport_number">Номер паспорта</label>
            <input type="number"
                class="form-control @error('passport_number') is-invalid @enderror"
                id="passport_number"
                name="passport_number"
                value="{{$item->passport_number ?? old('passport_number')}}">
                @error('passport_number')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
        </div>
    </div>
</div>
<div class="form-group">
    <div class="form-row">
        <div class="col">
            <label for="phone_number">Номер телефона</label>
            <input type="text"
                class="form-control @error('phone_number') is-invalid @enderror"
                id="phone_number"
                name="phone_number"
                value="{{$item->phone_number ?? old('phone_number')}}">
            @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="hotel_name">Отель</label>
            <select class="custom-select @error('hotel_name') is-invalid @enderror"
                id="hotel_name"
                name="hotel_name">
                @if(isset($trashed['hotels']))
                    <option value="{{ $trashed['hotels']->value ?? old('hotel_name') }}"
                    selected>
                            {{ $trashed['hotels']->value }} - удалено
                    </option>
                @endif
                @foreach ($settings['hotels'] as $hotel)
                    <option value="{{ $hotel->value }}"
                        {{ (($item->hotel_name ?? old('hotel_name')) == $hotel->value) ? "selected" : ""}}>
                            {{ $hotel->value }}
                    </option>
                    @error('hotel_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                @endforeach
            </select>
        </div>
    </div>
</div>
<fieldset oninput="bookingUnlock()">
    <div class="row">
        <div class="col">
            <h5>Тип номера</h5>
            @if(isset($trashed['rooms']))
                {{--  Номера  --}}
                <div class="custom-control custom-radio">
                    <input class="custom-control-input"
                        type="radio" name="room_type"
                        id="room_type_default"
                        value="{{ $trashed['rooms']->element_name }}"
                        checked>
                    <label class="custom-control-label"
                        for="room_type_default">
                        {{ $trashed['rooms']->element_name }} ({{ $trashed['rooms']->value }} руб.) - удалено
                    </label>
                </div>
                @error('room_type')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            @endif
            @if (isset($item))
                @foreach ($settings['rooms'] as $room)
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input"
                            type="radio" name="room_type"
                            id="{{ 'room_type_' . $room->id }}"
                            value="{{ $room->element_name }}"
                            {{ ($item->room_type == $room->element_name) ? "checked" : "" }}>
                        <label class="custom-control-label"
                            for="{{ 'room_type_' . $room->id }}">
                            {{ $room->element_name }} ({{ $room->value }} руб.)
                        </label>
                    </div>
                @endforeach
                @error('room_type')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            @else
                <input type="hidden" name="room_type" value="">
                {{--  Номера  --}}
                @foreach ($settings['rooms'] as $room)
                    <div class="custom-control custom-radio">
                        <input class="custom-control-input"
                            type="radio" name="room_type"
                            id="{{ 'room_type_' . $room->id }}"
                            value="{{ $room->element_name }}"
                            {{ (old('room_type') == $room->element_name) ? "checked" : "" }}>
                        <label class="custom-control-label"
                            for="{{ 'room_type_' . $room->id }}">
                            {{ $room->element_name }} ({{ $room->value }} руб.)
                        </label>
                    </div>
                @endforeach
                @error('room_type')
                    <p class="text-danger">{{ $message }}</p>
                @enderror
            @endif
        </div>
        <div class="col">
                <h5>Дополнительные услуги</h5>
            {{--  Услуги  --}}
            @if (isset($trashed['amenities']))
                @foreach ($trashed['amenities'] as $key => $value)
                {{--  {{ dd($value) }}  --}}
                    <div class="custom-control custom-checkbox">
                        <input class="custom-control-input"
                            type="checkbox" name="amenities[{{ $value['element_name'] }}]"
                            id="{{ 'amenitie_' . $loop->iteration }}"
                            value="{{ $value['value'] }}"
                            checked>

                        <label class="custom-control-label"
                            for="{{ 'amenitie_' . $loop->iteration }}">
                            {{ $value['element_name'] }} ({{ $value['value'] }} руб.) - удалено
                        </label>
                    </div>
                @endforeach
            @endif
            @if (isset($item))
            @foreach ($settings['amenities'] as $amenitie)
                <div class="custom-control custom-checkbox">
                    <input class="custom-control-input"
                        type="checkbox" name="amenities[{{ $amenitie->element_name }}]"
                        id="{{ 'amenitie_' . $amenitie->id }}"
                        value="{{ $amenitie->value }}"
                        @foreach ($item->amenities as $key => $value)
                        {{ ($amenitie->element_name == $key) ? "checked" : "" }}
                        @endforeach
                        >

                    <label class="custom-control-label"
                        for="{{ 'amenitie_' . $amenitie->id }}">
                        {{ $amenitie->element_name }} ({{ $amenitie->value }} руб.)
                    </label>
                </div>
            @endforeach
            @else
                {{--  Услуги  --}}
                @foreach ($settings['amenities'] as $amenitie)
                        <div class="custom-control custom-checkbox">
                            <input class="custom-control-input"
                                type="checkbox" name="amenities[{{ $amenitie->element_name }}]"
                                id="{{ 'amenitie_' . $amenitie->id }}"
                                value="{{ $amenitie->value }}"
                                {{ ($amenitie->element_name == old("amenities[$amenitie->element_name]")) ? "checked" : "" }}>

                            <label class="custom-control-label"
                                for="{{ 'amenitie_' . $amenitie->id }}">
                                {{ $amenitie->element_name }} ({{ $amenitie->value }} руб.)
                            </label>
                        </div>
                @endforeach
            @endif
        </div>
    </div>
    <div class="form-group">
        <h5 class="text-center">Период проживания</h5>
        <div class="form-row">
            <div class="col">
                <label for="date_of_arrival">Дата заселения</label>
                <input type="date"
                    class="form-control @error('date_of_arrival') is-invalid @enderror"
                    id="date_of_arrival" name="date_of_arrival"
                    @if (isset($item))
                        value="{{ Carbon\Carbon::parse($item->date_of_arrival ?? old('date_of_arrival'))
                            ->toDateString() }}">
                    @else
                        value="{{ Carbon\Carbon::now()->toDateString() }}">
                    @endif
                @error('date_of_arrival')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="col">
                <label for="date_of_departure">Дата выселения</label>
                <input type="date"
                    class="form-control @error('date_of_departure') is-invalid @enderror"
                    id="date_of_departure"
                    name="date_of_departure"
                    value="{{ Carbon\Carbon::parse($item->date_of_departure ?? old('date_of_departure'))
                        ->toDateString() }}">
                @error('date_of_departure')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-row">
        <div class="col">
            <label for="percent_discounts">Скидка в процентах</label>
            <input type="number"
                class="form-control @error('percent_discounts') is-invalid @enderror"
                id="percent_discounts"
                name="percent_discounts"
                value="{{$item->percent_discounts ?? old('percent_discounts')}}"
                max="{{ $settings['discountMax']->value }}"
                min="{{ $settings['discountMin']->value }}">
            @error('percent_discounts')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="amount_discounts">Сумма скидки</label>
            <input type="number"
            class="form-control"
            id="amount_discounts"
            name="amount_discounts"
            value="{{$item->amount_discounts ?? old('amount_discounts')}}"
            readonly>
        </div>
    </div>
    @if (isset($item))
        <div class="row justify-content-center mt-3">
            <h3>ИТОГО: {{ $item->total_cost ?? old('total_cost') }} руб</h3>
            <input type="hidden"
                name="total_cost"
                value="{{ $item->total_cost ?? old('total_cost') }}">
        </div>
    @endif
</fieldset>

<div class="row justify-content-center mt-3">
    <a class="col-3 btn btn-secondary mx-3" href="{{ route('orders.index') }}" role="button"><b>Назад</b></a>
    @if (isset($item->id))
    <button name="button" value="calculation" type="submit" class="col-3 btn btn-primary mx-3"
        formaction="{{ route('orders.edit',  $item->id) }}"
        formmethod="GET"
        form="order_form">
        <b>Расчет</b>
    </button>
    @else
    <button name="button" value="calculation" type="submit" class="col-3 btn btn-primary mx-3"
        formaction="{{ route('orders.create') }}"
        formmethod="GET"
        form="order_form">
        <b>Расчет</b>
    </button>
    @endif
    @if (isset($item->id))
        <button name="button" value="booking-update" type="submit" class="col-3 btn btn-success mx-3"
            formaction="{{ route('orders.update', $item->id) }}"
            formmethod="POST"
            form="order_form"
            id="booking">
            <b>Сохранить изменения</b>
        </button>
    @else
        <button name="button" value="booking-create" type="submit" class="col-3 btn btn-success mx-3"
            formaction="{{ route('orders.store') }}"
            formmethod="POST"
            form="order_form"
            id="booking">
            <b>Бронирование</b>
        </button>
    @endif
</div>

<script>
    function bookingUnlock() {
        var booking = document.querySelector("#booking");
        booking.setAttribute("disabled", "disabled");
    }
</script>
