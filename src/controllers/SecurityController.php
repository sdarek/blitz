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
                session_start();
                $_SESSION['user_id'] = $user->getId();
                $_SESSION['email'] = $user->getEmail();
                $_SESSION['role'] = $user->getRole();
                $_SESSION['name'] = $user->getName();
                $userData = ['id' => $user->getId(),
                            'email' => $user->getEmail(),
                            'name' => $user->getName(),
                            'surname' => $user->getSurname(),
                            'role' => $user->getRole()
                ];
                $response = [
                    'success' => true,
                    'user_data' => $userData
                    ];
            } else {
                $response = ['success' => false, 'message' => 'Błąd logowania. Sprawdź dane.'];
            }
        }

        header('Content-Type: application/json');
        echo json_encode($response);
    }

    public function register(){
        $userRepository = new UserRepository();

        $email = $_POST["register-email"];
        $password = $_POST["register-password"];
        $name = $_POST["register-name"];
        $surname = $_POST["register-surname"];

        $user = $userRepository->registerUser($email, $password, $name, $surname);

        session_start();
        $_SESSION['user_id'] = $user->getId();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['role'] = $user->getRole();
        $_SESSION['name'] = $user->getName();
        $userData = ['id' => $user->getId(),
            'email' => $user->getEmail(),
            'name' => $user->getName(),
            'surname' => $user->getSurname(),
            'role' => $user->getRole()
        ];
        $response = ['success' => true,
            'user_data' => $userData
        ];
        header('Content-Type: application/json');
        echo json_encode($response);
    }
    
}