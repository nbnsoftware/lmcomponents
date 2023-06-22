<div>
    <div class="fixed inset-0 z-[100] flex flex-col items-center justify-center overflow-hidden px-4 py-6 sm:px-5" role="dialog">
        <div class="absolute inset-0 bg-slate-900/60 opacity-30 "></div>
        <div class="relative rounded-lg bg-white px-4 py-4 text-center sm:px-5" style="width:900px; max-height: 520px">
            <div>
                {{ $slot }}
            </div>
                <div class="flex justify-between p-4">
                    <button
                        wire:click="close()"
                        class="w-36 p-2 mr-1 bg-red-500 hover:bg-red-700 text-white rounded-md"
                    >
                        Tancar
                    </button>
                    <button
                        wire:click.prevent="save()"
                        wire:loading.attr="disabled"
                        class="w-36 p-2 mr-1 bg-green-500 hover:bg-green-700 text-white rounded-md"
                    >
                        Desar
                    </button>
                </div>
        </div>
    </div>
</div>
