<?php


namespace core\form;


use core\Model;

abstract class BaseField
{
    abstract public function renderInput(): string;
    public Model $model;
    public string $attribute;

    public function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }

    public function __toString()
    {
        return sprintf('
        <div>
            %s
            <div class="invalid-feedback">
                   %s
            </div>
        </div>
        ',
            $this->renderInput(),
            $this->model->getFirstError($this->attribute)
        );
    }
}