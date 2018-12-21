<?php

namespace Modules\Academic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class CurriculumTableSeeder extends Seeder
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
            ['version' =>1, 'name'=> 'Initial Curriculum'],
        ];                          
        foreach ($items as $item) {
            // Curriculum::create($item);
            \Modules\Academic\Entities\Curriculum::create($item);
        }
        // $this->call("OthersTableSeeder");
    }
}
