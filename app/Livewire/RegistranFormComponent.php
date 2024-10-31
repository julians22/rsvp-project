<?php

namespace App\Livewire;

use App\Models\Event;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;

class RegistranFormComponent extends Component
{

    // Slug
    public $slug;

    #[Validate('required|in:online,offline', as: 'Jadwal Sesi')]
    public $sessions = [
        'online'
    ];

    #[Validate('required', as: 'NAMA LENGKAP')]
    public $name = '';

    #[Validate('required', as: 'BISNIS')]
    public $business = '';

    #[Validate('required', as: 'PERUSAHAAN')]
    public $company = '';

    #[Validate('required', as: 'NO HANDPHONE')]
    public $phone = '';

    #[Validate('required|email', as: 'EMAIL')]
    public $email = '';

    #[Validate('required', as: 'NAMA PESERTA YANG MENGUNDANG')]
    public $invited_by = '';

    #[Validate('required_if:sessions,offline', as: 'PAKET MAKANAN & MINUMAN')]
    public $food = '';

    #[Validate('image|max:4096')] // 4MB Max
    public $payment;

    #[Computed]
    function isOfflineSelected() {
        return in_array('offline', $this->sessions);
    }

    #[Computed]
    function event() {
        return Event::slug($this->slug)
            ->with('detail')
            ->first();
    }

    #[Computed]
    function online_hour() {
        return $this->event->detail->online_time ?? '';
    }

    #[Computed]
    function offline_hour() {
        return $this->event->detail->offline_time ?? '';
    }

    #[Computed]
    function offline_foods() {
        return $this->event->detail->offline_foods ?? [];
    }

    public function render()
    {
        return view('livewire.registran-form-component');
    }

    public function save() {
        $this->validate();
    }

    public function mount($slug) {
        $this->slug = $slug;
    }
}
