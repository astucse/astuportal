<?php

return [
    'name' => 'MeetingManagement',
    'admin-routes' => [
    	(object)['r'=>url('/meetingmanagement/admin'), 'n' => 'Index' ],
    ],
    'student-routes' => [
    ],
    'employee-routes' => [
    	(object)['r'=>url('/meetingmanagement/employee/create'), 'n' => 'Create' ],
    	(object)['r'=>url('/meetingmanagement/employee/mygroups'), 'n' => 'My Groups' ],
    ],
];
