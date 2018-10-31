<?php

namespace App\Widgets\Objects;

class Table {
    
    public $headers;
    public $rows;

    function __construct($args){
        $arg=["headers","rows","actions"];
        foreach ($arg as $a) {
            if(!isset($args[$a])){
                $args[$a] = "";
            }
        }
        foreach ($arg as $a) {
            $this->{$a} = $args[$a];
        }
    }
}
