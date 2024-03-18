<?php

namespace GrassFeria\StarterkidService\Livewire\Front\Service;


use Livewire\Component;
use Livewire\Attributes\Layout;
use GrassFeria\Starterkid\Traits\LivewireIndexTrait;



class FrontServiceIndex extends Component
{

   
   use LivewireIndexTrait;
  
  
    #[Layout('starterkid-frontend::components.layouts.front')]
    public function render()
    {
     
      $services = \GrassFeria\StarterkidService\Models\Service::frontGetServicesWhereStatusIsOnline($this->search,$this->orderBy, $this->sort)->get();
      return view('starterkid-service::livewire.front.service.front-service-index',['services' => $services]);

        
    }
}
