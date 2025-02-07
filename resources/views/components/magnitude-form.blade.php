<div>
    {{-- NAMA LENGKAP --}}
    <div class="form-group">
        <label class="form-label text-black" for="name">FULL NAME:</label>
        {{-- <input class="w-full border border-black p-2" id="name" type="text"
        wire:model.blur="name" /> --}}

        <x-searchable-dropdown :options="$this->allMember" member-name="name" member-email="email" member-phone="phone" />

        <div>
            @error('name')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
            @error('phone')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
            @error('email')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
