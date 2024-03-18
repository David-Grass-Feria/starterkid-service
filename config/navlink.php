<?php

return [
    [
        'title_en' => 'Services',
        'permission' => 'viewAny',
        'model' => \GrassFeria\StarterkidService\Models\Service::class,
        'route' => 'services.index',
        'active' => ['services.index', 'services.edit', 'services.create'],
        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="h-5 w-5" viewBox="0 0 16 16">
         <path d="M11 2a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5a3 3 0 0 1-3-3V5a3 3 0 0 1 3-3zM5 1a4 4 0 0 0-4 4v6a4 4 0 0 0 4 4h6a4 4 0 0 0 4-4V5a4 4 0 0 0-4-4z"/>
        </svg>',
        
    ],

    
];