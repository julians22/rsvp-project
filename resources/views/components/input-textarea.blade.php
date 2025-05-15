@props(['label', 'name', 'id', 'placeholder', 'value' => null])

<div class="mb-4">
    <label class="block text-sm font-bold" for="{{ $id ?? $name }}">
        {{ $label }}
    </label>

    <textarea
        class="mt-1 block w-full rounded-md border border-gray-300 bg-white px-3 py-2 shadow-sm focus:border-indigo-500 focus:outline-none focus:ring-indigo-500"
        id="{{ $id ?? $name }}" name="{{ $name }}" placeholder="{{ $placeholder ?? $label }}"
        {{ $errors->has($name) ? 'class=border-red-300' : '' }}>
        {{ $value ?? old($name) }}
    </textarea>

    @error($name)
        <span class="error-form-message">{{ $message }}</span>
    @enderror
</div>
