-- Create patients table
CREATE TABLE patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Create doctors table
CREATE TABLE doctors (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Create admin table
CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

-- Create appointments table
CREATE TABLE appointments (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    doctor_id INT NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending',
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (doctor_id) REFERENCES doctors(id)
);

-- Insert Dummy Doctor
INSERT INTO doctors (name, email, password) VALUES (
    'Dr. Smith', 'drsmith@gmail.com',
    '$2y$10$JcIrb/3t68ZynU6EFke7SuXjVp6TfFdvWBkY2VoPNCkO9rCbsnNw2'
);

-- Insert Dummy Admin
INSERT INTO admin (username, password) VALUES (
    'admin',
    '$2y$10$d34MwIjTQXMw.7C.F6W6F.kEz/VGvnlUeuvUXfFEBymYZ3Of5MHka'
);
