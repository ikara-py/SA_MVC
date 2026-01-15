CREATE DATABASE talenthub_db;
USE talenthub_db;

CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL UNIQUE
);

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

INSERT INTO roles (name) VALUES ('admin');
INSERT INTO roles (name) VALUES ('candidate');
INSERT INTO roles (name) VALUES ('recruiter');

-- Email: admin@talenthub.com | Password: password
INSERT INTO users (first_name, last_name, email, password, role_id) 
VALUES ('Ali', 'Kara', 'admin@test.com', '$2y$12$bkfGxxjVItNxcbGp1o8AAex6E8/hN09Kl17DKIFSbWJNWygTyw/X2', 1);