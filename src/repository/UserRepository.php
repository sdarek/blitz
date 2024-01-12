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

        if (!$user) {
            return false;
        }

        return new User(
            $user['email'],
            $user['passwordhash'],
            $user['firstname'],
            $user['lastname'],
            $user['customerid'],
            $user['role']
        );
    }
    public function registerUser( $email,  $password,  $name,  $surname)
    {
        if ($this->userExists($email)) {
            return false; // Użytkownik już istnieje, zwróć false
        }
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->database->connect()->prepare('
            INSERT INTO customers (email, passwordhash, firstname, lastname, shippingaddress, phonenumber, role)
            VALUES (:email, :password, :firstname, :lastname, null, null, :role)
        ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(':firstname', $name, PDO::PARAM_STR);
        $stmt->bindParam(':lastname', $surname, PDO::PARAM_STR);
        $stmt->bindValue(':role', 'user', PDO::PARAM_STR);
        $stmt->execute();
        $user = $this->getUser($email);
        return $user;
    }

    private function userExists(string $email): bool
    {
        $stmt = $this->database->connect()->prepare('
        SELECT * FROM customers WHERE email = :email
    ');
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC) !== false;
    }
}