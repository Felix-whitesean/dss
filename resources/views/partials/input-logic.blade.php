
<div wire:key="field-{{ $field['name'] }}">
    @php
        $showField = true;

        if(isset($field['condition'])) {

            $conditionField = $field['condition']['field'];
            $conditionValue = $field['condition']['value'] ?? true;
            $currentValue = $formData[$conditionField] ?? null;

            // If parent field has not been selected yet → hide completely
            if(empty($currentValue)) {
                $showField = false;
            }
            // If parent selected but does not match required value → hide
            elseif($currentValue != $conditionValue) {
                $showField = false;
            }
            else {
                $showField = true;
            }
        }
    @endphp

    @if($showField)
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

        @elseif($field['type'] === 'checkbox' && isset($field['options']))
            <div class="mb-4">
                <label class="block font-bold mb-2">{{ $field['label'] }}</label>
                <div class="flex flex-col gap-2">
                    @foreach($field['options'] as $option)
                        @php
                            // Generate a unique name for each checkbox
                            $checkboxName = $field['name'] . '_' . \Illuminate\Support\Str::slug($option, '_');
                        @endphp
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox"
                                   wire:model="formData.{{ $checkboxName }}"
                                   class="w-5 h-5 rounded border-gray-300 text-blue-600">
                            <span>{{ $option }}</span>
                        </label>
                    @endforeach
                </div>
            </div>

        @elseif($field['type'] === 'textarea')
            {{-- Existing Textarea Logic --}}
            <textarea wire:model.blur="formData.{{ $field['name'] }}" rows="4"
                      class="w-full px-4 py-3 bg-gray-50 border-2 rounded-xl border-gray-200 focus:border-blue-500"></textarea>
        {{--        --}}
        @elseif($field['type'] === 'file')

            <div class="relative">

                <input type="file"
                       wire:model="formData.{{ $field['name'] }}"
                       @if(isset($field['accept'])) accept="{{ $field['accept'] }}" @endif
                       class="w-full px-4 py-3 bg-gray-50 border-2 rounded-xl border-gray-200 focus:border-blue-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition">

                 Loading Indicator
                <div wire:loading wire:target="formData.{{ $field['name'] }}"
                     class="text-xs text-blue-600 mt-2 font-bold">
                    Uploading...
                </div>

                 Image Preview
                @if(isset($formData[$field['name']]) && is_object($formData[$field['name']]))
                    @if(str_starts_with($formData[$field['name']]->getMimeType(), 'image/'))
                        <div class="mt-3">
                            <img src="{{ $formData[$field['name']]->temporaryUrl() }}"
                                 class="w-40 rounded-xl shadow-md">
                        </div>
                    @endif
                @endif

            </div>
        @else
            {{-- Existing Text Input Logic --}}
            <input type="{{$field['type'] ?? 'text'}}" wire:model.blur="formData.{{ $field['name'] }}"
                   class="w-full px-4 py-3 bg-gray-50 border-2 rounded-xl border-gray-200 focus:border-blue-500">
        @endif

        @error('formData.' . $field['name'])
            <p class="mt-1 text-xs text-red-500 font-bold">{{ $message }}</p>
        @enderror
    @endif
</div>
