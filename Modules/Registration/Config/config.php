<?php

return [
    'name' => 'Registration',
    'name-text' => 'Registration',
    'admin-routes' => [
    	(object)['r'=>url('/registration/admin'), 'n' => 'Index' ],
    	(object)['r'=>url('/registration/admin/group'), 'n' => 'Groups' ],
    ],
    'student-routes' => [
    ],
    'employee-routes' => [
    ],
    'department-routes' => [
        (object)['r'=>url('/registration/department/students'), 'n' => 'Students' ],
        (object)['r'=>url('/registration/department/instructors'), 'n' => 'Instructors' ],
    	(object)['r'=>url('/registration/department/group'), 'n' => 'Groups' ],
    ],
    'school-routes' => [
    	(object)['r'=>url('/registration/school/group'), 'n' => 'Groups' ],
    ],

    'seeder' => [
        "OptionTableSeeder",
    ]
];
