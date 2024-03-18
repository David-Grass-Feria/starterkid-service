<x-slot:title>{{$service->name}}</x-slot>
<x-slot:robots>noindex, follow</x-slot>


<div>
    @include('starterkid-frontend::header')
    


    <x-starterkid-frontend::card>

      
    <x-starterkid-frontend::wrapper>
   
  
    <x-starterkid-frontend::body-content heading="{{$service->name}}" content="{!!$service->content!!}"  />

    
      
    </x-starterkid-frontend::wrapper>
 
</x-starterkid-frontend::card>


    
    @include('starterkid-frontend::footer',['services' => $services])
</div>