<div>
    {{-- NAMA LENGKAP --}}
    <div class="form-group">
        <label class="form-label text-black" for="name">FULL NAME:</label>
        {{-- <input class="w-full border border-black p-2" id="name" type="text"
        wire:model.blur="name" /> --}}

        <x-searchable-dropdown :options="$this->allMember" property="name" />

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

        <div>
            @error('name')
                <span class="error-form-message">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
