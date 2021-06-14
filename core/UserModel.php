<?php

namespace core;

use core\database\DbModel;

abstract class UserModel extends DbModel
{
    abstract public function getDisplayUsername(): string;
    abstract public function getDisplayType(): string;
    abstract public function isStudent(): bool;
}