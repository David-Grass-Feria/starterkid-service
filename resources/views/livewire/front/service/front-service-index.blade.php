<x-slot:title>{{config('starterkid-service.service_title')}}</x-slot>
<x-slot:robots>noindex, follow</x-slot>

<div>
    @include('starterkid-frontend::header')
    

<x-starterkid-frontend::card>
    <x-starterkid-frontend::card-header heading="{{config('starterkid-service.service_title')}}" description="{{config('starterkid-service.service_description')}}" />
      
    <x-starterkid-frontend::wrapper>
   
        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3 mt-5">
            @foreach($services as $service)
            <div class="relative flex items-center space-x-3 rounded-lg border border-gray-300 bg-white px-6 py-5">
              <div class="flex-shrink-0">
                <img class="h-10 w-10 rounded-3xl object-contain" src="{{Cache::has('logo') ? Cache::get('logo') : asset('/logo.png')}}" alt="{{$service->name}}">
              </div>
              <div class="min-w-0 flex-1 text-font_primary">
                <a href="{{route('front.service.show',$service->slug)}}" title="{{$service->name}}" class="focus:outline-none">
                  <span class="absolute inset-0" aria-hidden="true"></span>
                  <p class="text-lg font-bold">{{$service->name}}</p>
                  <p class="truncate text-xs">{!!Str::limit($service->preview,200)!!}</p>
                </a>
              </div>
            </div>
          @endforeach 
         
          </div>
          
 
      
    </x-starterkid-frontend::wrapper>
 
</x-starterkid-frontend::card>


    
    @include('starterkid-frontend::footer',['services' => $services])
</div>