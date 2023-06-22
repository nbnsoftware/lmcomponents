<div wire:ignore x-data="{
    q:'la q',
    @if($model)
    content: @entangle($model),
    @else
    content: '',
    @endif
    @if ($title)
    title : @entangle($title),
    @else
    title: '',
    @endif
    init() {
        ClassicEditor.create($refs.container).catch( error => {
                console.error( error );
        } ).then( editor => {
            editor.setData(this.content);
            this.q=editor
        } )
        $watch('content', value => Alpine.raw(this.q).setData(value))
    },
    save() {
       this.content=Alpine.raw(this.q).getData()
       Livewire.emit('desaEditor')
    },
    cancel() {
       Livewire.emit('tancaEditor')
    }
}">
    <div x-text="title">

    </div>
    <div x-ref="container">
        <p></p>
    </div>
    <div class="bg-gray-50 py-2 flex flex-row-reverse justify-between">
        <button type="button" x-on:click="save()" class="inline-flex w-full justify-center rounded-md bg-red-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-red-500 sm:w-auto">Ok</button>
        <button type="button" x-on:click="cancel()" class="mt-3 inline-flex w-full justify-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 hover:bg-gray-50 sm:mt-0 sm:w-auto">Cancel</button>
    </div>
</div>
