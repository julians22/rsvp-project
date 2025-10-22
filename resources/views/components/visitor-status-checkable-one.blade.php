 <div @class(['form-group', 'hidden' => !$this->event->checkable])>
     <label class="form-label text-black" for="">WILL BE ATTENDING TO: </label>

     <div class="flex flex-col space-y-2 lg:flex-row lg:space-x-3 lg:space-y-0">
         <div wire:click="handleStatusChange('online')">
             <label @class([
                 'inline-flex items-center',
                 'cursor-not-allowed opacity-50 hidden' => !$this->event->is_online_event,
             ])>
                 <input @class([
                     'h-6 w-6 border-2 border-gray-300 text-black focus:border-gray-300 focus:ring-black',
                     'cursor-not-allowed opacity-50 ' => !$this->event->is_online_event,
                 ]) type="checkbox" value="online" disabled
                     @if (in_array('online', $sessions)) checked @endif>
                 <span class="ml-2 text-lg font-semibold">Online
                     {{ $this->event->detail->online_time_no_seconds }}</span>
             </label>
         </div>

         <div wire:click="handleStatusChange('offline')">
             <label @class([
                 'inline-flex items-center',
                 'cursor-not-allowed opacity-50 hidden' => !$this->event->is_offline_event,
             ])>
                 <input @class([
                     'h-6 w-6 border-2 border-gray-300 text-black focus:border-gray-300 focus:ring-black',
                     'cursor-not-allowed ' => !$this->event->is_offline_event,
                 ]) type="checkbox" value="offline"
                     @if (in_array('offline', $sessions)) checked @endif disabled>
                 <span class="ml-2 text-lg font-semibold">Offline
                     {{ $this->event->detail->offline_time_no_seconds }}</span>
             </label>
         </div>
     </div>

     <div>
         @error('sessions')
             <span class="error-form-message">{{ $message }}</span>
         @enderror
     </div>
 </div>

 @if ($this->type === \App\Enums\VisitorType::MAGNITUDE->value)
     {{-- STATUS --}}
     @if ($this->isEmptySessions())
         <div class="form-group my-4">

             <label class="form-label text-black" for="status">
                 STATUS KETIDAKHADIRAN :
             </label>
             <select id="status" required name="status" wire:model.live="status">
                 <option value="">- PLEASE SELECT STATUS -</option>
                 @foreach ($this->getStatusType() as $status_item)
                     <option value="{{ $status_item->value }}" wire:key='{{ $status_item->value }}'>
                         {{ $status_item->getLabel() }}
                     </option>
                 @endforeach
             </select>
             <div>
                 @error('status')
                     <span class="error-form-message">{{ $message }}</span>
                 @enderror
             </div>
         </div>

         @if ($status === App\Enums\VisitorStatusType::SUBSTITUTE->value)
             {{-- SUBSTITUTED BY --}}
             <div class="form-group">
                 <label class="form-label text-black" for="substituted_by">Substituted by: </label>
                 <input class="w-full border border-black p-2" id="substituted_by" required type="text"
                     wire:model.blur="substituted_by" />
                 <div>
                     @error('substituted_by')
                         <span class="error-form-message">{{ $message }}</span>
                     @enderror
                 </div>
             </div>
         @endif

     @endif
 @endif
