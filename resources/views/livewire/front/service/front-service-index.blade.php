<x-slot:title>{{config('starterkid-service.service_title')}}</x-slot>
<x-slot:robots>noindex, follow</x-slot>

<div>
    @include('starterkid-frontend::header')
    

<x-starterkid-frontend::card>
    <x-starterkid-frontend::card-header heading="{{config('starterkid-service.service_title')}}" description="{{config('starterkid-service.service_description')}}" />
      
    <x-starterkid-frontend::wrapper>
   
        
    <x-starterkid-frontend::card-grid>
            @foreach($services as $service)
            <x-starterkid-frontend::card-grid-service-item wire:navigate
            imgSrc="{{Cache::has('logo') ? Cache::get('logo') : asset('/logo.png')}}"
            imgAlt="{{$service->name}}"
            href="{{route('front.service.show',$service->slug)}}"
            hrefTitle="{{$service->name}}"
            heading="{{$service->name}}"
            preview="{!!Str::limit($service->preview,200)!!}"
            />
            
          @endforeach 
         
          </x-starterkid-frontend::card-grid>
          
 
      
    </x-starterkid-frontend::wrapper>
 
</x-starterkid-frontend::card>


    
    @include('starterkid-frontend::footer',['services' => $services])
</div>