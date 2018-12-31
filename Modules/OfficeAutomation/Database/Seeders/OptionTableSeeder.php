<?php

namespace Modules\OfficeAutomation\Database\Seeders;

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
            [
                // 'code' =>'OA_LETTER_CATEGORIES','value'=>'', 'list'=> [
                //     ["code"=>"001","name"=>"School Dean"],
                //     ["code"=>"002","name"=>"Associate dean of academic affairs"],
                //     ["code"=>"003","name"=>"Associate dean of research affairs"],
                //     ["code"=>"004","name"=>"School registrar"],
                //     ["code"=>"005","name"=>"Student Affairs"],
                //     ["code"=>"006","name"=>"Continuous and distance"],
                //     ["code"=>"007","name"=>"Student cases"],
                //     ["code"=>"008","name"=>"Staff"],
                //     // ["code"=>"009","name"=>""],
                //     ["code"=>"010","name"=>"Committees"],
                //     ["code"=>"016","name"=>"other"],
                // ],
                []
            ],
        ];                          
        foreach ($items as $item) {
           \App\Models\Option::create($item);
        }
    }
}
