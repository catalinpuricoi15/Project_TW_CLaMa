<?php

namespace core\form;
use core\Model;
use core\form\InputField;

class Form{

    public static function begin($action, $method, $id)
    {
        echo sprintf('<form action = "%s" method="%s" id = "%s" enctype="multipart/form-data">', $action, $method, $id);
        return new Form();
    }

    public static function end(){
        return '</form>';
    }

    public function field(Model $model, $attribute){
        return new InputField($model, $attribute);
    }
}