<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class SillyPack extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'bootstrap3-wysihtml5' => false,
        'ckeditor' => false,
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.silly_pack', [
            'config' => $this->config,
        ]);
    }
}
