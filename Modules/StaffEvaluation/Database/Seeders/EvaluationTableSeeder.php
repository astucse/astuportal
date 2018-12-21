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
            ['target' => 'student','name' => 'Instructor 1'],
            ['target' => 'collegue','name' => 'Instructor 1'],
            ['target' => 'head','name' => 'Instructor 1']
        ];
        foreach ($item2 as $item) {
            \Modules\StaffEvaluation\Entities\Evaluation::create([
                'name' => $item['name'],
                'target' => $item['target'],
            ]);
        }
    }
}
