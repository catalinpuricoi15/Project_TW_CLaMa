<?php

namespace core\form;

class TextareaField extends  BaseField
{
    public function renderInput(): string
    {
        return sprintf('<textarea name=%s" class="form-control">%s</textarea>',
        $this->attribute,
        $this->model->{$this->attribute},
        );
    }

}