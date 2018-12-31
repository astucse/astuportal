<?php

return [
    'name' => 'Org',
    'name-text' => 'Organization',
    'admin-routes' => [
    	(object)['r'=>url('/org/admin'), 'n' => 'Structure' ],
    	(object)['r'=>url('/org/admin/office'), 'n' => 'Office' ],
    	// (object)['r'=>url('/academic/admin/school'), 'n' => 'School' ],
    	// (object)['r'=>url('/academic/admin/department'), 'n' => 'Department' ],
    	// (object)['r'=>url('/academic/admin/group'), 'n' => 'Groups' ],
    	// (object)['r'=>url('/academic/admin/course'), 'n' => 'Courses' ],
    	// (object)['r'=>url('/academic/admin/curriculum'), 'n' => 'Curriculum' ],
     //    (object)['r'=>url('/academic/admin/instructors'), 'n' => 'Roles' ],
    ],
    // 'admin-order'=>10,
    'student-routes' => [
    ],
    'employee-routes' => [
    ],
    'department-routes' => [
        // (object)['r'=>url('/academic/department/instructors'), 'n' => 'Instructors' ],
    ],
    'school-routes' => [
        // (object)['r'=>url('/academic/school/'), 'n' => '' ],
    ],
];
