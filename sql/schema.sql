CREATE DATABASE health_app;

USE health_app;

CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(50) NOT NULL,
  password VARCHAR(255) NOT NULL
);

CREATE TABLE diagnoses (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  symptom VARCHAR(100),
  diagnosis_result TEXT,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id)
);