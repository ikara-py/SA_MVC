<?php

namespace App\Controllers;

use App\Services\AuthService;

class AuthController extends Controller 
{
    private AuthService $authService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
    }

    public function showLogin(): void
    {
        $this->view('auth/login');
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $user = $this->authService->login($email, $password);

            if ($user) {
                $role = $user->getRole()->getName();
                
                header("Location: /" . ucfirst($role) . "Controller/index");
                exit();
            } else {
                $this->view('auth/login', ['error' => 'Invalid email or password.']);
            }
        }
    }

    public function logout(): void
    {
        $this->authService->logout();
        header('Location: /Home/index');
        exit();
    }

    public function showRegister(): void
    {
        $this->view('auth/register');
    }
    public function register(): void
    {
        echo "test register";
    }

}