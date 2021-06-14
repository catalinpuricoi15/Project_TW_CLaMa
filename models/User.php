<?php

namespace models;

use core\UserModel;

class User extends UserModel
{

    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
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
            'password' => [self::RULE_REQUIRE, [self::RULE_MIN, 'min' =>5]],
            'confirmPassword' => [self::RULE_REQUIRE, [self::RULE_MATCH, 'match' => 'password']],
            'type' => [self::RULE_REQUIRE]
            ];
    }

    public function attributes(): array
    {
        return ['username', 'email', 'password', 'type'];
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

    public function isStudent(): bool{
        return $this->type == 'student';
    }

}