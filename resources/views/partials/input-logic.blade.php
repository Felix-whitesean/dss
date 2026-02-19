<div wire:key="field-{{ $field['name'] }}">
    <div class="flex justify-between items-end mb-2">
        <label class="block text-sm font-bold text-gray-700">{{ $field['label'] }}</label>
        <span class="text-[10px] font-bold {{ $field['required'] ? 'text-red-500' : 'text-gray-400' }} uppercase">
            {{ $field['required'] ? 'Required' : 'Optional' }}
        </span>
    </div>

    @if($field['type'] === 'dropdown')
        {{-- Use .live to make the description appear instantly without clicking out --}}
        <select wire:model.live="formData.{{ $field['name'] }}"
                class="w-full px-4 py-3 bg-gray-50 border-2 rounded-xl border-gray-200 focus:border-blue-500 focus:bg-white outline-none transition">
            <option value="">Select {{ $field['label'] }}</option>
            @foreach($field['options'] as $option)
                <option value="{{ $option }}">{{ $option }}</option>
            @endforeach
        </select>

        {{-- DYNAMIC DESCRIPTION SECTION --}}
        @if(isset($field['descriptions']) && !empty($formData[$field['name']]))
            @php
                $selectedValue = $formData[$field['name']];
                $description = $field['descriptions'][$selectedValue] ?? null;
            @endphp

            @if($description)
                <div class="mt-3 p-4 bg-blue-50 border-l-4 border-blue-400 rounded-r-xl animate-in fade-in slide-in-from-top-2 duration-300">
                    <div class="flex gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-600 mt-0.5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs text-blue-800 leading-relaxed italic">
                            {{ $description }}
                        </p>
                    </div>
                </div>
            @endif
        @endif

    @elseif($field['type'] === 'textarea')
        {{-- Existing Textarea Logic --}}
        <textarea wire:model.blur="formData.{{ $field['name'] }}" rows="4"
                  class="w-full px-4 py-3 bg-gray-50 border-2 rounded-xl border-gray-200 focus:border-blue-500"></textarea>

    @else
        {{-- Existing Text Input Logic --}}
        <input type="text" wire:model.blur="formData.{{ $field['name'] }}"
               class="w-full px-4 py-3 bg-gray-50 border-2 rounded-xl border-gray-200 focus:border-blue-500">
    @endif

    @error('formData.' . $field['name'])
    <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p>
    @enderror
</div>
