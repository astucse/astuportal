<?php

namespace Modules\Academic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\OptionsHelper;
use Modules\Academic\Entities\School;
use Modules\Academic\Entities\Department;
class CourseBreakdownTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $occ_id = OptionsHelper::current_curriculum()->id;
        $soeec_id = School::where(['code'=>'SoEEC'])->first()->id;
        $departments = Department::where(['school_id'=>$soeec_id])->get();
        for ($i=1;$i<=2;$i++) {
            \Modules\Academic\Entities\CourseBreakdown::create([
                'year' => 1,
                'semester' => $i,
                // 'institution_id' => $request['institution_id'],
                // 'institution_type' => ,
                // 'courses' => ,
                // 'electives' => ,
                'curriculum_id' => $occ_id
            ]);
        }
        \Modules\Academic\Entities\CourseBreakdown::create([
            'year' => 2,
            'semester' => 1,
            'institution_id' => $soeec_id,
            'institution_type' => 'Academic\School',
            // 'courses' => ,
            // 'electives' => ,
            'curriculum_id' => $occ_id
        ]);
        for ($i=2;$i<=5;$i++) {
            foreach ($departments as $department) {
                if ($i>2) {
                    \Modules\Academic\Entities\CourseBreakdown::create([
                        'year' => $i,
                        'semester' => 1,
                        'institution_id' => $department->id,
                        'institution_type' => 'Academic\Department',
                        // 'courses' => ,
                        // 'electives' => ,
                        'curriculum_id' => $occ_id
                    ]);
                }
                \Modules\Academic\Entities\CourseBreakdown::create([
                    'year' => $i,
                    'semester' => 2,
                    'institution_id' => $department->id,
                    'institution_type' => 'Academic\Department',
                    // 'courses' => ,
                    // 'electives' => ,
                    'curriculum_id' => $occ_id
                ]);
            }
        }
        // $this->call("OthersTableSeeder");
    }
}
