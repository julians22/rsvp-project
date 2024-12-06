<div>
    {{-- NAMA LENGKAP --}}
    <div class="form-group">
        <label class="form-label text-black" for="name">FULL NAME:</label>
        <input class="w-full border border-black p-2" id="name" type="text" wire:model.blur="name" />
        <div>
            @error('name')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- Klasifikasi Bisnis --}}
    <div class="form-group">
        <label class="form-label text-black" for="business">BUSINESS CLASSIFICATION:</label>
        <input class="w-full border border-black p-2" id="business" type="text" wire:model='business' />
        <div>
            @error('business')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- Nama Perusahaan --}}
    <div class="form-group">
        <label class="form-label text-black" for="company">COMPANY NAME:</label>
        <input class="w-full border border-black p-2" id="company" type="text" wire:model='company' />
        <div>
            @error('company')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- NO HANDPHONE / WHATSAPP --}}
    <div class="form-group">
        <label class="form-label text-black" for="phone">MOBILE PHONE / WHATSAPP:</label>
        <input class="w-full border border-black p-2" id="phone" type="tel" wire:model='phone' />
        <div>
            @error('phone')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- EMAIL --}}
    <div class="form-group">
        <label class="form-label text-black" for="email">EMAIL:</label>
        <input class="w-full border border-black p-2" id="email" type="email" wire:model='email' />
        <div>
            @error('email')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
        </div>
    </div>

    {{-- DIUNDANG OLEH: (Nama + Chapter) --}}
    <div class="form-group">
        <label class="form-label text-black" for="invited_by">INVITED BY: (Name + Chapter):</label>
        <input id="invited_by" @class([
            'w-full border border-black p-2',
            'bg-gray-400/50 cursor-not-allowed' => $this->invited_by_disabled,
        ]) @disabled($this->invited_by_disabled) type="text"
            wire:model='invited_by' />
        <div>
            @error('invited_by')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
        </div>
    </div>


</div>
