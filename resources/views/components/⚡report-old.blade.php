<?php
namespace App\Livewire;

use App\Models\Report;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\Attributes\Url;

new class extends Component {
    #[Url]
    public $activePage = 'Personal information';

    public $formData = [];
    public $activeGroupField = [];
    public $showPreview = false; // Controls the popup
    public $consent = false;
    public $casePassword = '';
    public ?string $generatedCaseNumber = null;
    public bool $submissionComplete = false;

    public $fieldList = [
        // Personal Page
        ['label' => 'Full Name', 'name' => 'fullname', 'page' => 'Personal information', 'group' => null, 'required' => true, 'type' => 'text'],
        ['label' => 'Gender', 'name' => 'gender', 'page' => 'Personal information', 'group' => null, 'required' => true, 'type' => 'dropdown', 'options' => ['Male', 'Female', 'Prefer not to say']],
        ['label' => 'National ID number', 'name' => 'national_id', 'page' => 'Personal information', 'group' => 'Identification', 'required' => true, 'type' => 'number'],
        ['label' => 'Passport number', 'name' => 'passport_number', 'page' => 'Personal information', 'group' => 'Identification', 'required' => true, 'type' => 'number'],
        ['label' => "Age", 'name' => 'age_range', 'page' => 'Personal information', 'group' => null, 'required' => true, 'type' => 'dropdown', 'options' => ['Child (0-17)', 'Youth (18-35)', 'Adult (36-60)', 'Senior (60+)']],

        // Contact Page
        ['label' => 'Phone', 'name' => 'phone_number', 'page' => 'Personal information', 'group' => 'Contact', 'required' => true, 'type' => 'tel'],
        ['label' => 'Email', 'name' => 'email_address', 'page' => 'Personal information', 'group' => 'Contact', 'required' => true, 'type' => 'email'],
        ['label' => 'Guardian Phone Number', 'name' => 'guardian_phone_number', 'page' => 'Personal information', 'group' => 'Contact', 'required' => false, 'type' => 'tel', 'condition' => ['field' => 'age_range', 'value' => 'Child (0-17)']],

        ['label' => "Are you a person with disability?", 'name' => 'disability_status', 'page' => 'Personal information', 'group' => null, 'required' => true, 'type' => 'dropdown', 'options' => ['yes', 'no']],


        // Incident Details Page
        ['label' => 'Type of abuse', 'name' => 'tfgbv_type', 'page' => 'Incident', 'group' => null, 'required' => true, 'type' => 'dropdown',
            'options' => ['Hacking', 'Image-based abuse', 'Cyberstalking', 'Doxing', 'Online harassment'],
            'descriptions' => [
                "Hacking" => "Unauthorized access to private accounts to monitor, control, or impersonate a survivor.",
                "Image-based abuse" => "Non-consensual creation or distribution of intimate images or videos.",
                "Cyberstalking" => "Persistent monitoring or harassment using technology to create fear.",
                "Doxing" => "Publishing private personal info online to encourage harassment.",
                "Online harassment" => "Abusive messages or trolling based on gender."
            ]
        ],
        ['label' => 'Incident Description', 'name' => 'description', 'page' => 'Incident', 'group' => null, 'required' => false, 'type' => 'textarea'],
        ['label' => 'Platform where the abuse occurred', 'name' => 'platform_of_abuse', 'page' => 'Incident', 'group' => null, 'required' => true, 'type' => 'dropdown', 'options' => ['twitter', 'instagram', 'facebook', 'other']],
        ['label' => 'New platform name', 'name' => 'new_platform_name', 'page' => 'Incident', 'group' => null, 'required' => false, 'type' => 'text', 'condition' => ['field' => '', 'platform_of_abuse' => 'other']],


        //Evidence section
        ['label' => 'Evidence url', 'name' => 'evidence_link', 'page' => 'Evidence upload section', 'group' => 'Evidence', 'required' => false, 'type' => 'text'],
        ['label' => 'Upload screenshot', 'name' => 'evidence_upload', 'page' => 'Evidence upload section', 'group' => 'Upload', 'required' => false, 'type' => 'file'],

        // Perpetrator & Needs Page
        ['label' => 'Do you know the perpetrator?', 'name' => 'relationship_with_perpetrator', 'page' => 'Incident', 'group' => null, 'required' => false, 'type' => 'dropdown', 'options' => ['yes', 'no']],
        ['label' => 'How do you want to be assisted?', 'name' => 'assistance', 'page' => 'Case management', 'group' => null, 'required' => false, 'type' => 'checkbox', 'options' => ['Report to police', 'Recommend counselling services']],
//        ['label' => 'Consent', 'name' => 'consent', 'page' => 'Case management', 'group' => null, 'required' => true, 'type' => 'checkbox', 'options' => ['I consent to being contacted for follow up', 'I consent to my information being used for investigation purposes']],

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

    private function generateCaseNumber($type)
    {
        $yearSuffix = now()->format('y'); // e.g. '25'
        $prefix = strtolower(substr(preg_replace('/\s+/', '', $type), 0, 3));

        do {
            // Generate 2 random uppercase letters
            $letters = strtoupper(Str::random(2));
            $letters = preg_replace('/[^A-Z]/', 'A', $letters); // ensure letters only

            // Generate 3 random digits
            $digits = str_pad(random_int(0, 9999), 4, '0', STR_PAD_LEFT);

            // Combine to form case number
            $caseNumber = strtolower($prefix) . '-' . $yearSuffix . '-' . $letters . $digits;

            // Check for uniqueness in DB
            $exists = Report::where('case_number', $caseNumber)->exists();

        } while ($exists);
        return $caseNumber;
    }

    public function submitFinal()
    {
        $this->validate([
            'consent' => 'accepted',
            'casePassword' => 'required|min:4'
        ]);

        try {
            $caseNumber = $this->generateCaseNumber($this->formData['tfgbv_type']);

//            $caseNumber = 'REP-' . strtoupper(bin2hex(random_bytes(4)));

            // Prepare the array
            $dataToSave = [
                'case_number' => $caseNumber,
                'password' => $this->casePassword,
                'fullname' => $this->formData['fullname'] ?? 'Unknown',
                'gender' => strtolower($this->formData['gender'] ?? 'other'),
                        //old_lacking
                'national_id' => $this->formData['national_id'] ?? 'N/A',
                'passport_number' => $this->formData['passport_number'] ?? 'N/A',
                'age_range' => $this->formData['age_range'] ?? 'N/A',
                'phone_number' => $this->formData['phone_number'] ?? null,

                //new
                'guardian_phone_number' => $this->formData['guardian_phone_number'] ?? null,
                'new_platform_name' => $this->formData['new_platform_name'] ?? null,
                'evidence_url' => $this->formData['evidence_url'] ?? null,
                'evidence_of_abuse' => $this->formData['evidence_of_abuse'] ?? null,

                'email_address' => $this->formData['email_address'] ?? null,
                'tfgbv_type' => $this->formData['tfgbv_type'] ?? 'N/A',
                'platform_of_abuse' => $this->formData['platform_of_abuse'] ?? 'N/A',
                'description' => $this->formData['description'] ?? null,
                'relationship_with_perpetrator' => $this->formData['relationship_with_perpetrator'] ?? 'Unknown',
                'report_to_police' => $this->formData['report_to_police'] ?? 'No',
                'recommend_counselling' => $this->formData['recommend_counselling'] ?? 'No',
                'disability_status' => $this->formData['disability_status'] ?? 'None',
            ];

            // TROUBLESHOOTING STEP: This will stop everything and show you the data in the browser.
            // Once you are happy with the data, comment out the line below.
//            dd($dataToSave);

            Report::create($dataToSave);
            $this->submissionComplete = true;

//            $this->showPreview = false;
            $this->formData = [];
            $this->generatedCaseNumber = $caseNumber;
            $this->activePage = $this->pages->first();
            session()->flash('success', "Report submitted! Case Number: {$caseNumber}");

        } catch (\Exception $e) {
            session()->flash('error', "Database error: " . $e->getMessage());
        }
    }
    public function resetForm()
    {
        // Reset all form inputs
        $this->formData = [];

        // Reset preview and submission states
        $this->showPreview = false;
        $this->submissionComplete = false;

        // Reset generated case number
        $this->generatedCaseNumber = null;

        // Reset active page to the first page
        $this->activePage = $this->pages->first();

        // Reset consent checkbox and case password
        $this->consent = false;
        $this->casePassword = '';

        // Optional: flash message or toast to notify user
        session()->flash('success', 'Form has been reset. You can submit a new case.');
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

<div class="flex flex-col md:h-screen md:overflow-hidden sm:overflow-hidden overflow-auto sm:m-0 -mt-[62px]">

    <!-- Child A: Header (takes its own height) -->
    <div class="shrink-0">
        @include('components/home/header')
    </div>

    <div class="flex flex-col-reverse md:flex-row flex-1 overflow-y-auto">
        <!-- Sidebar: Full width on mobile/tablet, Fixed width on desktop (md/lg) -->
        <div class="w-full sm:max-w-[350px] max-w-full p-4 min-h-0 overflow-y-auto border-r border-alt-background flex flex-col shrink-0">
            <h3 class="font-semibold text-[1rem] mt-3 self-center">Report progress</h3>
            <hr>
            <div class="flex flex-col w-full" id="report-menu">
                @foreach($this->pages as $page)
                    <div class="flex flex-col my-4">
                        <button wire:click="navigateToPage('{{ $page }}')"
                                class="w-full text-left px-4 py-3 rounded-xl bg-alt-background font-bold transition-all {{ $activePage === $page ? 'bg-blue-600 text-white shadow-lg' : 'hover:bg-gray-100 text-gray-700' }}">
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
                                                class="text-sm {{ $isSatisfied ? 'text-green-600' : 'text-foreground' }}">
                                                {{ $label }}
                                            </span>
                                            <span>{!! $isSatisfied ? '<span class="text-green-500">✔</span>' : '<span class="text-red-500 font-bold">*</span>' !!}</span>
                                        @endif
                                    @else
                                        {{-- Regular Fields (Full Name, Gender, etc) --}}
                                        @php $isFilled = !empty($formData[$f['name']]); @endphp
                                        <span
                                            class="text-sm {{ $isFilled ? 'text-green-600 font-bold' : 'text-foregound' }}">
                                            {{ $f['label'] }}
                                        </span>
                                        <span>{!! $isFilled ? '<span class="text-green-500">✔</span>' : ($f['required'] ? '<span class="text-red-500 font-bold">*</span>' : '') !!}</span>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
        <main class="flex-1 overflow-y-auto sm:h-auto min-h-0 bg-background">
            <div class="sm:p-8 p-2">
                <div class="flex flex-col w-full h-full overflow-y-auto min-h-0">
                    <a href="{{route('home')}}" class="flex flex-row gap-3 pb-8">
                        <x-sui-wrap-back class="h-5 w-5"/>
                        <span>Return to home</span>
                    </a>

                    <div class="flex-1 overflow-y-auto">
                        <h5 class="ml-4 font-semibold text-[1.2rem] w-full">Technology Facilitated Gender Based
                            Violence(TFGBV)
                        </h5>
                        <div class="sm:px-8 px-4 w-full">
                            <img src="{{asset('/images/features-3.webp')}}"
                                 class="rounded-t-xl w-full h-auto max-h-[80px] object-cover"
                                 alt="Reporting property image">
                        </div>
                        <div class="sm:mx-8 mx:4 px-4 flex flex-col border border-t-0 border-alt-background">

                            <h5 class="text-primary text-[1.4rem]">Online Reporting form</h5>

                            <div class="pl-8 py-4 flex flex-col gap-4">
                                <div class="doc-icon flex flex-row gap-3">
                                    <x-tni-doc class="w-5 h-5 text-blue-500"/>
                                    <div class="font-semibold text-secondary">Terms and conditions</div>
                                </div>
                                <div class="check flex flex-row gap-3">
                                    <x-gmdi-check-circle-o class="w-5 h-5"/>
                                    <div class="font-semibold text-extreme-foreground">Accepted</div>
                                </div>

                            </div>
                            <main class="flex-1 sm:p-4 p-0 overflow-y-auto">
                                <div class="sm:max-w-2xl w-full sm:mx-auto mx-0 flex flex-col gap-4">
                                    {{--                                    <h1 class="text-4xl font-extrabold text-gray-900 mb-10">{{ $activePage }}</h1>--}}

                                    <div class="space-y-8">
                                        @foreach($this->groupsForCurrentPage as $groupName => $fields)
                                            <div class="bg-white sm:p-8 p-2 rounded-2xl shadow-sm border border-gray-200">
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

                                    @if ($errors->any())
                                        <div
                                            class="mb-4 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 text-sm font-bold rounded-r-lg">
                                            <p>There are missing required fields. Please check all pages before
                                                finishing.</p>
                                            <ul class="mt-2 list-disc list-inside font-medium text-xs">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <footer
                                        class="mt-12 flex items-center justify-between pt-8 border-t border-gray-200">
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
                                                    class="px-10 py-4 bg-blue-600 text-white rounded-2xl font-black shadow-xl hover:bg-blue-700 transition active:scale-95">
                                                NEXT
                                            </button>
                                        @endif
                                    </footer>
                                </div>
                            </main>

{{--                            @if($showPreview)--}}
{{--                                <div--}}
{{--                                    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">--}}
{{--                                    <div--}}
{{--                                        class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col shadow-2xl animate-in fade-in zoom-in duration-300">--}}
{{--                                        <div class="p-8 overflow-y-auto">--}}
{{--                                            <h2 class="text-3xl font-black mb-6">Final Submission</h2>--}}

{{--                                            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 mb-8">--}}
{{--                                                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">--}}
{{--                                                    Data--}}
{{--                                                    Summary</h3>--}}
{{--                                                <div class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-5 mb-8">--}}
{{--                                                    <div class="flex items-center gap-3 mb-2 text-amber-700">--}}
{{--                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"--}}
{{--                                                             fill="none"--}}
{{--                                                             viewBox="0 0 24 24" stroke="currentColor">--}}
{{--                                                            <path stroke-linecap="round" stroke-linejoin="round"--}}
{{--                                                                  stroke-width="2"--}}
{{--                                                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>--}}
{{--                                                        </svg>--}}
{{--                                                        <h4 class="font-black text-sm uppercase tracking-tight">Security--}}
{{--                                                            & Liability--}}
{{--                                                            Notice</h4>--}}
{{--                                                    </div>--}}
{{--                                                    <p class="text-xs text-amber-800 leading-relaxed font-medium">--}}
{{--                                                        By submitting this case, you acknowledge that you are <strong>solely--}}
{{--                                                            responsible</strong> for preserving your <strong>Case--}}
{{--                                                            Number</strong> and--}}
{{--                                                        <strong>Security Password</strong>. We do not store plain-text--}}
{{--                                                        passwords. Loss of--}}
{{--                                                        these credentials will result in the permanent inability to--}}
{{--                                                        access or decrypt this--}}
{{--                                                        information.--}}
{{--                                                    </p>--}}
{{--                                                </div>--}}
{{--                                                <div class="grid grid-cols-1 gap-3">--}}
{{--                                                    <h3 class="uppercase font-semibold text-[0.9rem]">preview</h3>--}}
{{--                                                    @foreach($fieldList as $field)--}}
{{--                                                        @if(!empty($formData[$field['name']]))--}}
{{--                                                            <div--}}
{{--                                                                class="flex justify-between text-sm py-2 border-b border-gray-100 last:border-0">--}}
{{--                                                                <span class="text-gray-500">{{ $field['label'] }}</span>--}}
{{--                                                                <span--}}
{{--                                                                    class="font-bold text-gray-900">{{ $formData[$field['name']] }}</span>--}}
{{--                                                            </div>--}}
{{--                                                        @endif--}}
{{--                                                    @endforeach--}}
{{--                                                </div>--}}
{{--                                            </div>--}}

{{--                                            <div class="space-y-6">--}}
{{--                                                <label--}}
{{--                                                    class="flex items-start gap-3 p-4 bg-blue-50 rounded-xl cursor-pointer border border-blue-100">--}}
{{--                                                    <input type="checkbox" wire:model.live="consent"--}}
{{--                                                           class="mt-1 w-5 h-5 rounded text-blue-600">--}}
{{--                                                    <span class="text-sm text-blue-900 leading-tight">I hereby verify that the information provided is accurate and I give consent for processing.</span>--}}
{{--                                                </label>--}}

{{--                                                <div>--}}
{{--                                                    <label--}}
{{--                                                        class="block text-xs font-black text-gray-400 uppercase mb-2">Security--}}
{{--                                                        Verification</label>--}}
{{--                                                    <input type="password" wire:model.blur="casePassword" min="5"--}}
{{--                                                           placeholder="Set the case Password"--}}
{{--                                                           class="w-full px-4 py-4 bg-gray-50 border-2 border-gray-200 rounded-xl focus:border-blue-600 outline-none transition">--}}
{{--                                                    @error('casePassword') <p--}}
{{--                                                        class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p> @enderror--}}
{{--                                                </div>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}

{{--                                        <div class="p-8 bg-gray-50 border-t flex flex-col gap-3">--}}
{{--                                            <button wire:click="submitFinal"--}}
{{--                                                    wire:loading.attr="disabled"--}}
{{--                                                    @disabled(!$consent)--}}
{{--                                                    class="w-full py-4 bg-blue-600 text-white rounded-xl font-black shadow-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center justify-center gap-3">--}}

{{--                                                <span wire:loading.remove wire:target="submitFinal">--}}
{{--                                                    CONFIRM SUBMISSION--}}
{{--                                                </span>--}}

{{--                                                <span wire:loading wire:target="submitFinal"--}}
{{--                                                      class="flex items-center gap-2">--}}
{{--                                                    <svg class="animate-spin h-5 w-5 text-white"--}}
{{--                                                         xmlns="http://www.w3.org/2000/svg" fill="none"--}}
{{--                                                         viewBox="0 0 24 24">--}}
{{--                                                        <circle class="opacity-25" cx="12" cy="12" r="10"--}}
{{--                                                                stroke="currentColor" stroke-width="4"></circle>--}}
{{--                                                        <path class="opacity-75" fill="currentColor"--}}
{{--                                                              d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>--}}
{{--                                                    </svg>--}}
{{--                                                    PROCESSING...--}}
{{--                                                </span>--}}
{{--                                            </button>--}}
{{--                                            <div class="flex gap-3">--}}
{{--                                                <button wire:click="$set('showPreview', false)"--}}
{{--                                                        class="flex-1 py-3 font-bold text-gray-500 hover:text-gray-800">--}}
{{--                                                    Edit Data--}}
{{--                                                </button>--}}
{{--                                                <button wire:click="discard"--}}
{{--                                                        class="flex-1 py-3 font-bold text-red-500 hover:text-red-700">--}}
{{--                                                    Discard All--}}
{{--                                                </button>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            @endif--}}
                            @if($showPreview)
                                <div
                                    class="fixed inset-0 bg-black/60 backdrop-blur-sm z-50 flex items-center justify-center p-4">
                                    <div
                                        class="bg-white rounded-3xl max-w-2xl w-full max-h-[90vh] overflow-hidden flex flex-col shadow-2xl animate-in fade-in zoom-in duration-300">

                                        {{-- ========================= --}}
                                        {{-- PREVIEW CONTENT (summary & details) --}}
                                        {{-- ========================= --}}
                                        <div class="p-8 overflow-y-auto">
                                            <h2 class="text-3xl font-black mb-6">Final Submission</h2>

                                            <div class="bg-gray-50 rounded-2xl p-6 border border-gray-100 mb-8">
                                                <h3 class="text-xs font-black text-gray-400 uppercase tracking-widest mb-4">
                                                    Data Summary
                                                </h3>
                                                <div class="bg-amber-50 border-2 border-amber-200 rounded-2xl p-5 mb-8">
                                                    <div class="flex items-center gap-3 mb-2 text-amber-700">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6"
                                                             fill="none"
                                                             viewBox="0 0 24 24" stroke="currentColor">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                                                        </svg>
                                                        <h4 class="font-black text-sm uppercase tracking-tight">Security & Liability Notice</h4>
                                                    </div>
                                                    <p class="text-xs text-amber-800 leading-relaxed font-medium">
                                                        By submitting this case, you acknowledge that you are <strong>solely responsible</strong> for preserving your <strong>Case Number</strong> and <strong>Security Password</strong>. We do not store plain-text passwords. Loss of these credentials will result in the permanent inability to access or decrypt this information.
                                                    </p>
                                                </div>

                                                {{-- Preview Fields --}}
                                                <div class="grid grid-cols-1 gap-3">
                                                    <h3 class="uppercase font-semibold text-[0.9rem]">Preview</h3>
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
                                        </div>

                                        {{-- ========================= --}}
                                        {{-- ACTION / CASE NUMBER SECTION --}}
                                        {{-- ========================= --}}
                                        <div class="p-8 bg-gray-50 border-t flex flex-col gap-6">
                                            @if(!$submissionComplete)
                                                {{-- Consent Checkbox --}}
                                                <label class="flex items-start gap-3 p-4 bg-blue-50 rounded-xl cursor-pointer border border-blue-100">
                                                    <input type="checkbox"
                                                           wire:model.live="consent"
                                                           class="mt-1 w-5 h-5 rounded text-blue-600">
                                                    <span class="text-sm text-blue-900 leading-tight">
                            I hereby verify that the information provided is accurate and I give consent for processing.
                        </span>
                                                </label>

                                                {{-- Password --}}
                                                <div>
                                                    <label class="block text-xs font-black text-gray-400 uppercase mb-2">Security Verification</label>
                                                    <input type="password"
                                                           wire:model.blur="casePassword"
                                                           placeholder="Set the case password"
                                                           class="w-full px-4 py-4 bg-white border-2 border-gray-200 rounded-xl focus:border-blue-600 outline-none transition">
                                                    @error('casePassword')
                                                    <p class="text-red-500 text-xs mt-1 font-bold">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                {{-- Confirm Button --}}
                                                <button wire:click="submitFinal"
                                                        wire:loading.attr="disabled"
                                                        @disabled(!$consent)
                                                        class="w-full py-4 bg-blue-600 text-white rounded-xl font-black shadow-lg hover:bg-blue-700 disabled:opacity-50 disabled:cursor-not-allowed transition flex items-center justify-center gap-3">
                                                    <span wire:loading.remove wire:target="submitFinal">CONFIRM SUBMISSION</span>
                                                    <span wire:loading wire:target="submitFinal">PROCESSING...</span>
                                                </button>

                                                {{-- Edit / Discard --}}
                                                <div class="flex gap-3">
                                                    <button wire:click="$set('showPreview', false)"
                                                            class="flex-1 py-3 font-bold text-gray-500 hover:text-gray-800">
                                                        Edit Data
                                                    </button>
                                                    <button wire:click="discard"
                                                            class="flex-1 py-3 font-bold text-red-500 hover:text-red-700">
                                                        Discard All
                                                    </button>
                                                </div>
                                            @else
                                                {{-- SUCCESS VIEW --}}
                                                <div class="text-center py-6">
                                                    <div class="w-16 h-16 mx-auto mb-4 flex items-center justify-center bg-green-100 rounded-full">
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             class="h-8 w-8 text-green-600"
                                                             fill="none"
                                                             viewBox="0 0 24 24"
                                                             stroke="currentColor">
                                                            <path stroke-linecap="round"
                                                                  stroke-linejoin="round"
                                                                  stroke-width="2"
                                                                  d="M5 13l4 4L19 7" />
                                                        </svg>
                                                    </div>

                                                    <h3 class="text-xl font-black text-green-700 mb-3">Submission Successful</h3>
                                                    <p class="text-sm text-gray-600 mb-4">Your report has been submitted successfully.</p>

                                                    <div class="bg-white border border-green-300 rounded-xl p-5 mb-4">
                                                        <p class="text-xs text-gray-500 uppercase mb-1">Case Number</p>
                                                        <p class="text-xl font-black text-green-700 tracking-widest">{{ $generatedCaseNumber }}</p>
                                                    </div>

                                                    <p class="text-xs text-gray-600 mb-6">
                                                        Please save this case number and your password securely.
                                                    </p>

                                                    <button wire:click="resetForm"
                                                            class="px-6 py-3 bg-blue-600 text-white rounded-xl font-bold hover:bg-blue-700 transition">
                                                        Submit Another Case
                                                    </button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </main>

    </div>
</div>
