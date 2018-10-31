<?php

return [
    'name' => 'Academics',
    'admin-routes' => [
    	(object)['r'=>url('/academic/admin'), 'n' => 'Index' ],
    	(object)['r'=>url('/academic/admin/school'), 'n' => 'School' ],
    	(object)['r'=>url('/academic/admin/department'), 'n' => 'Department' ],
    	(object)['r'=>url('/academic/admin/group'), 'n' => 'Groups' ],
    	(object)['r'=>url('/academic/admin/course'), 'n' => 'Courses' ],
    	(object)['r'=>url('/'), 'n' => 'Curriculum' ],
    	(object)['r'=>url('/academic/admin/instructors'), 'n' => 'Instructors' ],
    ],
    'student-routes' => [
    ],
    'employee-routes' => [
    ],
];
