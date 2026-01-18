CREATE DATABASE talenthub_db;
USE talenthub_db;

-- Create roles table
CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

-- Create users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100) NOT NULL,
    last_name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role_id INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (role_id) REFERENCES roles(id) ON DELETE RESTRICT
);

-- Insert roles
INSERT INTO roles (name) VALUES ('admin');
INSERT INTO roles (name) VALUES ('candidate');
INSERT INTO roles (name) VALUES ('recruiter');

-- Insert test users
-- password : password
-- Admin User
INSERT INTO users (first_name, last_name, email, password, role_id) 
VALUES ('ali', 'kara', 'admin@talenthub.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 1);