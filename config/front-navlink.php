<?php

return [
    [
        'title' => env('SERVICE_MENU_NAME','Service'),
        'menu_name' => env('SERVICE_MENU_NAME','Service'),
        'route' => 'front.service.index',
        'active' => ['front.service.index','front.service.show'],
        'order' => env('SERIVCE_ORDER_FOR_NAV',2),
        
        
    ],

    
];