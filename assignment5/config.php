<?php
/**
 * Database configuration for the ToDo application (Assignment 5).
 *
 * Uses MySQLi. Update the credentials below if your XAMPP MySQL setup
 * uses a different user or password.
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'bincom_todo');

// Create the MySQLi connection
$conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Stop early with a readable message if the connection fails
if ($conn->connect_error) {
    die(
        'Database connection failed: ' . $conn->connect_error .
        '<br>Make sure MySQL is running in XAMPP and that the <code>bincom_todo</code> ' .
        'database has been imported from <code>database.sql</code>.'
    );
}

// Make sure text (including emojis) is stored correctly
$conn->set_charset('utf8mb4');
