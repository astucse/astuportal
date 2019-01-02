<?php

return [
    'name' => 'OfficeAutomation',
    'name' => 'Office Automation',
    'admin-routes' => [
    	// (object)['r'=>url('/meetingmanagement/admin'), 'n' => 'Index' ],
    ],
    'student-routes' => [
    ],
    'employee-routes' => [
        (object)['r'=>url('/officeautomation/employee/letter/new'), 'n' => 'Create letter' ],
        (object)['r'=>url('/officeautomation/employee/letter/outbox'), 'n' => 'Outbox letters' ],
    	(object)['r'=>url('/officeautomation/employee/letter/inbox'), 'n' => 'Inbox letters' ],
    	// (object)['r'=>url('/meetingmanagement/employee/mygroups'), 'n' => 'My Groups' ],
    ],
];
