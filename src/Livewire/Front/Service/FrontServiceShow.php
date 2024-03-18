<?php

namespace GrassFeria\StarterkidService\Livewire\Front\Service;


use Livewire\Component;
use Livewire\Attributes\Layout;



class FrontServiceShow extends Component
{

   public $service; 
   
   public function mount($slug)
   {
      $this->service = \GrassFeria\StarterkidService\Models\Service::where('slug',$slug)->firstOrFail();
   }
  
  
    #[Layout('starterkid-frontend::components.layouts.front')] 
    public function render()
    {
     
      $services = \GrassFeria\StarterkidService\Models\Service::frontGetServicesWhereStatusIsOnline()->get();
      return view('starterkid-service::livewire.front.service.front-service-show',['services' => $services]);

        
    }
}
