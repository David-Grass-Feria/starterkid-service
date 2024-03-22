<?php

namespace GrassFeria\StarterkidService\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;
use \GrassFeria\StarterkidService\Models\Service;
use GrassFeria\Starterkid\Traits\EditorPolicyTrait;
use GrassFeria\Starterkid\Traits\OnlyUserRecordPolicyTrait;;

class ServicePolicy
{
   
     use EditorPolicyTrait;

   

    
}
