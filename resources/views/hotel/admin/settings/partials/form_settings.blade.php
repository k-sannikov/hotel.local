<div class="container-fluid accordion" id="settings">
    <div class="card">
        <div class="card-header" id="rooms">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseRooms" aria-expanded="false" aria-controls="collapseRooms">
                    Настройки номеров
                </button>
            </h5>
        </div>

    <div id="collapseRooms" class="collapse {{ session('rooms') ? 'show':''}}" aria-labelledby="rooms" data-parent="#settings">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.settings.store') }}">
                    @csrf
                    <input type="hidden" name="action" value="create">
                    <input type="hidden" name="group_name" value="rooms">
                    <h5 class="text-center">Добавление нового типа номера</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="element_name">Тип номера</label>
                                <input type="text"
                                    class="form-control"
                                    id="element_name"
                                    name="element_name"
                                    value="{{ old('element_name') }}">
                            </div>
                            <div class="col">
                                <label for="value">Стоимость</label>
                                <input type="text"
                                    class="form-control"
                                    id="value"
                                    name="value"
                                    value="{{ old('value') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <button name="button"
                            value="rooms"
                            type="submit"
                            class="col-4 btn btn-success mb-3">
                            <b>Сохранить</b>
                        </button>
                    </div>
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Тип номера</th>
                            <th>Стоимость номера</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($settings['rooms'] as $setting)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('admin.settings.edit', $setting->id) }}">
                                        {{ $setting->element_name }}
                                    </a>
                                </td>
                                <td> {{ $setting->value }} </td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="3">
                                    Список пуст
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header" id="amenities">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseAmenities" aria-expanded="false" aria-controls="collapseAmenities">
                    Настройки услуг
                </button>
            </h5>
        </div>

        <div id="collapseAmenities" class="collapse {{ session('amenities') ? 'show':''}}" aria-labelledby="amenities" data-parent="#settings">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.settings.store') }}">
                    @csrf
                    <input type="hidden" name="action" value="create">
                    <input type="hidden" name="group_name" value="amenities">
                    <h5 class="text-center">Добавление новой услуги</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="element_name">Наименование услуги</label>
                                <input type="text"
                                    class="form-control"
                                    id="element_name"
                                    name="element_name"
                                    value="{{ old('element_name') }}">
                            </div>
                            <div class="col">
                                <label for="value">Стоимость</label>
                                <input type="text"
                                    class="form-control"
                                    id="value"
                                    name="value"
                                    value="{{ old('value') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <button name="button"
                            value="amenities"
                            type="submit"
                            class="col-4 btn btn-success mb-3">
                            <b>Сохранить</b>
                        </button>
                    </div>
                </form>
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Наименование услуги</th>
                                <th>Стоимость услуги</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($settings['amenities'] as $setting)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('admin.settings.edit', $setting->id) }}">
                                            {{ $setting->element_name }}
                                        </a>
                                    </td>
                                    <td> {{ $setting->value }} </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="3">
                                        Список пуст
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header" id="hotels">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseHotels" aria-expanded="false" aria-controls="collapseHotels">
                    Настройки списка отелей
                </button>
            </h5>
        </div>

        <div id="collapseHotels" class="collapse {{ session('hotels') ? 'show':''}}" aria-labelledby="hotels" data-parent="#settings">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.settings.store') }}">
                    @csrf
                    <input type="hidden" name="action" value="create">
                    <input type="hidden" name="group_name" value="hotels">
                    <h5 class="text-center">Добавление нового отеля</h5>
                    <div class="form-group">
                        <div class="form-row">
                            <input type="hidden" name="element_name" value="Отель">
                            <div class="col">
                                <label for="value">Наименование отеля</label>
                                <input type="text"
                                    class="form-control"
                                    id="value"
                                    name="value"
                                    value="{{ old('value') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <button name="button"
                            value="hotels"
                            type="submit"
                            class="col-4 btn btn-success mb-3">
                            <b>Сохранить</b>
                        </button>
                    </div>
                </form>
                <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Наименование отеля</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($settings['hotels'] as $setting)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <a href="{{ route('admin.settings.edit', $setting->id) }}">
                                            {{ $setting->value }}
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class="text-center" colspan="3">
                                        Список пуст
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header" id="discount">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseDiscount" aria-expanded="false" aria-controls="collapseDiscount">
                    Настройки скидки
                </button>
            </h5>
        </div>
        <div id="collapseDiscount" class="collapse {{ session('discount') ? 'show':''}}" aria-labelledby="discount" data-parent="#settings">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.settings.update', $settings['discountMin']->id) }}">
                    @method('put')
                    @csrf
                    <input type="hidden" name="group_name" value="discount">
                    <input type="hidden" name="element_name" value="min">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="value">Минимальная скидка</label>
                                <input type="text"
                                    class="form-control"
                                    id="value"
                                    name="value"
                                    value="{{ $settings['discountMin']->value ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <button name="button"
                            value="min"
                            type="submit"
                            class="col-4 btn btn-success mb-3">
                            <b>Сохранить</b>
                        </button>
                    </div>
                </form>
                <form method="POST" action="{{ route('admin.settings.update', $settings['discountMax']->id) }}">
                    @method('put')
                    @csrf
                    <input type="hidden" name="group_name" value="discount">
                    <input type="hidden" name="element_name" value="max">
                    <div class="form-group">
                        <div class="form-row">
                            <div class="col">
                                <label for="value">Максимальная скидка</label>
                                <input type="text"
                                    class="form-control"
                                    id="value"
                                    name="value"
                                    value="{{ $settings['discountMax']->value ?? '' }}">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <button name="button"
                            value="max"
                            type="submit"
                            class="col-4 btn btn-success mb-3">
                            <b>Сохранить</b>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="card">
        <div class="card-header" id="users">
            <h5 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseUsers" aria-expanded="false" aria-controls="collapseUsers">
                    Настройки списка пользователей
                </button>
            </h5>
        </div>

        <div id="collapseUsers" class="collapse {{ session('users') ? 'show':''}}" aria-labelledby="users" data-parent="#settings">
            <div class="card-body">
                <form method="POST" action="{{ route('admin.settings.user.store') }}">
                    @csrf
                    <h5 class="text-center">Добавление нового пользователя</h5>
                    @include('hotel.admin.settings.partials.form_user')
                </form>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>ФИО</th>
                            <th>Должность</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($settings['users'] as $setting)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <a href="{{ route('admin.settings.user.edit', $setting->id) }}">
                                        {{ $setting->name }}
                                    </a>
                                </td>
                                <td>{{ $setting->position }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td class="text-center" colspan="3">
                                    Список пуст
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
