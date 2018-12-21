<?php

namespace Modules\StaffEvaluation\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        $item1 = [
            'Subject matter',
            'Professional Competence',
            'Time Management',
            'Ethical Competence',
             'Research and Community Services',
            'General Comments'
        ];
        foreach ($item1 as $item) {
            \Modules\StaffEvaluation\Entities\Category::create([
                'name' => $item
            ]);
        }
        // $this->call("OthersTableSeeder");
    }
}
