<?php

namespace models;

use core\database\DbModel;

class Assignment extends DbModel
{
    public string $idClass = '';
    public string $title = '';
    public string $requirement = '';
    public string $deadline = '';
    public string $file = '';
    public string $code_attendance = '';
    public string $attendance_created_at = '';

    public function rules(): array
    {
        return [
            'idClass' => [self::RULE_REQUIRE],
            'title' => [self::RULE_REQUIRE],
            'requirement' => [self::RULE_REQUIRE],
            'deadline' => [self::RULE_REQUIRE],
        ];
    }

    public function labels(): array
    {
        return [
            'title' => 'Titlul temei',
            'requirement' => 'Cerinte',
            'deadline' => 'Termenul final'];
    }

    public function tableName(): string
    {
        return 'assignments';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }
    public function attributes(): array
    {
        return ['idClass', 'title', 'requirement', 'deadline', 'file', 'code_attendance', 'attendance_created_at'];
    }

    public function class(){
        return $this->belongsTo('idClass', ClassForm::class);
    }

    public function getStudentsWork(){
        return $this->belongsToMany(Work::class);
    }

    public static function codeHasExpired($dateCreateAttendance){
        $dateCurent = new \DateTimeImmutable();
        $dateCreateAttendance = (new \DateTimeImmutable($dateCreateAttendance))->modify('+10min');
        return $dateCurent->diff($dateCreateAttendance)->invert == 1;
    }

}