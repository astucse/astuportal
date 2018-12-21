<?php

namespace Modules\Academic\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class ElectiveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

        Model::unguard();
        $json = $this->hehe();
        foreach ($json->body as $elective) {
            if(!isset($elective->type))
                $elective->type = 'mandatory';
            if(!isset($elective->code))
                $elective->code = $elective->name;
            \Modules\Academic\Entities\Elective::create([
                'options' => 1,
                'crhr' => 3,
                'courses' => implode(",", $elective->courses),
                'type' => $elective->type,
                'code' => $elective->code,
            ]);
        }

        
    }


    


    public function hehe(){
        return json_decode('{"body":[{"code":"ELEASTU1","name":"Free Elective","courses":[],"description":"You can select any courses"},{"code":"ELEASTU2","name":"General Elective","courses":[],"description":"You should select one of the social science courses"},{"code":"ELEASTU3","name":"ELECTIVE","courses":[],"description":"Coming Soon"},{"code":"ELECSE01","name":"Free Elective 1","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELECSE02","name":"Free Elective 2","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELECSE03","name":"Free Elective 3","courses":[],"description":"You can select any courses","type":"free"},{"name":"ELECSE1","courses":["CSE2320","ECE2202","CSE2310"]},{"name":"ELECSE2","courses":["CSE3306","CSE3308","CSE3314","CSE3312","CSE4304"]},{"name":"ELECSE3","courses":["CSE4303","CSE4307","CSE4309","CSE4311","ECE2204","CSE5317","CSE5321"]},{"name":"ELECSE4","courses":["CSE4310","ECE3205","ECE5307","CSE5306","PCE3201","CSE4312"]},{"name":"ELECSE5","courses":["CSE5307","CSE5309","CSE5311","CSE5313","CSE5315","CSE5319","PCE3204"]},{"name":"ELECSE6","courses":["CSE5304","CSE5308","CSE5310","CSE5312","PCE5308"]},{"name":"ELECSEG1","courses":["LAR3032","LAR4022","LAR3042","ENG2031","SOS362","SOS372","SOS313"]},{"name":"ELECSEG2","courses":["LAR3032","LAR4022","LAR3042","ENG2031","SOS362","SOS372","SOS313"]},{"code":"ELEECE01","name":"Free Elective 1","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELEECE02","name":"Free Elective 2","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELEECE03","name":"Free Elective 3","courses":[],"description":"You can select any courses","type":"free"},{"name":"ELEECE1","courses":["CEN2201","CSE3207","PHY3301"]},{"name":"ELEECE2","courses":["PCE3207","CSE2202"]},{"name":"ELEECE3","courses":["PCE3202","PCE3203"]},{"name":"ELEECE4","courses":["PCE3204","PCE4203"]},{"name":"ELEECE5","courses":["ECE4307","ECE4309"]},{"name":"ELEECE6","courses":["ECE4311","ECE4313"]},{"name":"ELEECEG1","courses":["LAR4222","SOS411"]},{"name":"ELEECE7","courses":["ECE4306","ECE4308"]},{"name":"ELEECE8","courses":["ECE4310","ECE4315","ECE4314"]},{"name":"ELEECE9","courses":["ECE5307","ECE5309","ECE5311","ECE5313"]},{"name":"ELEECE10","courses":["PCE5308","ECE5315","ECE5317","CSE5319"]},{"name":"ELEECE11","courses":["ECE5319","ECE5321","PCE4204"]},{"name":"ELEECEG2","courses":["DME4101","SOS313"]},{"name":"ELEECE12","courses":["ECE5302","ECE5316"]},{"name":"ELEECE13","courses":["ECE5306","CSE5307","ECE5308"]},{"name":"ELEECE14","courses":["ECE5310","ECE5312"]},{"code":"ELEPCE01","name":"Free Elective 1","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELEPCE02","name":"Free Elective 2","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELEPCE03","name":"Free Elective 3","courses":[],"description":"You can select any courses","type":"free"},{"name":"ELEPCE1","courses":["ECE3103","PHY3301"]},{"name":"ELEPCE2","courses":["TAE3305","CSE3207"]},{"name":"ELEPCE3","courses":["PCE3302","ECE3205","PCE3304"]},{"name":"ELEPCE4","courses":["PCE4301","PCE4303","PCE4305","PCE4307","ECE4201"]},{"name":"ELEPCEG1","courses":["SOS411","LAR4022"]},{"name":"ELEPCE5","courses":["PCE4302","PCE4306","PCE4308","ECE3202","CSE2202"]},{"name":"ELEPCE6","courses":["PCE5301","PCE5303","PCE5305","PCE5307","PCE5315","PCE5321","PCE5319"]},{"name":"ELEPCEG2","courses":["DME4101","LAR3052"]},{"name":"ELEPCE7","courses":["PCE5302","PCE5306","PCE5312","PCE5308","PCE5304","PCE5314","PCE5316","PCE5318"]}]}');
    }




    // public function hehe2(){
    //     return json_decode('{"body":[{"code":"ELEASTU1","name":"Free Elective","courses":[],"description":"You can select any courses"},{"code":"ELEASTU2","name":"General Elective","courses":[],"description":"You should select one of the social science courses"},{"code":"ELEASTU3","name":"ELECTIVE","courses":[],"description":"Coming Soon"},{"code":"ELECSE01","name":"Free Elective 1","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELECSE02","name":"Free Elective 2","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELECSE03","name":"Free Elective 3","courses":[],"description":"You can select any courses","type":"free"},{"name":"ELECSE1","courses":["CSE2320","ECE2202","CSE2310"]},{"name":"ELECSE2","courses":["CSE3306","CSE3308","CSE3314","CSE3312","CSE4304"]},{"name":"ELECSE3","courses":["CSE4303","CSE4307","CSE4309","CSE4311","ECE2204","CSE5317","CSE5321"]},{"name":"ELECSE4","courses":["CSE4310","ECE3205","ECE5307","CSE5306","PCE3201","CSE4312"]},{"name":"ELECSE5","courses":["CSE5307","CSE5309","CSE5311","CSE5313","CSE5315","CSE5319","PCE3204"]},{"name":"ELECSE6","courses":["CSE5304","CSE5308","CSE5310","CSE5312","PCE5308"]},{"name":"ELECSEG1","courses":["LAR3032","LAR4022","LAR3042","ENG2031","SOS362","SOS372","SOS313"]},{"name":"ELECSEG2","courses":["LAR3032","LAR4022","LAR3042","ENG2031","SOS362","SOS372","SOS313"]}]}');
    // }

    // public function hehe3(){
    //     return json_decode('{"body":[{"code":"ELEECE01","name":"Free Elective 1","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELEECE02","name":"Free Elective 2","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELEECE03","name":"Free Elective 3","courses":[],"description":"You can select any courses","type":"free"},{"name":"ELEECE1","courses":["CEN2201","CSE3207","PHY3301"]},{"name":"ELEECE2","courses":["PCE3207","CSE2202"]},{"name":"ELEECE3","courses":["PCE3202","PCE3203"]},{"name":"ELEECE4","courses":["PCE3204","PCE4203"]},{"name":"ELEECE5","courses":["ECE4307","ECE4309"]},{"name":"ELEECE6","courses":["ECE4311","ECE4313"]},{"name":"ELEECEG1","courses":["LAR4222","SOS411"]},{"name":"ELEECE7","courses":["ECE4306","ECE4308"]},{"name":"ELEECE8","courses":["ECE4310","ECE4315","ECE4314"]},{"name":"ELEECE9","courses":["ECE5307","ECE5309","ECE5311","ECE5313"]},{"name":"ELEECE10","courses":["PCE5308","ECE5315","ECE5317","CSE5319"]},{"name":"ELEECE11","courses":["ECE5319","ECE5321","PCE4204"]},{"name":"ELEECEG2","courses":["DME4101","SOS313"]},{"name":"ELEECE12","courses":["ECE5302","ECE5316"]},{"name":"ELEECE13","courses":["ECE5306","CSE5307","ECE5308"]},{"name":"ELEECE14","courses":["ECE5310","ECE5312"]},{"code":"ELEPCE01","name":"Free Elective 1","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELEPCE02","name":"Free Elective 2","courses":[],"description":"You can select any courses","type":"free"},{"code":"ELEPCE03","name":"Free Elective 3","courses":[],"description":"You can select any courses","type":"free"},{"name":"ELEPCE1","courses":["ECE3103","PHY3301"]},{"name":"ELEPCE2","courses":["TAE3305","CSE3207"]},{"name":"ELEPCE3","courses":["PCE3302","ECE3205","PCE3304"]},{"name":"ELEPCE4","courses":["PCE4301","PCE4303","PCE4305","PCE4307","ECE4201"]},{"name":"ELEPCEG1","courses":["SOS411","LAR4022"]},{"name":"ELEPCE5","courses":["PCE4302","PCE4306","PCE4308","ECE3202","CSE2202"]},{"name":"ELEPCE6","courses":["PCE5301","PCE5303","PCE5305","PCE5307","PCE5315","PCE5321","PCE5319"]},{"name":"ELEPCEG2","courses":["DME4101","LAR3052"]},{"name":"ELEPCE7","courses":["PCE5302","PCE5306","PCE5312","PCE5308","PCE5304","PCE5314","PCE5316","PCE5318"]}]}');
    // }
}
