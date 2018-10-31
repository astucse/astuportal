<?php

namespace App\Widgets;

class FormField {
    
    public $label;
    public $name;
    public $category;
    public $value;
    public $type;
    public $placeholder;
    public $cols;
    public $rows;
    public $children;

    function __construct($args){
        $arg=["label","name","category","type","placeholder","cols","rows","value","children","disabled"];
        $arg2=["","","","","","1","1","","[]",false];
        foreach ($arg as $k=>$a) {
            if(!isset($args[$a])){
                $args[$a] = $arg2[$k];
            }
        }
        foreach ($arg as $a) {
            if(!$args[$a]===false)
                $this->{$a} = $args[$a];
        }
    }
    private function hehe($thing,$thing2=null){
        if(isset($thing)){
            return $thing;
        }
        if($thing2==null){
            return "";
        }
        return $thing2;
    }
    // function __construct($label = "" , $name = "",  $category =  "",  $type =  "", $placeholder = "" , $cols = 1, $rows = 1,$value="",$children=[]){
    //     $this->label = $label;
    //     $this->name = $name;
    //     $this->category = $category;
    //     $this->type = $type;
    //     $this->placeholder = $placeholder;
    //     $this->cols = $cols;
    //     $this->rows = $rows;
    //     $this->value = $value;
    //     $this->children = $children;
    // }
    
}
