<?php

namespace models;

use core\database\DbModel;
use core\Model;

class Catalog extends Model
{
    public string $idClass = '';
    public array $students = [];
    public array $assignments = [];

    public function rules(): array
    {
        return [
            'idClass' => [self::RULE_REQUIRE],
        ];
    }

    public function class(){
        return ClassForm::findOne(['id' => $this->idClass]);
    }


}