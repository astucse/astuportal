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
        ];                          
        foreach ($items as $item) {
           \App\Models\Option::create($item);
        }
    }
}
