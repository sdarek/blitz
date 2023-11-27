<?php

namespace repository;
require_once __DIR__.'/../models/User.php';

use repository\Repository;

class UserRepository extends Repository
{
    public function getUser(string $email): User
    {
        //TODO
    }
}