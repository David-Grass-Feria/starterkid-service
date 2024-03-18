<?php

namespace GrassFeria\StarterkidService\Livewire\Service;


use Livewire\Component;
use GrassFeria\Starterkid\Traits\LivewireIndexTrait;


class ServiceIndex extends Component
{

    use LivewireIndexTrait;


    public function mount()
    {
        $this->authorize('viewAny',\GrassFeria\StarterkidService\Models\Service::class);
    }

    public function destroyRecords()
    {
        
        foreach ($this->selected as $recordId) {
            $findRecord = \GrassFeria\StarterkidService\Models\Service::find($recordId);
            $this->authorize('delete',[\GrassFeria\StarterkidService\Models\Service::class,$findRecord]);
            \GrassFeria\Starterkid\Jobs\SpatieMediaLibary\DeleteMediaCollection::dispatch($findRecord,'services');
            $findRecord->delete();

        }

        $this->selected = [];


    }


    public function render()
    {

      
        $services = \GrassFeria\StarterkidService\Models\Service::query()
        ->select('id','user_id','name','published','status','slug')
        ->where('id','like','%'.$this->search.'%')
        ->orWhere('name','like','%'.$this->search.'%')
        ->orderBy($this->orderBy, $this->sort)
        ->paginate($this->perPage);

        return view('starterkid-service::livewire.service.service-index',['services' => $services]);

        
    }
}
