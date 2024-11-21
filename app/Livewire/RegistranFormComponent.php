<?php

namespace App\Livewire;

use App\Enums\VisitorType;
use App\Mail\VisitorMail;
use App\Models\Event;
use App\Models\Visitor;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\LivewireFilepond\WithFilePond;
use Spatie\Image;

class RegistranFormComponent extends Component
{
    use WithFileUploads;
    // use WithFilePond;

    public $isSubmitted = false;

    public $slug;

    public $visitor;

    public $sessions = [];

    public $type = '';

    public $name = '';

    public $business = '';

    public $company = '';

    public $phone = '';

    public $email = '';

    public $invited_by = '';

    public $food = "";

    public $payment;

    public $visitor_type = [];

    public $invited_by_disabled = false;

    public function updatedType()
    {
        $this->invited_by_disabled = $this->type !== VisitorType::VISITOR->value;

        if ($this->invited_by_disabled) {
            $this->reset(['invited_by']);
        }
    }

    public function updatedSessions()
    {
        $this->updateVisitorType();
    }

    /**
     * Updates the visitor type array based on the online and offline sessions selected.
     *
     * If both online and offline sessions are selected, all visitor types are available.
     * If only online sessions are selected, all visitor types are available.
     * If only offline sessions are selected, only visitor types that are applicable to offline
     * events are available.
     * If no sessions are selected, the visitor type array is empty.
     *
     * @return void
     */
    public function updateVisitorType()
    {
        if ($this->event->detail->override_offline_visitor_type) {
            $offlineVisitorTypes = [];

            foreach ($this->event->detail->offline_visitor_type_list as $visitor_type) {

                $enumVisitor = VisitorType::tryFrom($visitor_type);

                if ($enumVisitor !== null) {
                    $offlineVisitorTypes[] = $enumVisitor;
                }
            }
        } else {
            $offlineVisitorTypes = [
                \App\Enums\VisitorType::VISITOR,
                \App\Enums\VisitorType::MAGNITUDE,
                \App\Enums\VisitorType::ALTITUDE
            ];
        }

        if ($this->event->detail->override_online_visitor_type) {
            $onlineVisitorTypes = [];

            foreach ($this->event->detail->online_visitor_type_list as $visitor_type) {

                $enumVisitor = VisitorType::tryFrom($visitor_type);

                if ($enumVisitor !== null) {
                    $onlineVisitorTypes[] = $enumVisitor;
                }
            }
        } else {
            $onlineVisitorTypes = \App\Enums\VisitorType::cases();
        }


        $this->type = '';

        if ($this->isOfflineSelected() && $this->isOnlineSelected()) {
            $this->visitor_type = $onlineVisitorTypes + $offlineVisitorTypes;
        } elseif ($this->isOnlineSelected()) {
            $this->visitor_type = $onlineVisitorTypes;
        } elseif ($this->isOfflineSelected()) {
            $this->visitor_type = $offlineVisitorTypes;
        } else {
            $this->visitor_type = [];
        }
    }

    public function rules()
    {
        return [
            "sessions" => "required",
            "name" => "required",
            "business" => "required",
            "company" => "required",
            "phone" => "required",
            "email" => Rule::unique('visitors')->where(function ($query) {
                return $query->where('email', $this->email)
                    ->where('event_id', $this->event->id);
            }),
            "invited_by" => "sometimes",
            'type' => ['required', Rule::enum(VisitorType::class)],
            // "food" =>  [
            //     Rule::requiredIf(function () {
            //         return in_array('offline', $this->sessions);
            //     })
            // ],
            // "payment" => [
            //     'mimetypes:image/jpg,image/jpeg,image/png',
            //     'max:3000',
            //     Rule::requiredIf(function () {
            //         return in_array('offline', $this->sessions);
            //     })
            // ],
        ];
    }

    public function messages()
    {
        return [
            "type.required" => "* mandatory",
            "type.enum" => "* mandatory",
            "sessions.required" => "* mandatory",
            "sessions.*" => "* mandatory",
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
    function isOfflineSelected()
    {
        return in_array('offline', $this->sessions ?? []);
    }

    #[Computed]
    function isOnlineSelected()
    {
        return in_array('online', $this->sessions ?? []);
    }

    #[Computed]
    function isEmptySessions(): bool
    {
        return !$this->isOfflineSelected() && !$this->isOnlineSelected();
    }

    #[Computed]
    function event()
    {
        return Event::slug($this->slug)
            ->with('detail')
            ->first();
    }

    #[Computed]
    function online_hour()
    {
        return $this->event->detail->online_time ? $this->removeSeconds($this->event->detail->online_time) : '';
    }

    #[Computed]
    function offline_hour()
    {
        return $this->event->detail->offline_time ? $this->removeSeconds($this->event->detail->offline_time) : '';
    }

    #[Computed]
    function offline_foods()
    {
        return $this->event->detail->offline_foods ?? [];
    }

    protected function removeSeconds($time)
    {
        return date('h:i', strtotime($time));
    }

    public function render()
    {
        return view('livewire.registran-form-component');
    }

    public function save()
    {
        $validated = $this->validate();

        $data = [
            'sessions' => $this->sessions,
            'type' => $this->type,
            'name' => $this->name,
            'business' => $this->business,
            'company' => $this->company,
            'phone' => $this->phone,
            'email' => $this->email,
            'invited_by' => $this->invited_by ?? null,
            'food' => $this->food,
            'event_id' => $this->event->id,
        ];

        if ($this->isOfflineSelected()) {


            if (count($this->offline_foods)) {
                $this->validate([
                    'food' => 'required',
                    'payment' => 'image|max:4096',
                ], [
                    'food.required' => '* mandatory',
                    'payment.image' => 'File must be an image',
                    'payment.max' => 'File size must be less than 4MB',
                ], ['payment' => 'PROOF OF PAYMENT'], ['food' => 'FOOD']);
            }

            $data['is_offline'] = true;

            $lastVisitor = Visitor::where('event_id', $this->event->id)
                ->where('is_offline', true)
                ->orderBy('id', 'desc')
                ->first();

            $data['order_id'] = $this->generateOrderId($lastVisitor);
        }

        if ($this->isOnlineSelected()) {
            $data['is_online'] = true;
        }

        $visitor = Visitor::create($data);
        if ($this->isOfflineSelected() && count($this->offline_foods)) {
            $visitor->addMedia($this->payment->getRealPath())
                ->preservingOriginal()
                ->toMediaCollection('payment_proof');
        }

        $this->visitor = $visitor;

        try {
            // Mail to visitor

            Mail::to($this->email)
                ->send(new VisitorMail($this->visitor));
        } catch (\Throwable $th) {
            // Log error
        }

        $this->isSubmitted = true;
    }

    protected function generateOrderId($lastOrderId)
    {
        $lastOrderId = $lastOrderId ? $lastOrderId->order_id : '00000';
        $lastOrderId = (int) $lastOrderId;
        $lastOrderId++;
        return str_pad($lastOrderId, 5, '0', STR_PAD_LEFT);
    }

    public function mount($slug, $event)
    {
        $this->slug = $slug;
        $this->event = $event;

        $this->sessions = $event->session;

        $this->updateVisitorType();
    }
}
