<div >
    @if(!($this->{"{$name}Hidden"}()??""))
        <label class="block">
            <span>{{$label??""}}</span>@error("object.$model") <span class="text-red-500 text-xs">Falta {{$name??""}}</span> @enderror
            <select
                class="form-input mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
                @if ($this->{"{$name}Disabled"}() ?? false)
                    disabled
                @endif
                @if ($model??"")
                    wire:model="{{$model}}"
                @endif
            >
                @foreach ($this->{"{$name}Options"}() as $idx=>$option)
                    <option value="{{$idx}}">{!! $option !!}</option>
                @endforeach
            </select>
        </label>

        </label>
    @endif
</div>
