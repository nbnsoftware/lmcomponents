<div wire:key="{{now()->timestamp}}" x-data="{activeTab:$persist(0)}" class="tabs flex flex-col">
    <div class="is-scrollbar-hidden overflow-x-auto">
        <div class="border-b-2 border-slate-150 dark:border-navy-500">
            <div class="tabs-list flex">
            @for($i=0;$i<100;$i++)
                @if (!(${'slot_'.$i} ?? false))
                    @break
                @endif
                <button
                    @click="activeTab = {{$i}}"
                    :class="activeTab == {{$i}} ? 'border-primary  text-primary dark:text-accent-light' : 'border-transparent hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100'"
                    class="btn shrink-0 rounded-none border-b-2 px-3 py-2 font-medium"
                >
                    {{${'slot_'.$i}->attributes['label'] ?? 'Tab '.($i)}}
                </button>
            @endfor
            </div>
        </div>
    </div>
    <div class="tab-content pt-4">
        @for($i=0;$i<100;$i++)
            @if (!(${'slot_'.$i} ?? false))
                @break
            @endif
            <div
                x-show="activeTab == {{$i}}"
                x-transition:enter="transition-all duration-500 easy-in-out"
                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
            >
                <div>
                    {{${'slot_'.$i} }}
                </div>
            </div>
        @endfor
    </div>
</div>
