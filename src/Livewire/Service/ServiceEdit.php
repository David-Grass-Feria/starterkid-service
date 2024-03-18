<?php

namespace GrassFeria\StarterkidService\Livewire\Service;

use Livewire\Component;
use Livewire\WithFileUploads;


class ServiceEdit extends Component
{
    use WithFileUploads;

    public $service;
    public $name;
    public $title;
    public $content;
    public $published;
    public $status;
    public $slug;
    public $preview;
    
    



    public function mount($recordId = null)
    {
        
       
        $this->service                          = \GrassFeria\StarterkidService\Models\Service::find($recordId);
        $this->name                             = $this->service->name;
        $this->title                            = $this->service->title;
        $this->content                          = $this->service->content;
        $this->preview                          = $this->service->preview;
        $this->published                        = $this->service->published->format(config('starterkid.time_format.date_time_format_for_picker'));
        $this->status                           = $this->service->status;
        $this->slug                             = $this->service->slug;
      
        $this->authorize('update',[\GrassFeria\StarterkidService\Models\Service::class,$this->service]);
        //$this->date                                 = $this->service->date->format(config('starterkid.time_format.date_format_for_picker'));
        //$this->date_time                            = $this->service->date_time->format(config('starterkid.time_format.date_time_format_for_picker'));
        //$this->time                                 = $this->service->time->format(config('starterkid.time_format.time_format_for_picker'));
            
       
    }

    public function save()
    {


        $validated = $this->validate([
            'name'                      => 'required|string',
            'title'                     => 'required|string',
            'slug'                      => 'required|string',
            'content'                   => 'required|string',
            'preview'                   => 'nullable|string',
            'published'                 => 'required|date_format:' . config('starterkid.time_format.date_time_format_for_picker'),
            'status'                    => 'required|boolean',
            //'title'                     => 'required|string',
            //'color'                     => 'required|string',
            //'range'                     => 'required|string',
            //'about'                     => 'required|string',
            //'country'                   => 'required|string',
            //'active'                    => 'required|boolean',
            //'radio'                     => 'required|string',
            //'date'                      => 'required|date_format:' . config('starterkid.time_format.date_format_for_picker'),
            //'date_time'                 => 'required|date_format:' . config('starterkid.time_format.date_time_format_for_picker'),
            //'time'                      => 'required|date_format:' . config('starterkid.time_format.time_format_for_picker'),
            //'body'                      => 'required|string',
            //'youtube_video_link'        => 'required|string',
            //'vimeo_video_link'          => 'required|string',
           
        ]);
        
       
        $this->authorize('update',[\GrassFeria\StarterkidService\Models\Service::class,$this->service]);
        $validated = array_merge($validated, ['user_id' => auth()->user()->id]);
        $this->service->update($validated);
       

        //if ($this->public_photos !== []) {
        //\GrassFeria\Starterkid\Jobs\SpatieMediaLibary\DeleteMediaCollection::dispatch($this->service,'avatars');
        //(new \GrassFeria\Starterkid\Services\SpatieMediaLibary\SaveMediaWithFilenameService($this->public_photos,$this->service,'photos','public','my-new-filename'));
        //(new \GrassFeria\Starterkid\Services\SpatieMediaLibary\SaveMediaService($this->public_photos, $this->service, 'photos', 'public'));
        //}
        
        (new \GrassFeria\Starterkid\Services\CheckCkEditorContent($this->service->content,'content'))->checkForCkEditorImages($this->service,'services','ckimage');
        return redirect()->route('services.index')->with('success', __('Service updated'));

    }
    public function render()
    {
        
        return view('starterkid-service::livewire.service.service-edit');
        
    }
}
