<?php

namespace models;

use core\database\DbModel;

class Attendance extends DbModel
{
    public string $idUser = '';
    public string $idAssignment = '';

    public function rules(): array
    {
        return [
            'idUser' => [self::RULE_REQUIRE],
            'idAssignment' => [self::RULE_REQUIRE]
        ];
    }

    public function tableName(): string
    {
        return 'attendances';
    }

    public function attributes(): array
    {
        return ['idUser', 'idAssignment'];
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public static function confirmAttendance($idUser, $idAssignment)
    {
        $attendance = Attendance::findOne(['idUser' => $idUser,
            'idAssignment' => $idAssignment]);
        return $attendance != false;
    }


}