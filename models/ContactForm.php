<?php

namespace models;

use core\Model;

class ContactForm extends  Model{
    public string $subject = '';
    public string $email = '';
    public string $body = '';

    public function rules(): array
    {
        return [
            'subject' => [self::RULE_REQUIRE],
            'email' => [self::RULE_REQUIRE],
            'body' => [self::RULE_REQUIRE],
        ];
    }

    public function labels(): array
    {
        return [
            'subject' => 'Subiectul',
            'email' => 'Emailul',
            'body' => 'Body',
        ];
    }
}