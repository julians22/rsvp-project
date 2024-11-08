@extends('layouts.app')


@section('page')
    <div class="min-h-screen pb-14">
        <div>
            @livewire('registran-form-component', ['slug' => $slug])
        </div>
    </div>
@endsection

@push('after-scipts')

@filepondScripts

<script>
    Livewire.hook('commit', ({ succeed }) => {
        succeed(() => {
            setTimeout(() => {
                const firstErrorMessage = document.querySelector('.error-form-message')

                if (firstErrorMessage !== null) {
                    firstErrorMessage.scrollIntoView({ block: 'center', inline: 'center' })
                }
            }, 0)
        })
    })
</script>
@endpush
