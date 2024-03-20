<x-slot:title>{{config('starterkid-service.service_title')}}</x-slot>
<x-slot:robots>noindex, follow</x-slot>

<div>
    @include('starterkid-frontend::header')
    

<x-starterkid-frontend::card>
    <x-starterkid-frontend::card-header heading="{{config('starterkid-service.service_title')}}" />
      
    <x-starterkid-frontend::wrapper>
   
  
     
            <x-starterkid-frontend::card-grid>
            
            @foreach($services as $service)
           <x-starterkid-frontend::post-card :model="$service" name="{{$service->name}}" linkRoute="{{route('front.service.show',$service->slug)}}" linkTitle="{{$service->name}}" buttonText="{{__('More info')}}" description="{!!$service->preview!!}" />
            @endforeach

            
        </x-starterkid-frontend::card-grid>
    
      
    </x-starterkid-frontend::wrapper>
 
</x-starterkid-frontend::card>


    
    @include('starterkid-frontend::footer',['services' => $services])
</div>