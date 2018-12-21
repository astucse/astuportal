<?php

namespace App\Widgets\Chart;

use Arrilot\Widgets\AbstractWidget;
use Faker\Generator as Faker;
class Bar extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'type' => 'plotly',
        'id' => '1',
        'header' => 'Header Text',
        'value1' => 12,
        'label1' => 'label1',
        'value2' => 21,
        'label2' => 'label2',
        'data' => '',
        'labels' => '',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //
        // $faker = new Faker(); 
        if ($this->config['type']=='plotly') {
            return view('widgets.chart.bar_plotly', [
                'config' => $this->config,
                // 'color' => $faker->randomElement(array ('#4f5bc2','#00a65a','#2ee5d8')),
            ]);
        }else{
            return view('widgets.chart.bar', [
                'config' => $this->config,
                // 'color' => $faker->randomElement(array ('#4f5bc2','#00a65a','#2ee5d8')),
            ]);
        }
    }
}
