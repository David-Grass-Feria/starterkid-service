<?php

namespace GrassFeria\StarterkidService\Policies;

use App\Models\User;
use \GrassFeria\StarterkidService\Models\Service;
use Illuminate\Auth\Access\Response;
use GrassFeria\Starterkid\Traits\OnlyUserRecordPolicyTrait;;

class ServicePolicy
{
   
     use OnlyUserRecordPolicyTrait;

   

    
}
