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

    {{-- STATUS --}}
    <div class="form-group">
        <label class="form-label text-black" for="status">STATUS:</label>
        <select id="status" required name="status" wire:model="status">
            <option value="">- PLEASE SELECT STATUS -</option>
            @use(App\Enums\VisitorStatusType)
            @foreach (VisitorStatusType::cases() as $status)
                <option value="{{ $status->value }}">
                    {{ $status->getLabel() }}
                </option>
            @endforeach
        </select>
        <div>
            @error('status')
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

    <div @class(['form-group', 'hidden' => !$this->event->checkable])>
        <label class="form-label text-black" for="">WILL BE ATTENDING TO: (May choose
            both)</label>

        <div class="flex flex-col space-y-2 lg:flex-row lg:space-x-3 lg:space-y-0">
            <div>
                <label @class([
                    'inline-flex items-center',
                    'cursor-not-allowed opacity-50 hidden' => !$this->event->is_online_event,
                ])>
                    <input @class([
                        'h-6 w-6 border-2 border-gray-300 text-black focus:border-gray-300 focus:ring-black',
                        'cursor-not-allowed opacity-50 ' => !$this->event->is_online_event,
                    ]) type="checkbox" value="online" @disabled(!$this->event->is_online_event)
                        wire:model.live="sessions">
                    <span class="ml-2 text-lg font-semibold">Online
                        {{ $this->online_hour }} Pagi</span>
                </label>
            </div>

            <div>
                <label @class([
                    'inline-flex items-center',
                    'cursor-not-allowed opacity-50 hidden' => !$this->event->is_offline_event,
                ])>
                    <input @class([
                        'h-6 w-6 border-2 border-gray-300 text-black focus:border-gray-300 focus:ring-black',
                        'cursor-not-allowed ' => !$this->event->is_offline_event,
                    ]) type="checkbox" value="offline" wire:model.live="sessions"
                        @disabled(!$this->event->is_offline_event)>
                    <span class="ml-2 text-lg font-semibold">Offine {{ $this->offline_hour }}
                        Siang</span>
                </label>
            </div>
        </div>

        <div>
            @error('sessions')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
        </div>

    </div>
</div>
