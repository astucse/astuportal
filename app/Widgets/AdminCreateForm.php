<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class AdminCreateForm extends AbstractWidget
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [
        'count' => 3,
        'name' => 'what',
        'action' => '#',
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run($fields)
    {
        //

        return view('widgets.admin_create_form', [
            'config' => $this->config,
            'fields' => $fields
        ]);
    }
}
