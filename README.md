# TalentHub - Multi-Role Authentication System (MVC)

## Project Context
You are a backend developer at **TalentHub**, a recruitment platform. This project serves as the technical foundation for the entire platform. The primary goal is to build a robust, reusable, and secure **multi-role authentication system** using a custom MVC architecture developed without external frameworks.

> **UI Note:** Currently, the frontend is in a skeleton state. Except for the Login and Sign-up pages, all protected views only display placeholder text (e.g., "This is Dashboard, welcome {user}").

## Key Objectives
- **Custom MVC Architecture:** Implement a "home-made" MVC pattern with a centralized router.
- **Role-Based Access Control (RBAC):** Secure access to specific routes based on user roles (Candidate, Recruiter, Admin).
- **Separation of Concerns:** Clear distinction between Business Logic (Models), Request Handling (Controllers), and Presentation (Views).

## System Roles & Access

| Role | Registration | Access Rights |
| :--- | :--- | :--- |
| **Candidate** | Public | Login, Access to `/candidate/dashboard` |
| **Recruiter** | Public | Login, Access to `/recruiter/dashboard` |
| **Admin** | Private (DB only) | Login, Access to `/admin/back-office` |

## Functional Requirements

### Authentication Flow
- **Registration:** Available for Candidates and Recruiters. Includes data validation (email format, secure password) and automatic role assignment.
- **Login:** Universal login for all roles. Verifies credentials, initializes a PHP session, and redirects to `/{role}/dashboard`.
- **Logout:** Full session destruction and redirection to the login page.
- **Security:** All passwords are encrypted using `password_hash()` and verified via `password_verify()`.

### Route Protection
- **Public Routes:** `/` (Home), `/login`, `/register`.
- **Protected Routes:** Requires active session + authorized role.
    - `/candidate/*` -> Only for Candidates.
    - `/recruiter/*` -> Only for Recruiters.
    - `/admin/*` -> Only for Admins.
- **Unauthorized Access:** If a user is not logged in or lacks the required role, they are redirected to a `403 Access Denied` page or the login screen.

## Implementation Rules
- **Single Entry Point:** All requests must pass through `public/index.php`.
- **MVC Flow:** `index.php` → `Router` → `Controller` → `Model` (Data) → `View`.
- **Database Safety:** Mandatory use of **PDO** with **prepared statements** to prevent SQL injection.
- **Logic Isolation:** - No SQL queries inside Controllers (use Models).
    - No business logic or SQL inside Views.
    - No hardcoded roles in views (fetch from Database).

## Required Documentation (UML)
Before coding, the following diagrams are required:
1. **Use Case Diagram:** Mapping interactions for Registration, Login, Dashboard access, and Logout.
2. **Class Diagram:** Modeling the `User` and `Role` entities, their relationships, and core methods (e.g., `authenticate()`, `hasRole()`).

## Security Checklist
- Password hashing with `password_hash()`.
- Session validation on every protected route.
- Input validation (REGEX for email/passwords).
- Prevention of direct file access (Routing logic).
- Clean error messaging (no sensitive DB info exposed).

## Getting Started
1. Configure your local server (Apache/Nginx) to point to the `public/` directory.
2. Import the database schema (to be created based on the UML Class Diagram).
3. Update database credentials in the configuration file.
4. Access `index.php` to start the application flow.

## Monetor
**Soufiane Isam**

## Coded by
**Kara Ali**