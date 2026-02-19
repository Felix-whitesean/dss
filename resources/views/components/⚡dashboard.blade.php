<?php

use Livewire\Attributes\Computed;
use Livewire\Attributes\Url;
use Livewire\Component;
use App\Models\Menu;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    // Use #[Url] to keep search/sort in the browser URL for bookmarking
    #[Url]
//    public $search = '';
    public $sortField = 'created_at';
    public $sortDirection = 'desc';
    public $dashboardType;
    public $activeItem;

    public function mount($dashboardType)
    {
        $this->dashboardType = $dashboardType;
        $this->activeItem = ($dashboardType == 'admin' ? 'statistics' : 'home');
    }

    public $name;
    public $version;


    #[Computed]
    public function menuItems()
    {
        return Menu::query()
            ->where('item_owner', 1)
//            ->when($this->search, fn($q) => $q->where('name', 'like', "%{$this->search}%"))
            ->orderBy($this->sortField, $this->sortDirection)->get();
    }

    public function setActive($item)
    {
        $this->activeItem = $item;
    }
}; ?>

<div class="h-full overflow-hidden flex flex-col w-full bg-extreme-background relative">
    <div class="h-[65px] w-full bg-logo-bg">
        <img src="{{asset('images/logo_full.png')}}" class="h-full " alt="State Department of Gender LOGO">
    </div>
    <div class="flex flex-row flex-1 h-full w-full min-h-0 relative">
        <div class="h-full flex flex-col w-[335px] border-r-2 border-r-median z-[111] shadow-[0px_4px_4px_1px] shadow-[#00000044]">
            <div class="w-full text-center border-b-2 border-dashed px-2 py-4 border-b-alt-background uppercase font-semibold text-">{{$dashboardType ?? 'Agent'}} Dashboard</div>
            <div class="h-full w-full flex-1 overflow-auto nav pt-3">
                <nav class="flex flex-col px-4">
                    {{-- Access computed property via $this->menuItems --}}
                    @foreach($this->menuItems as $item)
                        @php
                            // Clean the string: remove <x- and /> and space
                            $iconSlug = str($item->icon)->replace(['<x-', '/>', ' '], '')->trim();
                        @endphp
                        <button
                                wire:click="setActive('{{ $item->name}}')"
                            @class([
                                'relative px-2 transition items-center',
                                'bg-alt-background text-secondary hover:text-foreground' => $activeItem == $item->name,
                                ' text-median hover:text-foreground' => $activeItem != $item->name,
                            ])>
                            <i  class="h-6 w-6">
                                <x-dynamic-component :component="Str::after($item->icon, 'x-')" class="w-5 h-5" />
                            </i>
                            <div class="py-3 w-[1px] h-[70%] bg-gray-400"></div>
                            <span>{{ $item->name }}</span>
                        </button>

                    @endforeach
                </nav>
            </div>
            <div class="w-full h-[100px] py-4 bg-alt-background z-[1111] shadow-[-2px_0_4px_2px] flex flex-row gap-0 px-3">
                <x-gmdi-account-circle-r class="text-green-800 h-12 w-12"/>
                <div class="user-details flex-col">
                    <div class="username text-[1.2rem]">John Doe</div>
                    <div class="email text-[1rem] text-median">johndoe@gmail.com</div>
                </div>
            </div>
        </div>

        <div class="h-full flex-1">
            <div class="py-4 border-1 border-alt-background pl-3">Secondary navbar</div>
            <div class="h-full overflow-y-auto">
                <div class="h-[1000px]">
                    @if($activeItem === 'statistics')
                        @includeFirst([
                            'layouts.' . $dashboardType . '.home',
                            'layouts.agent.home'
                        ])
                    @elseif($activeItem === 'none')
                        <div>No item selected</div>
                    @else
                        <div class="">Active item ({{$activeItem}} view not found)</div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
