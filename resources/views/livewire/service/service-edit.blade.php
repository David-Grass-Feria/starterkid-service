<div>
        <x-starterkid::starterkid.card>
                <x-slot name="header">
                <a href="{{route('services.index')}}" title="{{__('Service list')}}">
                <x-starterkid::starterkid.button-secondary type="button">{{__('Back')}}</x-starterkid::starterkid.button-secondary>
                </a>
                </x-slot>
                <x-starterkid::starterkid.form cancelRoute="{{route('services.index')}}">
                
                <x-starterkid::starterkid.form.text wire:model="name" for="name" id="name" type="text" label="{{__('Name')}}" required/>
                <x-starterkid::starterkid.form.text wire:model="title" for="title" id="title" type="text" label="{{__('Title')}}" required/>
                <x-starterkid::starterkid.form.text wire:model="slug" for="slug" id="slug" type="text" label="{{__('Slug')}}" required/>
              
                <x-starterkid::starterkid.form.ckeditor5 wire:model="content" for="content" id="content" rows="5" label="{{__('Content')}}" required>
                {!!$service->content!!}
                </x-starterkid::starterkid.form.ckeditor5>
                <x-starterkid::starterkid.form.ckeditor5 wire:model="preview" for="preview" id="preview" rows="5" label="{{__('Preview')}}">
                <x-slot name="removePlugins">
                'CodeBlock','List','Highlight','HorizontalLine','BlockQuote','Table','Italic','Heading','Image','ImageUpload','MediaEmbed','SimpleUploadAdapterPlugin'
                </x-slot>
                {!!$service->preview!!}
                </x-starterkid::starterkid.form.ckeditor5>
                <x-starterkid::starterkid.form.datetime wire:model="published" for="published" id="published" label="{{__('Published')}}" required />
                <x-starterkid::starterkid.form.checkbox for="status" id="status" label="{{__('Status')}}">
                <x-starterkid::starterkid.input-checkbox-radio-panel>
                <x-starterkid::starterkid.input-checkbox wire:model="status" name="status" />
                <x-starterkid::starterkid.label>{{__('Online')}}</x-starterkid::starterkid.label>
                </x-starterkid::starterkid.input-checkbox-radio-panel>
                </x-starterkid::starterkid.form.checkbox>
              

                </x-starterkid::starterkid.form>


        </x-starterkid::starterkid.card>
        </div>