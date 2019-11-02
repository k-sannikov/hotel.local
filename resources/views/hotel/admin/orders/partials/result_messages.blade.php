{{-- Вывод списка уведомлений --}}
@if(!is_null(session('message')))
    @foreach(session('message') as $message)
        <div class="row justify-content-center">
            <div class="alert alert-success alert-dismissible fade show col-8" role="alert">
                {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    @endforeach
@endif
