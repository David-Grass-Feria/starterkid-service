<?php

namespace GrassFeria\StarterkidService\Livewire\Service;

use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;


class ServiceCreate extends Component
{
    use WithFileUploads;

    public $service;
    public $name;
    public $title;
    public $content;
    public $created_at;
    public $status = true;
    public $slug;
    public $preview;
    
    



    public function mount($recordId = null)
    {
        
        $this->authorize('create',\GrassFeria\StarterkidService\Models\Service::class);
        //$this->date                                 = now()->format(config('starterkid.time_format.date_format_for_picker'));
        $this->created_at                              = now()->format(config('starterkid.time_format.date_time_format_for_picker'));
        //$this->time                                 = now()->format(config('starterkid.time_format.time_format_for_picker'));
        
    }

    public function updated($name)
    {
        $this->slug = Str::slug($this->name);
        $this->title = ucfirst($this->name);
    }

    public function save()
    {


        $validated = $this->validate([
            'name'                      => 'required|string',
            'slug'                      => 'required|string',
            'title'                     => 'required|string',
            'content'                   => 'required|string',
            'preview'                   => 'nullable|string',
            'created_at'                 => 'required|date_format:' . config('starterkid.time_format.date_time_format_for_picker'),
            'status'                    => 'required|boolean',
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
        
        
        $this->authorize('create',\GrassFeria\StarterkidService\Models\Service::class);
        $validated = array_merge($validated, ['user_id' => auth()->user()->id]);
        $this->service = \GrassFeria\StarterkidService\Models\Service::create($validated);
        
        //if ($this->public_photos !== []) {
        //\GrassFeria\Starterkid\Jobs\SpatieMediaLibary\DeleteMediaCollection::dispatch($this->service,'avatars');
        //(new \GrassFeria\Starterkid\Services\SpatieMediaLibary\SaveMediaWithFilenameService($this->public_photos,$this->service,'photos','public','my-new-filename'));
        //(new \GrassFeria\Starterkid\Services\SpatieMediaLibary\SaveMediaService($this->public_photos, $this->service, 'photos', 'public'));
        //}
        
        (new \GrassFeria\Starterkid\Services\CheckCkEditorContent($this->service->content,'content'))->checkForCkEditorImages($this->service,'services','ckimage');
        return redirect()->route('services.index')->with('success', __('Service created'));

    }
    public function render()
    {
        
        return view('starterkid-service::livewire.service.service-create');
        
    }
}
