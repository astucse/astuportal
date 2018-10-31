<?php

namespace App\Widgets;

use Arrilot\Widgets\AbstractWidget;

class AdminTableList extends AbstractWidget
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
        'paging'       => 'true',
        'lengthChange' => 'false',
        'searching'    => 'true',
        'ordering'     => 'true',
        'info'         => 'true',
        'autoWidth'    => 'true',
        'table' => '',
        'format' => 2,
        'model' => "",
    ];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run(){
        //
        if($this->config['format']==2){
            // $this->config['table']->headers = $this->config['model'][0]->get()[0]->getFillable();
            $this->config['table']->table_attributes = $this->config['model'][0]->get()[0]->table_attributes;
            $this->config['table']->table_attribute_relations = $this->config['model'][0]->get()[0]->table_attribute_relations;
            // return $this->config['table']->headers[0];
        }
        return view('widgets.admin_table_list', [
            'config' => $this->config,
        ]);
    }
}





