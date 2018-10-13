<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class LoginWindow extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'url' => ''
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        //

        return view('widgets.login_window', [
            'config' => $this->config,
        ]);
    }
}
