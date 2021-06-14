<?php

namespace core\exceptions;

class ForbiddenException extends \Exception
{
    protected $message = 'Nu ai permisiunea sa accesezi aceasta pagina';
    protected $code = 403;
}