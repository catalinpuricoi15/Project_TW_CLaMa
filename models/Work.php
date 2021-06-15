<?php

namespace models;

use core\database\DbModel;

class Work extends DbModel
{
    public string $idAssignment = '';
    public string $idUser = '';
    public string $url = '';
    //public string $message = '';

    public function tableName(): string
    {
        return 'work';
    }

    public function attributes(): array
    {
        return ['idUser', 'idAssignment', 'url'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function rules(): array
    {
        return [];
    }


}