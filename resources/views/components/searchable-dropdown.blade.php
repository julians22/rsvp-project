@props(['options', 'property'])

<div x-data="{
    open: false,
    search: '',
    selectedMember: @entangle($property).live,
    selectedId: null,
    // use this format : [['id' => 1, 'name' => 'A'], ['id' => 2, 'name' => 'B'], ['id' => 3, 'name' => 'C']]
    options: @js($options),
    get filteredOptions() {
        if (!this.search.trim()) return this.options;
        return this.options.filter(option => option.name.toLowerCase().includes(this.search.toLowerCase()));
    },
    get selectedOption() {
        if (!this.selectedMember) return null;
        return this.options.find(option => option.id === this.selectedId);
    },
    selectOption(option) {
        this.selectedMember = option.name;
        this.selectedId = option.id;
        this.open = false;
    }
}">
    <div class="form-group relative mt-2">
        <button
            class="text-normal form-label relative w-full cursor-pointer border-gray-300 bg-white py-2 pl-3 pr-10 text-left text-black shadow-sm ring-1 ring-inset ring-gray-300 focus:border-gray-300 focus:ring-gray-300"
            @click="open = !open" type="button">
            <span class="block truncate" x-text="selectedOption ? selectedOption.name : 'Select an option'"></span>
            <span class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2">
                <svg class="h-5 w-5 text-gray-800" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd"
                        d="M10 3a.75.75 0 01.55.24l3.25 3.5a.75.75 0 11-1.1 1.02L10 4.852 7.3 7.76a.75.75 0 01-1.1-1.02l3.25-3.5A.75.75 0 0110 3zm-3.76 9.2a.75.75 0 011.06.04l2.7 2.908 2.7-2.908a.75.75 0 111.1 1.02l-3.25 3.5a.75.75 0 01-1.1 0l-3.25-3.5a.75.75 0 01.04-1.06z"
                        clip-rule="evenodd" />
                </svg>
            </span>
        </button>

        <div class="absolute z-50 mt-1 max-h-60 w-full overflow-auto bg-white py-1 text-base shadow-lg" x-show="open"
            @click.away="open = false" x-cloak>
            <input class="block w-full border-0 border-b border-gray-300 bg-white pb-2 pl-3 text-left focus:ring-0"
                type="text" x-model="search" placeholder="Search...">
            <ul class="max-h-60 overflow-auto">
                <template x-for="option in filteredOptions" :key="option.id">
                    <li class="cursor-pointer select-none py-2 pl-3 pr-9 hover:bg-gray-100 hover:text-gray-800"
                        @click="selectOption(option)"
                        :class="{ 'bg-gray-600 text-white': selectedOption && selectedOption.id === option.id }">
                        <span class="block truncate font-normal" x-text="option.name"></span>
                    </li>
                </template>
            </ul>
        </div>
    </div>
</div>