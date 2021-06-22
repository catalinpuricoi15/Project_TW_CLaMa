<?php

namespace models;

use core\database\DbModel;

class Work extends DbModel
{
    public string $idAssignment = '';
    public string $idUser = '';
    public float $grade = 0.0;
    public mixed $file = '';
    public string $comment = '';

    public function rules(): array
    {
        return [
            'comment' => [self::RULE_REQUIRE],
            'file'  => [self::RULE_REQUIRE]
        ];
    }

    public function tableName(): string
    {
        return 'work';
    }

    public function attributes(): array
    {
        return ['idUser', 'idAssignment', 'file', 'grade', 'comment'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function getGrade(){
        if($this->idUser == '')
            return "Tema netrimisa";
        if($this->grade == 0){
            return "Tema neevaluta";
        }

        return $this->grade;
    }

    public function getStudent(){
        return $this->belongsTo('idUser', User::class);
    }

}