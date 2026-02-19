{{--<div class="flex flex-col h-screen overflow-hidden">--}}

{{--    <!-- Child A: Header (takes its own height) -->--}}
{{--    <div class="shrink-0">--}}
{{--        @include('components/home/header')--}}
{{--    </div>--}}

{{--    <!-- Child B: Content Wrapper (Grows to fill the rest of the screen) -->--}}
{{--    <!-- overflow-hidden here is MANDATORY to contain the scroll -->--}}
{{--    <div class="flex flex-1 overflow-hidden sm:flex-col-reverse md:flex-row">--}}

{{--        <!-- Sidebar -->--}}
{{--        <div class="w-[10%] sm:w-full md:w-[350px] max-w-[350px] border-r border-alt-background flex flex-col shrink-0">--}}
{{--            <h3 class="font-semibold text-[1rem] mt-3 self-center">Report progress</h3>--}}
{{--            <div class="flex flex-col w-full" id="report-menu">--}}
{{--                <div class="item pb-6">--}}
{{--                    <button class="flex flex-row w-full justify-between">--}}
{{--                        <div class="text-secondary">Step 1</div>--}}
{{--                        <div class="toggle"><x-gmdi-chevron-right-r class="icon text-green-800 h-8 w-8"/></div>--}}
{{--                    </button>--}}
{{--                    <hr class="text-alt-background">--}}
{{--                    <div class="fields hidden">--}}
{{--                        <ol class="list-decimal">--}}
{{--                            <li>Primary identifier</li>--}}
{{--                            <li>Primary contact</li>--}}
{{--                        </ol>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="item">--}}
{{--                    <button class="flex flex-row w-full justify-between">--}}
{{--                        <div>Step 2</div>--}}
{{--                        <div class="toggle"><x-gmdi-chevron-right-r class="icon text-green-800 h-8 w-8"/></div>--}}
{{--                    </button>--}}
{{--                    <div class="fields hidden">--}}
{{--                        <ol class="list-decimal">--}}
{{--                            <li>Platform</li>--}}
{{--                            <li>Type of abuse</li>--}}
{{--                        </ol>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--        <main class="flex-1 overflow-y-auto min-h-0 bg-gray-100">--}}
{{--            <div class="p-8">--}}
{{--                <div class="flex flex-col w-full h-full overflow-auto min-h-0">--}}
{{--                    <a href="{{route('home')}}" class="flex flex-row gap-3 pb-8">--}}
{{--                        <x-sui-wrap-back class="h-5 w-5"/>--}}
{{--                        <span>Return to home</span>--}}
{{--                    </a>--}}

{{--                    <div class="flex-1 overflow-y-auto">--}}
{{--                        <div class="px-8 w-full">--}}
{{--                            <img src="{{asset('/images/features-3.webp')}}" class="rounded-t-xl w-full h-auto max-h-[180px] object-cover" alt="Reporting property image">--}}
{{--                        </div>--}}
{{--                        <div class="px-8 flex flex-col">--}}
{{--                            <h5 class="font-semibold text-[1.8rem] max-w-[500px]">Technology Facilitated Gender Based Violence(TFGBV)</h5>--}}
{{--                            <div class="pl-8 py-4 flex flex-col gap-4">--}}
{{--                                <div class="doc-icon flex flex-row gap-3">--}}
{{--                                    <x-tni-doc class="w-5 h-5 text-blue-500"/>--}}
{{--                                    <div class="font-semibold text-secondary">Terms and conditions</div>--}}
{{--                                </div>--}}
{{--                                <div class="check flex flex-row gap-3">--}}
{{--                                    <x-gmdi-check-circle-o class="w-5 h-5"/>--}}
{{--                                    <div class="font-semibold text-extreme-foreground">Accepted</div>--}}
{{--                                </div>--}}

{{--                            </div>--}}
{{--                            <div class="form">--}}
{{--                                <form action="">--}}
{{--                                    <div id="container" class="container"></div>--}}
{{--                                    <div class="buttons w-full flex flex-row">--}}
{{--                                        <button class="bg-alt-background capitalize">previous</button>--}}
{{--                                        <button class="bg-secondary capitalize">next</button>--}}
{{--                                    </div>--}}
{{--                                </form>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </main>--}}

{{--    </div>--}}
{{--</div>--}}


{{--<script>--}}
{{--        const reportMenu = document.getElementById('report-menu');--}}
{{--        const menuItems = reportMenu.querySelectorAll('.item');--}}
{{--        const reportFields = [--}}
{{--            {--}}
{{--                id: 1,--}}
{{--                name: "name",--}}
{{--                label: "Full name",--}}
{{--                required: false,--}}
{{--                type: "text",--}}
{{--                step: null--}}
{{--            },--}}
{{--            {--}}
{{--                id: 2,--}}
{{--                name: "phone",--}}
{{--                label: "Phone number",--}}
{{--                required: true,--}}
{{--                type: "tel",--}}
{{--                group: "contact",--}}
{{--                step: null--}}
{{--            },--}}
{{--            {--}}
{{--                id: 3,--}}
{{--                name: "user_email",--}}
{{--                label: "Email Address",--}}
{{--                required: true,--}}
{{--                type: "email",--}}
{{--                group: "contact",--}}
{{--                step: null--}}
{{--            },--}}
{{--            {--}}
{{--                id: 4,--}}
{{--                name: "national_id",--}}
{{--                label: "National ID number",--}}
{{--                required: true,--}}
{{--                type: "text",--}}
{{--                group: "identifier",--}}
{{--                step: null--}}
{{--            },--}}
{{--            {--}}
{{--                id: 5,--}}
{{--                name: "passport",--}}
{{--                label: "Passport number",--}}
{{--                required: true,--}}
{{--                type: "text",--}}
{{--                group: "identifier",--}}
{{--                step: null--}}
{{--            },--}}
{{--            {--}}
{{--                id: 6,--}}
{{--                name: "age",--}}
{{--                label: "Age range",--}}
{{--                required: true,--}}
{{--                type: "text",--}}
{{--                step: 1--}}
{{--            },--}}
{{--            {--}}
{{--                id: 7,--}}
{{--                name: "gender",--}}
{{--                label: "Gender",--}}
{{--                required: true,--}}
{{--                type: "text",--}}
{{--                options: "male,female,intersex",--}}
{{--                step: null--}}
{{--            },--}}
{{--        ];--}}

{{--        menuItems.forEach(item => {--}}
{{--            const btn = item.querySelector('button');--}}
{{--            const field = item.querySelector('.fields');--}}
{{--            const icon = item.querySelector('.icon'); // Select icon here--}}

{{--            if (btn) {--}}
{{--                const toggleBtn = btn.querySelector('.toggle');--}}

{{--                toggleBtn.addEventListener('click', () => {--}}
{{--                    field.classList.toggle('hidden');--}}

{{--                    if (icon) {--}}
{{--                        icon.classList.toggle('rotate-90'); // Use Tailwind's 'rotate-90'--}}
{{--                    }--}}

{{--                    console.log('Toggled:', item.querySelector('div').textContent.trim());--}}
{{--                });--}}
{{--            }--}}
{{--        });--}}
{{--        document.querySelector('.container')--}}
{{--        const formContainer = document.getElementById('container');--}}

{{--        // 1. Group the fields (Defaults to 'standalone' if group is missing)--}}
{{--        const groupedFields = Object.groupBy(reportFields, ({ group }) => group ?? 'standalone');--}}

{{--        // 2. Helper to create the actual Input + Label HTML--}}
{{--        function createFieldElement(field) {--}}
{{--            const wrapper = document.createElement('div');--}}
{{--            wrapper.className = 'field-group';--}}

{{--            const label = document.createElement('label');--}}
{{--            label.innerText = field.label + ":";--}}
{{--            label.setAttribute('for', field.name);--}}

{{--            if (field.required) {--}}
{{--                const indicator = document.createElement('span');--}}
{{--                indicator.innerText = " *";--}}
{{--                indicator.style.color = "red";--}}
{{--                label.appendChild(indicator);--}}
{{--            }--}}

{{--            const input = document.createElement('input');--}}
{{--            input.id = field.name;--}}
{{--            input.name = field.name;--}}
{{--            input.type = field.type;--}}
{{--            input.required = field.required;--}}
{{--            if (field.step) input.step = field.step;--}}

{{--            wrapper.appendChild(label);--}}
{{--            wrapper.appendChild(input);--}}
{{--            return wrapper;--}}
{{--        }--}}

{{--        // 3. Render Logic--}}
{{--        Object.keys(groupedFields).forEach(groupName => {--}}
{{--            const fields = groupedFields[groupName];--}}
{{--            const isStandalone = (groupName === 'standalone');--}}

{{--            // Every section (standalone or grouped) gets this container for visual similarity--}}
{{--            const section = document.createElement('section');--}}
{{--            section.className = 'group-container';--}}

{{--            // The display area where inputs actually sit--}}
{{--            const displayArea = document.createElement('div');--}}
{{--            displayArea.className = 'group-input-display';--}}

{{--            if (!isStandalone) {--}}
{{--                // ONLY Grouped: Add Title--}}
{{--                const title = document.createElement('h3');--}}
{{--                title.innerText = groupName.charAt(0).toUpperCase() + groupName.slice(1);--}}
{{--                section.appendChild(title);--}}

{{--                // ONLY Grouped: Add Navigation Switcher--}}
{{--                const nav = document.createElement('div');--}}
{{--                nav.className = 'field-switcher';--}}

{{--                fields.forEach((field, index) => {--}}
{{--                    const btn = document.createElement('button');--}}
{{--                    btn.innerText = field.label;--}}
{{--                    btn.type = "button";--}}
{{--                    btn.onclick = () => {--}}
{{--                        nav.querySelectorAll('button').forEach(b => b.classList.remove('active'));--}}
{{--                        btn.classList.add('active');--}}
{{--                        displayArea.innerHTML = '';--}}
{{--                        displayArea.appendChild(createFieldElement(field));--}}
{{--                    };--}}
{{--                    nav.appendChild(btn);--}}
{{--                    if (index === 0) btn.click();--}}
{{--                });--}}
{{--                section.appendChild(nav);--}}
{{--            } else {--}}
{{--                // Standalone: Simply render all fields inside the display area--}}
{{--                fields.forEach(field => {--}}
{{--                    displayArea.appendChild(createFieldElement(field));--}}
{{--                });--}}
{{--            }--}}

{{--            section.appendChild(displayArea);--}}
{{--            formContainer.appendChild(section);--}}
{{--        });--}}
{{--    </script>--}}

@livewire('report-old')
