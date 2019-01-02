<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(AdminTableSeeder::class);
        // $this->call(StudentTableSeeder::class);
        // $this->call(EmployeeTableSeeder::class);
        // $this->call(RoleTableSeeder::class);
        // $this->call(RoleUserTableSeeder::class);
        // $this->call(OptionTableSeeder::class);
        $this->call(SecretariesSeeder::class);
    }
}
