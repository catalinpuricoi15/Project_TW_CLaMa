<?php

namespace models;

use core\UserModel;

class User extends UserModel
{

    public string $username = '';
    public string $email = '';
    public string $firstname = '';
    public string $lastname = '';
    public string $password = '';
    public string $confirmPassword = '';
    public string $city = '';
    public string $adress = '';
    public string $type = '';

    public function tableName(): string
    {
        return 'users';
    }

    public static function primaryKey(): string
    {
        return 'id';
    }

    public function save()
    {
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }

    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRE, [self::RULE_UNIQUE, 'class' => self::class]],
            'email' => [self::RULE_REQUIRE, self::RULE_EMAIL, [self::RULE_UNIQUE, 'class' => self::class]],
            'firstname' => [self::RULE_REQUIRE],
            'lastname' => [self::RULE_REQUIRE],
            'password' => [self::RULE_REQUIRE, [self::RULE_MIN, 'min' => 5]],
            'confirmPassword' => [self::RULE_REQUIRE, [self::RULE_MATCH, 'match' => 'password']],
            'type' => [self::RULE_REQUIRE]
        ];
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password', 'type', 'firstname', 'lastname', 'city', 'adress'];
    }

    public function labels(): array
    {
        return [
            'username' => 'Username',
            'firstname' => 'Prenumele',
            'lastname' => 'Numele',
            'email' => 'Email',
            'password' => 'Parola',
            'confirmPassword' => 'Confirma parola',
        ];
    }

    public function getDisplayUsername(): string
    {
        return $this->username;
    }

    public function getDisplayType(): string
    {
        return $this->type;
    }

    public function isStudent(): bool
    {
        return $this->type == 'student';
    }

    public function getFullName()
    {
        return $this->firstname . ' ' . $this->lastname;
    }

    public function getStudentWork()
    {
        return $this->belongsToMany(Work::class);
    }

    public function getStudentWorkForAssignment($idAssignment)
    {
        $grade = null;
        foreach ($this->getStudentWork() as $work){
            if($work->idAssignment == $idAssignment)
                $grade = $work;
        }

        if ($grade != null) {
            return $grade;
        } else {
            return new Work();
        }

    }

}