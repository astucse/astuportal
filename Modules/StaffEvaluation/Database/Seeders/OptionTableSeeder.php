<?php

namespace Modules\StaffEvaluation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Org\Entities\Department;
class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $items = [
            ['code' =>'SES_STUDENT_PERCENT', 'value'=> '50'],
            ['code' =>'SES_COLLEGUE_PERCENT', 'value'=> '15'],
            ['code' =>'SES_HEAD_PERCENT', 'value'=> '35'],
            
            ['code' =>'SES_GOOD_POINT', 'value'=> '4'],
            ['code' =>'SES_BAD_POINT', 'value'=> '2'],
        ];                          
        foreach ($items as $item) {
           \App\Models\Option::create($item);
        }
        foreach (Department::all() as $key => $dep) {
            \App\Models\Option::create(['code' =>'SES_GOOD_REPORT_LETTER', 'value'=> ''.$this->the_value(),'parameter_1'=>''.$dep->id]);
            \App\Models\Option::create(['code' =>'SES_MEDIUM_REPORT_LETTER', 'value'=> ''.$this->the_value(),'parameter_1'=>''.$dep->id]);
            \App\Models\Option::create(['code' =>'SES_BAD_REPORT_LETTER', 'value'=> ''.$this->the_value(),'parameter_1'=>''.$dep->id]);
        }
    }

    private function the_value(){
        return '<p><img alt="ASTU LOGO" src="http://localhost/astuportal/public/images/general/astu-logo" style="float:left; height:50px; width:50px" /><tt>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <samp>Adama Science and Technology Univeristy</samp></tt></p><p><tt><samp>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</samp></tt></p><p><strong>To&nbsp;&nbsp;<ins>&lt;&lt;Instructor&gt;&gt;</ins></strong></p><p>Subject: Evaluation Result of 2nd semester of 2017/18 Academic Year</p><p>As per the university legislation, performance evaluation of every staff member is conducted at the end of each semester. Staffs are evaluated by ...</p><p>The evaluation done by students, colleagues, and department head weight 50%, 15% and 35% respectively. Accordingly, you have been evaluated by the above three entities and the result shows &lt;&lt;Student&gt;&gt;, &lt;&lt;Collegue&gt;&gt; and &lt;&lt;Head&gt;&gt; respectively which results in <strong>&lt;&lt;Result&gt;&gt;</strong> overall performance out of 5 points.</p><p>I would like to congradulate on your result and wish a successful year.</p><p>&nbsp;</p><p>&nbsp;</p>';
    }
}
