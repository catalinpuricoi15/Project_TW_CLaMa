<?php


namespace models;

use core\database\DbModel;

class Request extends DbModel
{
    public string $idUser = '';
    public string $idClass = '';

    public function rules(): array
    {
        return [
            'idUser' => [self::RULE_REQUIRE],
            'idClass' => [self::RULE_REQUIRE],
        ];
    }

    public function assignment()
    {
        return $this->render('profesori/requests');
    }

    public function tableName(): string
    {
        return 'requests';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function attributes(): array
    {
        return ['idUser', 'idClass'];
    }

    public static function isValid($code){
        $class = ClassForm::findOne(['code' => $code]);
        return $class != false;
    }

    public function getStudent(){
        return $this->belongsTo('idUser', User::class);
    }

}