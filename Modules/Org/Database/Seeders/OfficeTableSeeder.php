<?php

namespace Modules\Org\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Org\Entities\Department;
use Modules\Org\Entities\School;
use Modules\Org\Entities\Office;
class OfficeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();
        foreach (School::all() as $d) {
            Office::create([
                'name' => $d->name,
                'option' => [
                    'institution_type' => 'Org\\School',
                    'institution_id'=> $d->id
                ]
            ]);
        }
        foreach (Department::all() as $d) {
            Office::create([
                'name' => $d->name,
                'option' => [
                    'institution_type' => 'Org\\Department',
                    'institution_id'=> $d->id
                ]
            ]);
        }

        // $this->call("OthersTableSeeder");
    }
}
