<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class Breadcumb extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'sub-header'=>'?',
        'header' => 'Dashboard',
        'icon' => 'fa fa-dashboard',
        'link0' => '?',
        'link1' => '?',
        'link2' => '?',
        'link3' => '?',
        'link9' => '?',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.breadcumb', [
            'config' => $this->config,
        ]);
    }
}
