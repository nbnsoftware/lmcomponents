<div style="display:flex;flex-direction:column;width:100%;height:100%;flex-wrap: nowrap;margin:0 auto" x-data="
{
    imageUrl: @entangle($attributes->whereStartsWith('wire:model')->first()),
    noImageUrl: '{{ $background }}',
    image2cropUrl: null,

    image:null,cropper:null,aspectRatios:1,ratio:0,croppedCanvas:null,croppedImage:null,

    changeAspectRatio(value){
        aspectRatios = value;
        this.cropper.setAspectRatio(aspectRatios);
    },

    fileChosen(event) {
        this.fileToDataUrl(event, src => {this.image2cropUrl = src; this.initCrop()})

    },


    fileToDataUrl(event, callback) {
      if (! event.target.files.length) return

      let file = event.target.files[0],
          reader = new FileReader()

      reader.readAsDataURL(file)
      reader.onload = e => callback(e.target.result)
    },

    changeZoom(value){
        ratio = value;
        this.cropper.zoom(ratio);
    },

    cropImage(e){
        e.stopPropagation();
        console.log('a',this.cropper)
        // Crop
        croppedCanvas = this.cropper.getCroppedCanvas({width:{{$width}},height:{{$height}}});

        // Show
        croppedImage = this.$refs.image
        this.imageUrl = croppedCanvas.toDataURL('image/jpeg', 0.8);
        this.image=null  // tanca modal
        this.cropper.destroy()
    },

    cancelImage(e) {
        e.stopPropagation();
        this.image=null
        this.cropper.destroy()
    },

    initCrop() {
        image = this.$refs.image2crop
        image.src=this.image2cropUrl
        this.image=image
        this.$forceNextTick(() => {
            this.cropper = new Cropper(this.image, {
                    aspectRatio: {{($width/$height)}},
                    viewMode: 2,
            })
        });

    },

    mostra() {
        console.log(this.cropper,this.image)
    },

    erase(event) {
        this.imageUrl=null;
    }
}
">
    <lm-row>
        @if (!$readonly)
            <div x-show="!imageUrl">
                   <input id="{{$myid}}" style="display:none;height:1px" type="file" accept="image/*" @change="fileChosen">
                    <label for="{{$myid}}" class="anchor"><i class="fas fa-camera  mb-1"></i></label>
            </div>
            <div x-show="imageUrl">
                <div>
                    <lm-clickable><label><i class="fa-solid fa-trash-can  mb-1" @click="erase"></i></label></lm-clickable>
                </div>
            </div>
        @endif
        @if ($required)
            <label class="text-red-600">*&nbsp;</label>
        @endif
        @error($attributes->whereStartsWith("wire:model")->first())
        @if($label)
            <div>
            <label>{{ $label }}: </label>
            </div>
        @endif
        <lm-hspace>
            <i class="fa-solid fa-circle-exclamation text-red-600" title="{{ $message }}"></i>
        </lm-hspace>
        @else
            @if($label)
                <div class="ml-2">
                    <label>{{ $label }}: </label>
                </div>
            @endif
        @enderror
    </lm-row>
    <!-- Show the image -->
    <div x-show="imageUrl" style="flex-grow:1;overflow-y: hidden" class="border border-gray-200 bg-gray-100">
        <img id="image" x-ref="image" x-bind:src="imageUrl" style="height:100%;width:100%;object-fit:contain" alt="">
    </div>
    <!-- Show the background image when image is not available -->
    <div x-show="!imageUrl" style="flex-grow:1;overflow-y: hidden;" class="border border-gray-200 bg-gray-100">
        <img id="noImage" x-ref="noImage" x-bind:src="noImageUrl" style="height:100%;width:100%;object-fit:contain" alt="">
    </div>

    <!-- Modal d'edició -->

    <lm-modal-background x-show="image" style="display:none">
        <lm-modal-form x-ref="modal" style="padding:5% 5% 5% 5%;">
            <lm-modal-header style="width:100%">
                <lm-row >
                    <lm-space><lm-clickable><i class="fa-regular fa-circle-check fa-2x text-green-700" @click="cropImage($event)"></i></lm-clickable></lm-space>
                    <div style="flex-grow:1"></div>
                    <lm-space><lm-clickable><i class="fa-regular fa-circle-xmark fa-2x text-red-700" @click="cancelImage($event)"></i></lm-clickable></lm-space>
                </lm-row>
            </lm-modal-header>
            <div x-ref="cropping" style="width:100%;height:100%">
                <img x-ref="image2crop" src="" style="height:100%;width:100%;object-fit:contain;">
            </div>
        </lm-modal-form>
    </lm-modal-background>
</div>

