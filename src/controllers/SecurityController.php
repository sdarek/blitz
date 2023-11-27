<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/User.php';
require_once __DIR__.'/../repository/UserRepository.php';

class SecurityController extends AppController
{
    public function login(){

        $userRepository = new UserRepository();
        if (!$this->isPost()) {
            return $this->render('home');
        }

        $email = $_POST["email"];
        $password = $_POST["password"];

        $user = $userRepository->getUser($email);
        if(!$user){
            $response = ['success' => false, 'message' => 'Użytkownik nie istnieje'];
        }
        else {
            #if (password_verify($password, $user->getPassword())) {
            if ($user->getPassword() === $password) {
                $response = ['success' => true];
            } else {
                $response = ['success' => false, 'message' => 'Błąd logowania. Sprawdź dane.'];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);


        #$url = "http://$_SERVER[HTTP_HOST]";
        #header("Location: {$url}/shop");
    }

    public function register(){
        // Pobranie danych z formularza rejestracji
        $email = $_POST["register-email"];
        $password = $_POST["register-password"];
        $name = $_POST["register-name"];
        $surname = $_POST["register-surname"];

        // Tutaj można dodać logikę sprawdzającą poprawność danych, walidację, itp.
        // Na potrzeby tego przykładu zakładamy prostą logikę - rejestracja zawsze powiedzie się

        // Przykładowa logika: Utworzenie obiektu User na podstawie przekazanych danych
        //$user = new User($email, $password, $name, $surname);

        // Tutaj można dodać logikę zapisu nowego użytkownika do bazy danych, itp.

        // Przykładowa odpowiedź - zakładamy, że rejestracja zawsze się udaje
        $response = ['success' => true];

        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
}