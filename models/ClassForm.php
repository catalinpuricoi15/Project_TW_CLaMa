<?php

namespace models;

use core\database\DbModel;

class ClassForm extends DbModel
{
    public string $subject = '';
    public string $idUser = '';
    public string $code = '';
    public int $numberOfAssignments = 0;

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRE],
            'idUser' => [self::RULE_REQUIRE],
            'numberOfAssignments' => [self::RULE_REQUIRE]
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Numele cursului',
            'numberOfAssignments' => 'Numarul de note necesare'
        ];
    }

    public function tableName(): string
    {
        return 'classes';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }
    public function attributes(): array
    {
        return ['subject', 'idUser', 'code', 'numberOfAssignments'];
    }

    public function getNrAssignments(){
        return $this->numberOfAssignments;
    }

    public function owner(){
        return $this->belongsTo('idUser', User::class);
    }

}