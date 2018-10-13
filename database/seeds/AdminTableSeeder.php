<?php

use Illuminate\Database\Seeder;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            [
                'email' => 'admin@astuportal.net' ,
                'type' => 'super', 
                'name'=> 'Super Admin', 
                'password'=> '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm'
            ],
        ];
        foreach ($items as $item) {
           \App\Models\Admin::create($item);
        }
    }
}
