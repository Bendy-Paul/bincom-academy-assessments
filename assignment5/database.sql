-- Bincom Academy - Assignment 5: ToDo App
-- Import this file in phpMyAdmin before opening the app.

CREATE DATABASE IF NOT EXISTS bincom_todo
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE bincom_todo;

DROP TABLE IF EXISTS tasks;

CREATE TABLE tasks (
    id         INT UNSIGNED NOT NULL AUTO_INCREMENT,
    title      VARCHAR(255) NOT NULL,
    is_done    TINYINT(1) NOT NULL DEFAULT 0,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Optional example tasks
INSERT INTO tasks (title) VALUES
    ('Buy groceries'),
    ('Finish assignment 5'),
    ('Call mum');
