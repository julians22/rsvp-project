@extends('layouts.app')


@section('page')
    <div class="min-h-screen pb-14">
        <div>
            @livewire('registran-form-component', ['slug' => $slug])
        </div>
    </div>
@endsection
