@props(['label', 'name', 'id', 'placeholder' => ''])

<div class="mb-4">
    <label class="block text-sm font-bold" for="{{ $id ?? $name }}">{{ $label }}</label>
    <input id="{{ $id ?? $name }}" name="{{ $name }}"
        {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500' . ($errors->has($name) ? ' border-red-300' : '')]) }}
        type="text" placeholder="{{ $placeholder }}" value="{{ old($name, $attributes->get('value')) }}">

    @error($name)
        <span class="error-form-message">{{ $message }}</span>
    @enderror
</div>
