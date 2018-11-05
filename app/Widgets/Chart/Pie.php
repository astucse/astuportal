<?php

namespace App\Widgets\Chart;

use Arrilot\Widgets\AbstractWidget;
use Faker\Factory as Faker;
class Pie extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    // private $r = rand(); 
    // public $faker = \Faker::create();
    protected $config = [
        'id' => '1',
        'header' => 'Header Text'
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(){
        //

        return view('widgets.chart.pie', [
            'config' => $this->config,
        ]);
    }
}
