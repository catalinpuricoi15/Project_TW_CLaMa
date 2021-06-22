<?php

namespace core\form;

use core\Application;
use core\database\DbModel;
use core\Model;

class InputField extends BaseField
{
    public const TYPE_TEXT = 'text';
    public const TYPE_PASSWORD = 'password';
    public const TYPE_DATE = 'date';
    public const TYPE_FILE = 'file';

    public string $type;

    public function __construct(Model $model, string $attribute)
    {
        $this->type = self::TYPE_TEXT;
        parent::__construct($model, $attribute);
    }


    public function passwordField()
    {
        $this->type = self::TYPE_PASSWORD;
        return $this;
    }

    public function dateField()
    {
        $this->type = self::TYPE_DATE;
        return $this;
    }

    public function fileField()
    {
        $this->type = self::TYPE_FILE;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf('<input type="%s" name="%s" placeholder="%s" class="input-field">',
            $this->type,
            $this->attribute,
            $this->model->getLabel($this->attribute)
        );
    }


}