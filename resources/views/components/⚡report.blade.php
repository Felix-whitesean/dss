<?php
namespace App\Livewire;

use App\Models\Report;
use Livewire\Component;
use Livewire\Attributes\Url;

new class extends Component {
    #[Url]
    public $activePage = 'Personal';

    public $formData = [];
    public $activeGroupField = [];
    public $showPreview = false; // Controls the popup
    public $consent = false;
    public $casePassword = '';

    public $fieldList = [
        // Personal Page
        ['label' => 'Full Name', 'name' => 'fullname', 'page' => 'Personal', 'group' => null, 'required' => true, 'type' => 'text'],
        ['label' => 'Survivor Age', 'name' => 'survivor_age', 'page' => 'Personal', 'group' => null, 'required' => true, 'type' => 'text'],
        ['label' => 'Gender', 'name' => 'gender', 'page' => 'Personal', 'group' => null, 'required' => true, 'type' => 'dropdown', 'options' => ['Male', 'Female', 'Intersex', 'Other']],
        ['label' => 'Age Range', 'name' => 'age_range', 'page' => 'Personal', 'group' => null, 'required' => true, 'type' => 'dropdown', 'options' => ['Child (0-17)', 'Youth (18-35)', 'Adult (36-60)', 'Senior (60+)']],

        // Contact Page
        ['label' => 'Phone', 'name' => 'phone_number', 'page' => 'Contact', 'group' => 'Communication', 'required' => true, 'type' => 'text'],
        ['label' => 'Email', 'name' => 'email_address', 'page' => 'Contact', 'group' => 'Communication', 'required' => true, 'type' => 'text'],

        // Incident Details Page
        ['label' => 'Incident Description', 'name' => 'description', 'page' => 'Incident', 'group' => null, 'required' => true, 'type' => 'textarea'],
        ['label' => 'TFGBV Type', 'name' => 'tfgbv_type', 'page' => 'Incident', 'group' => null, 'required' => true, 'type' => 'dropdown',
            'options' => ['Hacking', 'Image-based abuse', 'Cyberstalking', 'Doxing', 'Online harassment'],
            'descriptions' => [
                "Hacking" => "Unauthorized access to private accounts to monitor, control, or impersonate a survivor.",
                "Image-based abuse" => "Non-consensual creation or distribution of intimate images or videos.",
                "Cyberstalking" => "Persistent monitoring or harassment using technology to create fear.",
                "Doxing" => "Publishing private personal info online to encourage harassment.",
                "Online harassment" => "Abusive messages or trolling based on gender."
            ]
        ],
        ['label' => 'Platform', 'name' => 'platform_of_abuse', 'page' => 'Incident', 'group' => null, 'required' => true, 'type' => 'text'],

        // Perpetrator & Needs Page
        ['label' => 'Relationship with Perpetrator', 'name' => 'relationship_with_perpetrator', 'page' => 'Perpetrator', 'group' => null, 'required' => true, 'type' => 'text'],
        ['label' => 'Specific Survivor Needs', 'name' => 'specific_survivor_needs', 'page' => 'Perpetrator', 'group' => null, 'required' => true, 'type' => 'textarea'],
        ['label' => 'Reported to Police?', 'name' => 'report_to_police', 'page' => 'Perpetrator', 'group' => null, 'required' => true, 'type' => 'dropdown', 'options' => ['Yes', 'No']],
        ['label' => 'Recommend Counselling?', 'name' => 'recommend_counselling', 'page' => 'Perpetrator', 'group' => null, 'required' => true, 'type' => 'dropdown', 'options' => ['Yes', 'No']],
    ];

    public function mount()
    {
        foreach (collect($this->fieldList)->whereNotNull('group')->groupBy('group') as $group => $fields) {
            $this->activeGroupField[$group] = $fields->first()['name'];
        }
    }

    public function setGroupField($group, $fieldName)
    {
        $this->activeGroupField[$group] = $fieldName;
    }

    public function getPagesProperty()
    {
        return collect($this->fieldList)->pluck('page')->unique()->values();
    }

    public function getGroupsForCurrentPageProperty()
    {
        return collect($this->fieldList)
            ->where('page', $this->activePage)
            ->groupBy(fn($item) => $item['group'] ?? 'ungrouped');
    }

//    public function finish() { $this->showPreview = true; }
    public function navigateToPage($pageName)
    {
        // If they are trying to go forward, validate the current page first
        $allPages = $this->pages;
        $currentIndex = $allPages->search($this->activePage);
        $targetIndex = $allPages->search($pageName);

        if ($targetIndex > $currentIndex) {
            if ($this->validateCurrentPage()) {
                $this->activePage = $pageName;
            }
        } else {
            // Going backwards is always allowed without validation
            $this->activePage = $pageName;
        }
    }

    public function discard()
    {
        $this->formData = [];
        $this->showPreview = false;
        $this->activePage = 'Personal';
    }

    public function submitFinal()
    {
        $this->validate([
            'consent' => 'accepted',
            'casePassword' => 'required|min:4'
        ]);

        try {
            $caseNumber = 'REP-' . strtoupper(bin2hex(random_bytes(4)));

            // Prepare the array
            $dataToSave = [
                'case_number' => $caseNumber,
                'password'    => $this->casePassword,
                'fullname'    => $this->formData['fullname'] ?? 'Unknown',
                'gender'      => strtolower($this->formData['gender'] ?? 'other'),
                'survivor_age' => $this->formData['survivor_age'] ?? 'N/A',
                'age_range'    => $this->formData['age_range'] ?? 'N/A',
                'phone_number'  => $this->formData['phone_number'] ?? null,
                'email_address' => $this->formData['email_address'] ?? null,
                'tfgbv_type'        => $this->formData['tfgbv_type'] ?? 'N/A',
                'platform_of_abuse' => $this->formData['platform_of_abuse'] ?? 'N/A',
                'description'       => $this->formData['description'] ?? null,
                'relationship_with_perpetrator' => $this->formData['relationship_with_perpetrator'] ?? 'Unknown',
                'report_to_police'              => $this->formData['report_to_police'] ?? 'No',
                'recommend_counselling'         => $this->formData['recommend_counselling'] ?? 'No',
                'specific_survivor_needs' => $this->formData['specific_survivor_needs'] ?? 'None',
            ];

            // TROUBLESHOOTING STEP: This will stop everything and show you the data in the browser.
            // Once you are happy with the data, comment out the line below.
//            dd($dataToSave);

            Report::create($dataToSave);

            $this->showPreview = false;
            $this->formData = [];
            session()->flash('success', "Report submitted! Case Number: {$caseNumber}");

        } catch (\Exception $e) {
            session()->flash('error', "Database error: " . $e->getMessage());
        }
    }
    public function finish()
    {
        $rules = [];
        $attributes = [];

        foreach ($this->fieldList as $field) {
            if ($field['required']) {
                if ($field['group']) {
                    // GROUP LOGIC: Only require if ALL fields in that group are empty
                    $groupFields = collect($this->fieldList)->where('group', $field['group']);
                    $anyFilled = $groupFields->contains(fn($i) => !empty($this->formData[$i['name']] ?? null));

                    if (!$anyFilled) {
                        // If none are filled, mark the current active one as required to stop the form
                        $rules["formData.{$field['name']}"] = 'required';
                    }
                } else {
                    // REGULAR LOGIC
                    $rules["formData.{$field['name']}"] = 'required';
                }
            }
            $attributes["formData.{$field['name']}"] = $field['label'];
        }

        $this->validate($rules, ['required' => 'Please provide at least one :attribute.'], $attributes);
        $this->showPreview = true;
    }

    public function goToNext()
    {
        if ($this->validateCurrentPage()) {
            $currentIndex = $this->pages->search($this->activePage);
            if ($currentIndex < $this->pages->count() - 1) {
                $this->activePage = $this->pages[$currentIndex + 1];
            }
        }
    }

    protected function validateCurrentPage()
    {
        $currentPageFields = collect($this->fieldList)->where('page', $this->activePage);
        $rules = [];
        $attributes = [];

        foreach ($currentPageFields as $field) {
            $attributes["formData.{$field['name']}"] = $field['label'];

            if ($field['required']) {
                if ($field['group']) {
                    // Check if ANY field in this group has a value
                    $groupFields = $currentPageFields->where('group', $field['group']);
                    $anyFilled = $groupFields->contains(fn($i) => !empty($this->formData[$i['name']] ?? null));

                    // If none are filled, only require the one currently visible to the user
                    if (!$anyFilled && ($this->activeGroupField[$field['group']] ?? '') === $field['name']) {
                        $rules["formData.{$field['name']}"] = 'required';
                    }
                } else {
                    $rules["formData.{$field['name']}"] = 'required';
                }
            }
        }

        // FIX: If rules are empty, just return true so the user can navigate.
        if (empty($rules)) {
            return true;
        }

        // IMPORTANT: Pass $rules directly into the method to avoid the MissingRulesException
        return $this->validate($rules, [
            'formData.*.required' => 'This field (or an alternative in the group) is required.'
        ], $attributes);
    }

    public function goToPrevious()
    {
        $currentIndex = $this->pages->search($this->activePage);
        if ($currentIndex > 0) {
            $this->activePage = $this->pages[$currentIndex - 1];
        }
    }

    public function save()
    {
        // Simple validation example
        $rules = collect($this->fieldList)
            ->where('required', true)
            ->mapWithKeys(fn($f) => ["formData.{$f['name']}" => 'required'])
            ->toArray();

        $this->validate($rules);

        session()->flash('success', 'All data saved successfully!');
    }
}
?>

<div class="flex flex-col h-screen overflow-hidden">

    <!-- Child A: Header (takes its own height) -->
    <div class="shrink-0">
        @include('components/home/header')
    </div>
    <aside class="w-[30%] sm:w-full md:w-[350px] max-w-[350px] border-r border-alt-background flex flex-col shrink-0 shadow-xl h-full min-h-0 overflow-auto">
        <div class="text-center border-b py-3">
            {{--                <h2 class="text-xl font-black text-gray-800 tracking-tight">FORM WIZARD</h2>--}}
            <h3 class="font-semibold text-[1rem] mt-3 self-center">Report progress</h3>
        </div>

        <nav class="flex-1 overflow-y-auto p-4 space-y-6">
            @foreach($this->pages as $page)
                <div>
                    <button wire:click="navigateToPage('{{ $page }}')"
                            class="w-full text-left px-4 py-3 bg-alt-background rounded-xl font-bold transition-all {{ $activePage === $page ? 'bg-blue-600 text-white shadow-lg' : 'hover:bg-gray-100 text-gray-700' }}">
                        {{ $page }}
                    </button>

                    {{-- FIXED SIDEBAR LIST: Pulling all fields for this specific page --}}
                    <ul class="ml-6 mt-3 space-y-3 border-l-2 border-gray-100">
                        @php
                            $fieldsInThisPage = collect($this->fieldList)->where('page', $page);
                            $processedGroups = [];
                        @endphp

                        @foreach($fieldsInThisPage as $f)
                            <li class="pl-4 flex items-center justify-between group">
                                @if($f['group'])
                                    @if(!in_array($f['group'], $processedGroups))
                                        @php
                                            $groupItems = $fieldsInThisPage->where('group', $f['group']);
                                            $label = $groupItems->pluck('label')->implode('/');
                                            $processedGroups[] = $f['group'];

                                            // Satisfaction = At least one in group is filled
                                            $isSatisfied = $groupItems->contains(fn($i) => !empty($formData[$i['name']]));
                                        @endphp
                                        <span
                                            class="text-xs font-semibold {{ $isSatisfied ? 'text-green-600' : 'text-blue-500' }}">
                                    {{ $label }}
                                </span>
                                        <span>{!! $isSatisfied ? '<span class="text-green-500">✔</span>' : '<span class="text-red-500 font-bold">*</span>' !!}</span>
                                    @endif
                                @else
                                    {{-- Regular Fields (Full Name, Gender, etc) --}}
                                    @php $isFilled = !empty($formData[$f['name']]); @endphp
                                    <span
                                        class="text-xs {{ $isFilled ? 'text-green-600 font-bold' : 'text-gray-500' }}">
                                {{ $f['label'] }}
                            </span>
                                    <span>{!! $isFilled ? '<span class="text-green-500">✔</span>' : ($f['required'] ? '<span class="text-red-500 font-bold">*</span>' : '') !!}</span>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </nav>
    </aside>

    <main class="flex-1 overflow-y-auto min-h-0 bg-gray-100">
        <div class="max-w-2xl mx-auto">
            <h1 class="text-4xl font-extrabold text-gray-900 mb-10">{{ $activePage }}</h1>

            <div class="space-y-8">
                @foreach($this->groupsForCurrentPage as $groupName => $fields)
                    <div class="bg-white p-8 rounded-2xl shadow-sm border border-gray-200">
                        @if($groupName !== 'ungrouped')
                            <div class="flex justify-between items-center mb-6">
                                    <span
                                        class="text-xs font-black text-gray-400 uppercase tracking-widest">{{ $groupName }}</span>
                                <div class="flex bg-gray-100 p-1 rounded-lg">
                                    @foreach($fields as $tabField)
                                        <button
                                            wire:click="setGroupField('{{ $groupName }}', '{{ $tabField['name'] }}')"
                                            class="px-3 py-1 text-xs font-bold rounded-md transition {{ $activeGroupField[$groupName] === $tabField['name'] ? 'bg-white shadow-sm text-blue-600' : 'text-gray-500' }}">
                                            {{ $tabField['label'] }}
                                        </button>
                                    @endforeach
                                </div>
                            </div>
                            @php $activeField = $fields->where('name', $activeGroupField[$groupName])->first(); @endphp
                            @include('partials.input-logic', ['field' => $activeField])
                        @else
                            <div class="space-y-6">
                                @foreach($fields as $field)
                                    @include('partials.input-logic', ['field' => $field])
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            <footer class="mt-12 flex items-center justify-between pt-8 border-t border-gray-200">
                <button wire:click="goToPrevious"
                        @disabled($activePage === $this->pages->first())
                        class="font-bold text-gray-400 hover:text-gray-800 disabled:opacity-20 transition-colors">
                    &larr; Back
                </button>

                @if($activePage === $this->pages->last())
                    <button wire:click="finish"
                            class="px-10 py-4 bg-green-600 text-white rounded-2xl font-black shadow-xl hover:bg-green-700 transition active:scale-95">
                        FINISH & REVIEW
                    </button>
                @else
                    <button wire:click="goToNext"
                            class="px-10 py-4 bg- text-white rounded-2xl font-black shadow-xl hover:bg-blue-700 transition active:scale-95">
                        NEXT
                    </button>
                @endif
            </footer>
        </div>
    </main>

    @if($showPreview)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
            <div
                class="bg-background rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col shadow-2xl animate-in fade-in zoom-in duration-300">
                <div class="p-8 overflow-y-auto">
                    <h2 class="text-3xl font-black mb-6">Final Submission</h2>

                    <div class="bg-alt-background rounded-2xl p-6 border border-gray-100 mb-8">
                        <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">Data
                            Summary</h3>
                        <div class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-5 mb-8">
                            <div class="flex items-center gap-3 mb-2 text-amber-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                </svg>
                                <h4 class="font-black text-sm uppercase tracking-tight">Security & Liability
                                    Notice</h4>
                            </div>
                            <p class="text-xs text-amber-800 leading-relaxed font-medium">
                                By submitting this case, you acknowledge that you are <strong>solely
                                    responsible</strong> for preserving your <strong>Case Number</strong> and
                                <strong>Security Password</strong>. We do not store plain-text passwords. Loss of
                                these credentials will result in the permanent inability to access or decrypt this
                                information.
                            </p>
                        </div>
                        <div class="grid grid-cols-1 gap-3">
                            <h3 class="uppercase font-semibold text-[0.9rem]">preview</h3>
                            @foreach($fieldList as $field)
                                @if(!empty($formData[$field['name']]))
                                    <div
                                        class="flex justify-between text-sm py-2 border-b border-gray-100 last:border-0">
                                        <span class="text-gray-500">{{ $field['label'] }}</span>
                                        <span class="font-bold text-gray-900">{{ $formData[$field['name']] }}</span>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>

                    <div class="space-y-6">
                        <label
                            class="flex items-start gap-3 p-4 bg-blue-50 rounded-xl cursor-pointer border border-blue-100">
                            <input type="checkbox" wire:model.live="consent"
                                   class="mt-1 w-5 h-5 rounded text-blue-600">
                            <span class="text-sm text-blue-900 leading-tight">I hereby verify that the information provided is accurate and I give consent for processing.</span>
                        </label>

                        <div>
                            <label class="block text-xs font-black text-gray-400 uppercase mb-2">Security
                                Verification</label>
                            <input type="password" wire:model.blur="casePassword" min="5"
                                   placeholder="Set the case Password"
                                   class="w-full px-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-600 outline-none transition">
                            @error('casePassword') <p
                                class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </div>

                <div class="p-8 bg-gray-50 border-t flex flex-col gap-3">
                    <button wire:click="submitFinal"
                            wire:loading.attr="disabled"
                            @disabled(!$consent)
                            class="w-full py-4 bg-blue-600 text-white rounded-xl font-black shadow-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center justify-center gap-3">

                            <span wire:loading.remove wire:target="submitFinal">
                                CONFIRM SUBMISSION
                            </span>

                        <span wire:loading wire:target="submitFinal" class="flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                PROCESSING...
                            </span>
                    </button>
                    <div class="flex gap-3">
                        <button wire:click="$set('showPreview', false)"
                                class="flex-1 py-3 font-bold text-gray-500 hover:text-gray-800">Edit Data
                        </button>
                        <button wire:click="discard" class="flex-1 py-3 font-bold text-red-500 hover:text-red-700">
                            Discard All
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm font-bold rounded-r-lg">
            <p>There are missing required fields. Please check all pages before finishing.</p>
            <ul class="mt-2 list-disc list-inside font-medium text-xs">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
</div>
