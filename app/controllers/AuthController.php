<?php

namespace App\Controllers;

use App\Services\AuthService;
use App\Services\RegistrationService;

class AuthController extends Controller 
{
    private AuthService $authService;
    private RegistrationService $registrationService;

    public function __construct()
    {
        parent::__construct();
        $this->authService = new AuthService();
        $this->registrationService = new RegistrationService();
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
                header("Location: " . url(strtolower($role) . "/index"));
                exit();
            } else {
                $this->view('auth/login', ['error' => 'Invalid email or password.']);
            }
        } else {
            $this->showLogin();
        }
    }

    public function logout(): void
    {
        $this->authService->logout();
        header('Location: ' . url(''));
        exit();
    }

    public function showRegister(): void
    {
        $this->view('auth/register');
    }
    
    public function register(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $firstName = trim($_POST['first_name'] ?? '');
            $lastName = trim($_POST['last_name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $role = $_POST['role'] ?? '';
            $errors = [];

            if (empty($firstName)) {
                $errors[] = 'First name is required.';
            }

            if (empty($lastName)) {
                $errors[] = 'Last name is required.';
            }

            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = 'Valid email is required.';
            }

            if (strlen($password) < 8) {
                $errors[] = 'Password must be at least 8 characters.';
            }

            if ($password !== $confirmPassword) {
                $errors[] = 'Passwords do not match.';
            }

            if (empty($role) || !in_array($role, ['candidate', 'recruiter'])) {
                $errors[] = 'Please select a valid role.';
            }
            if (!empty($errors)) {
                $this->view('auth/register', [
                    'error' => implode(' ', $errors),
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email,
                    'role' => $role
                ]);
                return;
            }
            $result = $this->registrationService->register(
                $firstName,
                $lastName,
                $email,
                $password,
                $role
            );

            if ($result['success']) {
                $this->view('auth/login', [
                    'success' => 'Registration successful! Please login.'
                ]);
            } else {
                $this->view('auth/register', [
                    'error' => $result['message'],
                    'first_name' => $firstName,
                    'last_name' => $lastName,
                    'email' => $email,
                    'role' => $role
                ]);
            }
        } else {
            $this->showRegister();
        }
    }
}