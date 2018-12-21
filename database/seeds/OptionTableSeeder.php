<?php

use Illuminate\Database\Seeder;

class OptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['code' =>'system_academic', 'value'=> 'active'],
            ['code' =>'system_mms', 'value'=> 'inactive'],
            ['code' =>'system_ses', 'value'=> 'active'],
        ];                          
        foreach ($items as $item) {
           \App\Models\Option::create($item);
        }
    }
}
