<?php

namespace Modules\StaffEvaluation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

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
        // $this->call("OthersTableSeeder");
    }
}
