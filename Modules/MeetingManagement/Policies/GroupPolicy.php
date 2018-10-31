<?php

namespace Modules\MeetingManagement\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

use App\Models\Employee;
use Modules\MeetingManagement\Entities\Group;

class GroupPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct(){
    
    }

    public function view(Employee $user, Group $group){
        return  $group->members->contains($user);
    }
}
