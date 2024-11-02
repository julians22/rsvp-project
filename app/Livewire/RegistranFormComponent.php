<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Visitor;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

class RegistranFormComponent extends Component
{
    use WithFileUploads;

    public $isSubmitted = false;

    public $orderId = null;

    public $slug;

    public $visitor;

    // #[Validate('required', as: 'Jadwal Sesi', message: '* mandatory')]
    public $sessions = ['offline'];

    // #[Validate('required', as: 'NAMA LENGKAP', message: '* mandatory')]
    public $name = '';

    // #[Validate('required', as: 'BISNIS',  message: '* mandatory')]
    public $business = '';

    // #[Validate('required', as: 'PERUSAHAAN',  message: '* mandatory')]
    public $company = '';

    // #[Validate('required', as: 'NO HANDPHONE',  message: '* mandatory')]
    public $phone = '';

    // #[Validate('required', as: 'EMAIL',  message: '* mandatory')]
    // #[Validate('email', as: 'EMAIL',  message: '* invalid email')]
    public $email = '';

    // #[Validate('required', as: 'NAMA PESERTA YANG MENGUNDANG',  message: '* mandatory')]
    public $invited_by = '';

    // #[Validate(
    //     'required_if:sessions.*,offline',
    //     as: 'PAKET MAKANAN & MINUMAN',
    //     message: '* mandatory')]
    public $food;

    // #[Validate('required_if:sessions.*,offline',
    //     as: 'BUKTI PEMBAYARAN',
    //     message: '* mandatory')]
    // #[Validate('image')] // 4MB Max
    // #[Validate('max:4096')]
    public $payment;

    public function rules()
    {
        return [
            "sessions" => "required",
            "name" => "required",
            "business" => "required",
            "company" => "required",
            "phone" => "required",
            "email" => "required",
            "invited_by" => "required",
            "food" =>  [
                Rule::requiredIf(function () {
                    return in_array('offline', $this->sessions);
                })
            ],
            "payment" => [
                Rule::requiredIf(function () {
                    return in_array('offline', $this->sessions);
                })
            ],
        ];
    }

    public function messages()
    {
        return [
            "sessions.required" => "* mandatory",
            "name.required" => "* mandatory",
            "business.required" => "* mandatory",
            "company.required" => "* mandatory",
            "phone.required" => "* mandatory",
            "email.required" => "* mandatory",
            "invited_by.required" => "* mandatory",
            "food.*" => "* mandatory",
        ];
    }

    #[Computed]
    function isOfflineSelected() {
        return in_array('offline', $this->sessions);
    }

    #[Computed]
    function isOnlineSelected() {
        return in_array('online', $this->sessions);
    }

    #[Computed]
    function isNotEmptySessions() : bool
    {
        return count($this->sessions) > 0;
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
        $validated = $this->validate();

        $data = [
            'sessions' => $this->sessions,
            'name' => $this->name,
            'business' => $this->business,
            'company' => $this->company,
            'phone' => $this->phone,
            'email' => $this->email,
            'invited_by' => $this->invited_by,
            'food' => $this->food,
            'event_id' => $this->event->id,
        ];

        if ($this->isOfflineSelected()) {

            $paymentValidate = $this->validate([
                'payment' => 'image|max:4096',
            ], [], ['payment' => 'PROOF OF PAYMENT']);
            $data['is_offline'] = true;

            $lastVisitor = Visitor::where('event_id', $this->event->id)
                ->where('is_offline', true)
                ->orderBy('id', 'desc')
                ->first();

            // upload the payment to public storage
            $payment_path = $this->payment->store(path: 'payments');

            $data['order_id'] = $this->generateOrderId($lastVisitor);

            $data['meta'] = [
                'offline_food' => $this->food,
                'payment_path' => $payment_path,
            ];

        }

        if ($this->isOnlineSelected()) {
            $data['is_online'] = true;
        }

        $visitor = Visitor::create($data);

        $this->isSubmitted = true;
        $this->visitor = $visitor;

        // Print the data
        // dd(
        //     'Data yang akan disimpan:',
        //     $this->sessions, $this->name, $this->business, $this->company, $this->phone, $this->email, $this->invited_by, $this->food, $this->payment);
    }

    protected function generateOrderId($lastOrderId) {
        $lastOrderId = $lastOrderId ? $lastOrderId->order_id : '00000';
        $lastOrderId = (int) $lastOrderId;
        $lastOrderId++;
        return str_pad($lastOrderId, 5, '0', STR_PAD_LEFT);
    }

    public function mount($slug) {
        $this->slug = $slug;
    }
}
