<?php

namespace core\exceptions;

class NotFoundException extends \Exception
{
    protected $message = 'Pagina nu a fost gasita';
    protected $code = 404;
}