<?php

namespace Modules\Academic\Database\Seeders;

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
            // ['code' =>'Academic_year', 'value'=> '2011'],
            // ['code' =>'Academic_semester', 'value'=> '1'],
            ['code' =>'Academic_curriculum', 'value'=> 'INITIAL'],
        ];                          
        foreach ($items as $item) {
           \App\Models\Option::create($item);
        }
        // $this->call("OthersTableSeeder");
    }
}
