@extends('layouts.app')


@section('page')
    <div class="flex justify-center min-h-screen pb-14">
        @livewire('registran-form-component', ['slug' => $slug])
    </div>
@endsection
