<?php



return [
    'name-text' => 'StaffEvaluation',
    'name' => 'Staff Evaluation',
    'admin-routes' => [
    	(object)['r'=>url('/staffevaluation/admin'), 'n' => 'Index' ],
    	(object)['r'=>url('/staffevaluation/admin/evaluations'), 'n' => 'Evaluation Forms' ],
    	(object)['r'=>url('/staffevaluation/admin/sessions'), 'n' => 'Evaluation Sessions' ],
    	(object)['r'=>url('/staffevaluation/admin/setting'), 'n' => 'Setting' ],
    	// (object)['r'=>url('/staffevaluation/admin/sessions'), 'n' => 'Evaluation Sessions' ],
    	// (object)['r'=>url('/academic/admin/department'), 'n' => 'Department' ],
    	// (object)['r'=>url('/academic/admin/group'), 'n' => 'Groups' ],
    	// (object)['r'=>url('/'), 'n' => 'Courses' ],
    ],
    'student-routes' => [
    	(object)['r'=>url('/staffevaluation/student/evaluations'), 'n' => 'Evaluations' ],
    ],
    'employee-routes' => [
        (object)['r'=>url('/staffevaluation/employee/evaluations'), 'n' => 'Collegue Evaluations' ],
        (object)['r'=>url('/staffevaluation/employee/myevaluations'), 'n' => 'My Evaluations' ],
    ],
    'department-routes' => [
        (object)['r'=>url('/staffevaluation/department/evaluation_sessions'), 'n' => 'Sessions' ],
        (object)['r'=>url('/staffevaluation/department/evaluations'), 'n' => 'Evaluate' ],
    ],
];
