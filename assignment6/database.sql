-- Bincom Academy - Assignment 6: Student Records
-- Import this file in phpMyAdmin (or the MySQL CLI) before opening the app.

CREATE DATABASE IF NOT EXISTS bincom_students
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE bincom_students;

DROP TABLE IF EXISTS students;

CREATE TABLE students (
    id            INT UNSIGNED NOT NULL AUTO_INCREMENT,
    reg_no        VARCHAR(20)  NOT NULL,
    first_name    VARCHAR(50)  NOT NULL,
    last_name     VARCHAR(50)  NOT NULL,
    email         VARCHAR(100) NOT NULL,
    phone         VARCHAR(20)  NOT NULL,
    gender        ENUM('Male', 'Female', 'Other') NOT NULL,
    date_of_birth DATE         NOT NULL,
    department    VARCHAR(100) NOT NULL,
    level         VARCHAR(20)  NOT NULL,
    created_at    TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id),
    UNIQUE KEY uniq_reg_no (reg_no),
    UNIQUE KEY uniq_email (email)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dummy students so the list and search have something to show
INSERT INTO students
    (reg_no, first_name, last_name, email, phone, gender, date_of_birth, department, level)
VALUES
    ('BIN/CS/001', 'Chinedu',  'Okafor',   'chinedu.okafor@example.com',   '+234 801 234 5601', 'Male',   '2002-03-14', 'Computer Science',      '300'),
    ('BIN/CS/002', 'Aisha',    'Bello',    'aisha.bello@example.com',      '+234 802 345 6702', 'Female', '2003-07-22', 'Computer Science',      '200'),
    ('BIN/SE/003', 'Tunde',    'Adeyemi',  'tunde.adeyemi@example.com',    '+234 803 456 7803', 'Male',   '2001-11-05', 'Software Engineering',  '400'),
    ('BIN/SE/004', 'Ngozi',    'Eze',      'ngozi.eze@example.com',        '+234 805 567 8904', 'Female', '2002-01-30', 'Software Engineering',  '300'),
    ('BIN/IT/005', 'Emeka',    'Nwosu',    'emeka.nwosu@example.com',      '+234 806 678 9005', 'Male',   '2004-09-18', 'Information Technology', '100'),
    ('BIN/IT/006', 'Fatima',   'Yusuf',    'fatima.yusuf@example.com',     '+234 807 789 0106', 'Female', '2003-04-12', 'Information Technology', '200'),
    ('BIN/CY/007', 'Segun',    'Balogun',  'segun.balogun@example.com',    '+234 808 890 1207', 'Male',   '2000-12-01', 'Cyber Security',        '500'),
    ('BIN/CY/008', 'Blessing', 'Etim',     'blessing.etim@example.com',    '+234 809 901 2308', 'Female', '2004-06-25', 'Cyber Security',        '100'),
    ('BIN/DS/009', 'Ibrahim',  'Musa',     'ibrahim.musa@example.com',     '+234 810 012 3409', 'Male',   '2001-08-09', 'Data Science',          '400'),
    ('BIN/DS/010', 'Temitope', 'Ajayi',    'temitope.ajayi@example.com',   '+234 811 123 4510', 'Female', '2002-10-17', 'Data Science',          '300');
