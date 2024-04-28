<x-slot:title>{{$service->title}}</x-slot>
<x-slot:robots>index, follow</x-slot>


<div>
    @include('starterkid-frontend::header')
    


    <x-starterkid-frontend::card>

      
    <x-starterkid-frontend::wrapper>
   
  
    <x-starterkid-frontend::body-content heading="{{$service->name}}" content="{!!$service->content!!}"  />

    
      
    </x-starterkid-frontend::wrapper>
 
</x-starterkid-frontend::card>


    
    @include('starterkid-frontend::footer',['services' => $services])
</div>


@section('meta')
<meta property="og:title" content="{{$service->name}}" />
<meta property="og:description" content="{{ strip_tags($service->preview) ?? '' }}" />
<meta property="og:image" content="{{$service->getFirstMediaUrl('ckimages','large') ?? ''}}" />
<meta property="og:url" content="{{url()->current()}}" />
<meta property="og:type" content="website" />
@endsection