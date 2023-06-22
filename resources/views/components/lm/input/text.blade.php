<div >
    @if(!($hidden??$this->Hook("Field{$name}Hidden")))
    <label>
        <span>{{$label??$this->Hook("Field{$name}Label")}}</span>@error("object.$model") <span class="text-red-500 text-xs">Falta {{$name??""}}</span> @enderror
    </label>
    <input
        class="form-input mb-1.5 w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary"
        placeholder=""
        type="text"
        @if ($disabled??$this->hook("Field{$name}Disabled"))
        disabled
        @endif
        @if ($model??"")
            @php $this->rules[$model]=""; @endphp
            wire:model="{{$model}}"
        @endif
    />

    @endif
</div>
