<?php

namespace Modules\StaffEvaluation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class EvaluationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call("OthersTableSeeder");
        $item2 = [
            ['target' => 'student','name' => 'To be completed by Students'],
            ['target' => 'collegue','name' => 'To be completed by Colleagues'],
            ['target' => 'head','name' => 'TO BE COMPLETED BY IMMEDIATE SUPERVISOR']
        ];
        foreach ($item2 as $item) {
            \Modules\StaffEvaluation\Entities\Evaluation::create([
                'name' => $item['name'],
                'target' => $item['target'],
            ]);
        }
    }
}
