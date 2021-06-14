<?php

namespace models;

use core\Application;
use core\Model;

class LoginForm extends Model
{
    public string $email = '';
    public string $password = '';

    public function rules(): array
    {
        return [
            'email' => [self::RULE_REQUIRE, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRE]
        ];
    }

    public function login()
    {
        $user = User::findOne(['email' => $this->email]);
        if (!$user) {
            $this->addError('email', 'Utilizatorul nu exista');
            return false;
        }

        if (!password_verify($this->password, $user->password)) {
            $this->addError('password','Parola este incorecta');
            return false;
        }

        return Application::$app->login($user);

    }

}