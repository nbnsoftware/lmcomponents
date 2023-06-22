<div>
    @php
        $title=$title??$this->Hook("Table{$name}Title");
        $object=$object??$this->Hook("Table{$name}Object"); $object=$object?$object:"object";
        $query=$query??$this->Hook("Table{$name}Query");
        $columns=$columns??$this->Hook("Table{$name}Columns");
        $additions=$additions??$this->Hook("Table{$name}Additions");
        $editions=$editions??$this->Hook("Table{$name}Editions");
        $deletions=$deletions??$this->Hook("Table{$name}Deletions");
        $pagination=$pagination??$this->Hook("Table{$name}Pagination");

    @endphp
    <div class="flex items-center justify-between">
        <div class="flex items-center justify-start">
            <h2
                class="text-base font-medium tracking-wide text-slate-700 line-clamp-1 mr-2"
            >
                {!! $title !!}
            </h2>
            @if ($additions??$this->Hook("Table{$name}Additions"))
            <div>
                <button
                    class="btn h-8 w-8 rounded-full p-0 bg-slate-500/20 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25"
                    wire:click="Hook('Table{{$name}}Add')"
                >
                     <i class="fas fa-plus text-sm transition-transform"></i>
                </button>
            </div>
            @endif
        </div>
        <div>
        </div>
        <div class="flex">
            <div class="flex items-center">
                <label class="block">
                    <div class="relative mr-4 flex h-8">
                        <input placeholder="Buscar..."
                               class="form-input peer h-full rounded-full bg-slate-150 px-4 pl-9 text-xs+ text-slate-800 ring-primary/50 hover:bg-slate-200 focus:ring"
                               type="text"
                               wire:model.debounce.750ms="cerca"/>

                        <div
                            class="pointer-events-none absolute flex h-full w-10 items-center justify-center text-slate-400 peer-focus:text-primary">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                 class="h-4.5 w-4.5 transition-colors duration-200" fill="currentColor"
                                 viewBox="0 0 24 24">
                                <path
                                    d="M3.316 13.781l.73-.171-.73.171zm0-5.457l.73.171-.73-.171zm15.473 0l.73-.171-.73.171zm0 5.457l.73.171-.73-.171zm-5.008 5.008l-.171-.73.171.73zm-5.457 0l-.171.73.171-.73zm0-15.473l-.171-.73.171.73zm5.457 0l.171-.73-.171.73zM20.47 21.53a.75.75 0 101.06-1.06l-1.06 1.06zM4.046 13.61a11.198 11.198 0 010-5.115l-1.46-.342a12.698 12.698 0 000 5.8l1.46-.343zm14.013-5.115a11.196 11.196 0 010 5.115l1.46.342a12.698 12.698 0 000-5.8l-1.46.343zm-4.45 9.564a11.196 11.196 0 01-5.114 0l-.342 1.46c1.907.448 3.892.448 5.8 0l-.343-1.46zM8.496 4.046a11.198 11.198 0 015.115 0l.342-1.46a12.698 12.698 0 00-5.8 0l.343 1.46zm0 14.013a5.97 5.97 0 01-4.45-4.45l-1.46.343a7.47 7.47 0 005.568 5.568l.342-1.46zm5.457 1.46a7.47 7.47 0 005.568-5.567l-1.46-.342a5.97 5.97 0 01-4.45 4.45l.342 1.46zM13.61 4.046a5.97 5.97 0 014.45 4.45l1.46-.343a7.47 7.47 0 00-5.568-5.567l-.342 1.46zm-5.457-1.46a7.47 7.47 0 00-5.567 5.567l1.46.342a5.97 5.97 0 014.45-4.45l-.343-1.46zm8.652 15.28l3.665 3.664 1.06-1.06-3.665-3.665-1.06 1.06z" />
                            </svg>
                        </div>
                    </div>
                </label>
            </div>
        </div>
    </div>
    <div class="cardddd mt-3">
        <div x-ref="taula" class="is-scrollbar-hidden overflow-x-auto" style="max-height: 670px">
            <table class="text-left">
                <thead class="sticky top-0 z-20">
                <tr>
                    @foreach($columns as $column)
                        <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">
                            {{ $$column->attributes->get("header") }}
                        </th>
                    @endforeach
                    @if ($editions)
                            <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">
                            </th>
                    @endif
                    @if ($deletions)
                            <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">
                            </th>
                    @endif
                </tr>
                </thead>
                <tbody x-data="{expanded:false}">
                    @php
                        $tabledata=$query;
                        if ($pagination) {
                            $tabledata->paginate(4);
                        }
                    @endphp
                    @foreach ($tabledata->get() as $row)
                    <tr class="border-y border-transparent {{ $loop->odd?'bg-green-100':'bg-white' }}">
                        @foreach($columns as $column)
                            @if(!$$column->attributes->get("model"))
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    {!! Blade::render("{$$column}",["row"=>$row]) !!}
                                </td>
                            @else
                                @switch ($$column->attributes->get("type"))
                                    @case ("text")
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            {!! $row->{$$column->attributes->get("model")} !!}
                                        </td>
                                        @break
                                        {{-- $row->{$$column->attributes->get("format")}??"Y-m-d"  --}}
                                    @case ("numeric")
                                        <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 sm:px-5 text-right">
                                            {!! number_format(($row->{$$column->attributes->get("model")})*1,$$column->attributes->get("decimals")??0 ,",") !!}
                                        </td>
                                        @break
                                    @case ("date")
                                        <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 sm:px-5 text-right">

                                            {!! (new \Carbon\Carbon($row->{$$column->attributes->get("model")}))->format($$column->attributes->get("format")??"Y-m-d")   !!}
                                        </td>
                                        @break
                                    @default
                                        <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 sm:px-5">
                                            {!! $row->{$$column->attributes->get("model")} !!}
                                        </td>
                                        @break
                                @endswitch
                            @endif
                        @endforeach
                        @if ($editions??$this->Hook("Table{$name}Editions"))
                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                <button
                                    class="btn h-8 w-8 rounded-full p-0 bg-slate-500/20 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25  "
                                    wire:click="Table{{$name}}Edit({{$row->id}})"
                                >
                                    <i class="fas fa-edit fa-2xl text-sm transition-transform"></i>
                                </button>
                            </td>
                        @endif
                        @if ($deletions??$this->Hook("Table{$name}Deletions"))
                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                    <button
                                        class="btn h-8 w-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25"
                                        wire:click="delete({{$row->id}})"
                                    >
                                        <i class="fas fa-trash transition-transform"></i>
                                    </button>
                                </td>
                        @endif
                    </tr>
                    @endforeach
                    @if($pagination)
                    <tr >
                        <td colspan="999">
                            {{ $tabledata->paginate(4)->links() }}
                        </td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
        {{--inici modal --}}
    @if ($this->{$object??"object"})
        <div>
            <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5" role="dialog">
                <div class="absolute inset-0 bg-slate-900/60 opacity-30 "></div>
                <div class="relative rounded-lg bg-white"  style="width:900px; max-height: 520px;">
                    <div class="flex justify-end p-4 bg-gray-200 rounded-t-lg">
                        <button
                            class="btn h-8 w-8 rounded-full p-0 bg-slate-500/20 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25"
                            wire:click="Hook('Table{{$name}}Close')"
                        >
                            <i class="fas fa-xmark   text-sm transition-transform"></i>
                        </button>
                    </div>
                    <div class="p-4">
                        {{ $form }}
                    </div>
                    <div class="flex justify-around p-4">
{{--                        <button
                            wire:click="Table{{$name}}Close()"
                            class="w-36 p-2 mr-1 bg-red-500 hover:bg-red-700 text-white rounded-md"
                        >
                            Tancar
                        </button>--}}
                        <button
                            wire:click.prevent="Table{{$name}}Save()"
                            wire:loading.attr="disabled"
                            class="w-36 p-2 mr-1 bg-green-500 hover:bg-green-700 text-white rounded-md"
                        >
                            Desar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif
    {{--Final modal manteniment de cotxes--}}

</div>


