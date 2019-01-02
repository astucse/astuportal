<?php

namespace Modules\Academic\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use Modules\Academic\Entities\Course;

class CoursePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){
        
    }
}
