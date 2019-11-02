<input type="hidden" name="action" value="create">
<input type="hidden" name="group_name" value="users">
<div class="form-group">
    <div class="form-row">
        <div class="col">
            <label for="name">Имя</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ $item->name ?? old('name')}}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="email">E-mail</label>
            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ $item->email ?? old('email')}}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

<div class="form-group">
    <div class="form-row">
        <div class="col">
            <label for="password">Пароль</label>
            <input type="text" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="col">
            <label for="role">Права доступа</label>
            <select class="form-control @error('role') is-invalid @enderror" id="role" name="role">
                <option value="user" {{ (($item->role ?? old('role')) == "user") ? "selected" : "" }}>
                    Управляющий отеля
                </option>

                <option value="admin" {{ (($item->role ?? old('role')) == "admin") ? "selected" : "" }}>
                    Администратор
                </option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>


<div class="row justify-content-center mt-3">
    <button name="button"
        value="users"
        type="submit"
        class="col-4 btn btn-success mb-3">
        <b>Сохранить</b>
    </button>
</div>
