<form method="POST" action="{{ route('admin.settings.update', $item->id) }}">
    @method('put')
    @csrf
    <input type="hidden" name="action" value="edit">
    <h5 class="text-center">Редактирование записи</h5>
    <div class="form-group">
        <div class="form-row">
            @if($item)
            <div class="col">
                <input type="text"
                    class="form-control @error('element_name') is-invalid @enderror"
                    id="element_name"
                    name="element_name"
                    value="{{ $item->element_name ?? old('element_name')}}">
                @error('element_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            @endif
            <div class="col">
                <input type="text"
                    class="form-control @error('value') is-invalid @enderror"
                    id="value"
                    name="value"
                    value="{{ $item->value ?? old('value')}}">
                @error('value')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-3">
        <button name="button"
            value="{{ $item->group_name }}"
            type="submit"
            class="col-4 btn btn-success mb-3">
            <b>Сохранить</b>
        </button>
    </div>
</form>
