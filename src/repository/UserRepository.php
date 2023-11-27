<?php

require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/Repository.php';


class UserRepository extends Repository
{
    public function getUser(string $email)
    {
        $stmt = $this->database->connect()->prepare('
            SELECT * FROM customers WHERE email = :email
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user == false) {
            return false;
        }

        return new User(
            $user['email'],
            $user['passwordhash'],
            $user['firstname'],
            $user['lastname']
        );
    }
}