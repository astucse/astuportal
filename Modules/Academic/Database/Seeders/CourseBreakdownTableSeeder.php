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
        $json = $this->schedule();
        foreach ($json->body as $department) {
            foreach ($department->schedule as $semester) {
                $i = \Modules\Academic\Entities\Department::where('code',$department->department)->first()->id;
                $y = $semester->year;
                $s = $semester->semester;
                $e = Collect($semester->electives)->unique()->toArray();
                // if( ( $y > 2 ) || ( $y == 2 && $s == 2 )){
                //     \Modules\Academic\Entities\CourseBreakdown::create([
                //         'year' => $y,
                //         'semester' => $s,
                //         'institution_id' => $i,
                //         'institution_type' => 'Academic\\Department',
                //         'courses' => implode(",", $semester->courses),
                //         'electives' => implode(",", $e),
                //         'curriculum_id' => 1
                //     ]);
                // }
                // if(  $y == 2 && $s == 1 ){
                //     $i = \Modules\Academic\Entities\School::where('code',"SoEEC")->first()->id;
                //     \Modules\Academic\Entities\CourseBreakdown::create([
                //         'year' => $y,
                //         'semester' => $s,
                //         'institution_id' => $i,
                //         'institution_type' => 'Academic\\School',
                //         'courses' => implode(",", $semester->courses),
                //         'electives' => implode(",", $e),
                //         'curriculum_id' => 1
                //     ]);
                //     return;
                // }
                // if(  $y == 1 && $s==2){
                //     $i = \Modules\Academic\Entities\School::where('code',"SoEEC")->first()->id;
                //     \Modules\Academic\Entities\CourseBreakdown::create([
                //         'year' => $y,
                //         'semester' => $s,
                //         // 'institution_id' => $i,
                //         // 'institution_type' => 'Academic\\School',
                //         'courses' => implode(",", $semester->courses),
                //         'electives' => implode(",", $e),
                //         'curriculum_id' => 1
                //     ]);
                //     return;
                // }
            }
        }

        // $occ_id = OptionsHelper::current_curriculum()->id;
        // $soeec_id = School::where(['code'=>'SoEEC'])->first()->id;
        // $departments = Department::where(['school_id'=>$soeec_id])->get();
        // for ($i=1;$i<=2;$i++) {
        //     \Modules\Academic\Entities\CourseBreakdown::create([
        //         'year' => 1,
        //         'semester' => $i,
        //         // 'institution_id' => $request['institution_id'],
        //         // 'institution_type' => ,
        //         // 'courses' => ,
        //         // 'electives' => ,
        //         'curriculum_id' => $occ_id
        //     ]);
        // }
        // \Modules\Academic\Entities\CourseBreakdown::create([
        //     'year' => 2,
        //     'semester' => 1,
        //     'institution_id' => $soeec_id,
        //     'institution_type' => 'Academic\School',
        //     // 'courses' => ,
        //     // 'electives' => ,
        //     'curriculum_id' => $occ_id
        // ]);
        // for ($i=2;$i<=5;$i++) {
        //     foreach ($departments as $department) {
        //         if ($i>2) {
        //             \Modules\Academic\Entities\CourseBreakdown::create([
        //                 'year' => $i,
        //                 'semester' => 1,
        //                 'institution_id' => $department->id,
        //                 'institution_type' => 'Academic\Department',
        //                 // 'courses' => ,
        //                 // 'electives' => ,
        //                 'curriculum_id' => $occ_id
        //             ]);
        //         }
        //         \Modules\Academic\Entities\CourseBreakdown::create([
        //             'year' => $i,
        //             'semester' => 2,
        //             'institution_id' => $department->id,
        //             'institution_type' => 'Academic\Department',
        //             // 'courses' => ,
        //             // 'electives' => ,
        //             'curriculum_id' => $occ_id
        //         ]);
        //     }
        // }
        // $this->call("OthersTableSeeder");
    }


    public function schedule(){
        return json_decode('{"body":[{"department":"CSE","schedule":[{"year":1,"semester":1,"courses":["MATH1101","PHY1101","CHEM1101","CSE1101","ENG1101","LAR1101","HPED1101"],"electives":[]},{"year":1,"semester":2,"courses":["MATH1102","PHY1102","DME1102","CSE1102","ENG1102","LAR1102","HPED1102"],"electives":[]},{"year":2,"semester":1,"courses":["MATH2101","ECE2101","PCE2101","CSE2101","SOS311"],"electives":[]},{"year":2,"semester":2,"courses":["CSE2202","CSE2206","ECE3204","CSE2208"],"electives":["ELECSE1"]},{"year":3,"semester":1,"courses":["CSE3211","ECE3103","CSE3213","CSE3203"],"electives":["ELECSE01"]},{"year":3,"semester":2,"courses":["CSE3222","CSE3204","CSE3206"],"electives":["ELECSE2","ELECSE2"]},{"year":3,"semester":3,"courses":["CSE3200"],"electives":[]},{"year":4,"semester":1,"courses":["CSE4201","CSE4221"],"electives":["ELECSE02","ELECSE3","ELECSE3","ELECSE3"]},{"year":4,"semester":2,"courses":["CSE4202","CSE4204"],"electives":["ELECSE4","ELECSE4","ELECSE4","ELECSEG1"]},{"year":4,"semester":3,"courses":["CSE4200"],"electives":[]},{"year":5,"semester":1,"courses":["CSE5201","CSE5205"],"electives":["ELECSE5","ELECSE5","ELECSE5","ELECSE03"]},{"year":5,"semester":2,"courses":["CSE5202","SOS412"],"electives":["ELECSEG2","ELECSE6","ELECSE6","ELECSE6"]}]},{"department":"PCE","schedule":[{"year":1,"semester":1,"courses":["MATH1101","PHY1101","CHEM1101","CSE1101","ENG1101","LAR1101","HPED1101"],"electives":[]},{"year":1,"semester":2,"courses":["MATH1102","PHY1102","DME1102","CSE1102","ENG1102","LAR1102","HPED1102"],"electives":[]},{"year":2,"semester":1,"courses":["MATH2101","ECE2101","PCE2101","CSE2101","SOS311"],"electives":[]},{"year":2,"semester":2,"courses":["CEN2201","ECE2204","PCE2206","PCE2208"],"electives":["ELEPCE1"]},{"year":3,"semester":1,"courses":["PCE3201","PCE3203","PCE3207","ECE2202"],"electives":["ELEPCE2"]},{"year":3,"semester":2,"courses":["PCE3202","PCE3204","ECE3204","PCE3206"],"electives":["ELEPCE3","ELEPCE3"]},{"year":3,"semester":3,"courses":["PCE3200"],"electives":[]},{"year":4,"semester":1,"courses":["PCE4201","PCE4203"],"electives":["ELEPCEG1","ELEPCE4","ELEPCE4","ELEPCE01"]},{"year":4,"semester":2,"courses":["PCE4202","PCE4204"],"electives":["ELEPCE5","ELEPCE5","ELEPCE5","ELEPCE02"]},{"year":4,"semester":3,"courses":["PCE4200"],"electives":[]},{"year":5,"semester":1,"courses":["PCE5201","PCE5203","SOS412"],"electives":["ELEPCE6","ELEPCE6","ELEPCE03"]},{"year":5,"semester":2,"courses":["PCE5202"],"electives":["ELEPCE7","ELEPCE7","ELEPCE7","ELEPCEG2"]}]},{"department":"ECE","schedule":[{"year":1,"semester":1,"courses":["MATH1101","PHY1101","CHEM1101","CSE1101","ENG1101","LAR1101","HPED1101"],"electives":[]},{"year":1,"semester":2,"courses":["MATH1102","PHY1102","DME1102","CSE1102","ENG1102","LAR1102","HPED1102"],"electives":[]},{"year":2,"semester":1,"courses":["MATH2101","ECE2101","PCE2101","CSE2101","SOS311"],"electives":[]},{"year":2,"semester":2,"courses":["ECE2202","ECE2204","ECE2206","ECE2208"],"electives":["ELEECE1"]},{"year":3,"semester":1,"courses":["ECE3201","PCE3201","ECE3103","ECE3205"],"electives":["ELEECE2"]},{"year":3,"semester":2,"courses":["ECE3202","ECE3206"],"electives":["ELEECE3","ELEECE4","ELEECE01"]},{"year":3,"semester":3,"courses":["ECE3200"],"electives":[]},{"year":4,"semester":1,"courses":["ECE4201","ECE4203","ECE4209"],"electives":["ELEECE5","ELEECE6","ELEECE02"]},{"year":4,"semester":2,"courses":["ECE4202","SOS412","ECE4204"],"electives":["ELEECEG1","ELEECE7","ELEECE8"]},{"year":4,"semester":3,"courses":["ECE4200"],"electives":[]},{"year":5,"semester":1,"courses":["ECE5201","ECE5225"],"electives":["ELEECE03","ELEECE9","ELEECE10","ELEECE11"]},{"year":5,"semester":2,"courses":["ECE5216"],"electives":["ELEECEG2","ELEECE12","ELEECE13","ELEECE14"]}]}]}');
    }

}
