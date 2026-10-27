<?php
/**
 * Database configuration and shared helpers for the Student Records
 * application (Assignment 6).
 *
 * Uses MySQLi. Update the credentials below if your XAMPP MySQL setup
 * uses a different user or password.
 */

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'bincom_students');

define('APP_NAME', 'Student Records');

// Allowed values for the two select fields
const GENDERS = ['Male', 'Female', 'Other'];
const LEVELS  = ['100', '200', '300', '400', '500'];

// Create the MySQLi connection
$conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Stop early with a readable message if the connection fails
if ($conn->connect_error) {
    die(
        'Database connection failed: ' . $conn->connect_error .
        '<br>Make sure MySQL is running in XAMPP and that the <code>bincom_students</code> ' .
        'database has been imported from <code>database.sql</code>.'
    );
}

// Make sure text (including emojis) is stored correctly
$conn->set_charset('utf8mb4');

// Session is used for one-time flash messages
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * Escape a value for safe HTML output.
 */
function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

/**
 * Send the browser to another page and stop the script.
 */
function redirect(string $path): void
{
    header('Location: ' . $path);
    exit;
}

/**
 * Store a one-time message to show on the next page load.
 */
function set_flash(string $message, string $type = 'success'): void
{
    $_SESSION['flash'] = ['message' => $message, 'type' => $type];
}

/**
 * Read and clear the one-time message, if there is one.
 *
 * @return array{message: string, type: string}|null
 */
function get_flash(): ?array
{
    if (empty($_SESSION['flash'])) {
        return null;
    }

    $flash = $_SESSION['flash'];
    unset($_SESSION['flash']);

    return $flash;
}

/**
 * Re-print a submitted value after a validation error.
 */
function old(array $data, string $key): string
{
    return e((string) ($data[$key] ?? ''));
}

/**
 * Pull the student fields out of a request array and trim them.
 */
function student_input(array $source): array
{
    $keys = [
        'reg_no', 'first_name', 'last_name', 'email', 'phone',
        'gender', 'date_of_birth', 'department', 'level',
    ];

    $data = [];
    foreach ($keys as $key) {
        $data[$key] = trim((string) ($source[$key] ?? ''));
    }

    return $data;
}

/**
 * Validate a student record.
 *
 * @param array  $data     Trimmed student fields.
 * @param mysqli $conn     Open connection, used for the uniqueness checks.
 * @param int    $ignoreId Record to skip when editing (0 when creating).
 * @return array<string, string> Field name => error message.
 */
function validate_student(array $data, mysqli $conn, int $ignoreId = 0): array
{
    $errors = [];

    // Registration number
    if ($data['reg_no'] === '') {
        $errors['reg_no'] = 'Registration number is required.';
    } elseif (!preg_match('#^[A-Za-z0-9/._-]{3,20}$#', $data['reg_no'])) {
        $errors['reg_no'] = 'Use 3-20 letters, numbers, or / . _ - only.';
    }

    // Names
    foreach (['first_name' => 'First name', 'last_name' => 'Last name'] as $key => $label) {
        if ($data[$key] === '') {
            $errors[$key] = $label . ' is required.';
        } elseif (!preg_match("/^[\\p{L} '.\\-]{2,50}$/u", $data[$key])) {
            $errors[$key] = $label . ' must be 2-50 letters, spaces, apostrophes, dots or hyphens.';
        }
    }

    // Email
    if ($data['email'] === '') {
        $errors['email'] = 'Email address is required.';
    } elseif (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Enter a valid email address.';
    } elseif (mb_strlen($data['email']) > 100) {
        $errors['email'] = 'Email address is too long (max 100 characters).';
    }

    // Phone
    if ($data['phone'] === '') {
        $errors['phone'] = 'Phone number is required.';
    } elseif (!preg_match('/^[0-9+() -]{7,20}$/', $data['phone'])) {
        $errors['phone'] = 'Use 7-20 digits, spaces, +, ( ) or - only.';
    }

    // Gender and level must come from the allowed lists
    if (!in_array($data['gender'], GENDERS, true)) {
        $errors['gender'] = 'Select a gender.';
    }

    if (!in_array($data['level'], LEVELS, true)) {
        $errors['level'] = 'Select a level.';
    }

    // Date of birth
    if ($data['date_of_birth'] === '') {
        $errors['date_of_birth'] = 'Date of birth is required.';
    } else {
        $dob = DateTime::createFromFormat('!Y-m-d', $data['date_of_birth']);
        $valid = $dob && $dob->format('Y-m-d') === $data['date_of_birth'];

        if (!$valid) {
            $errors['date_of_birth'] = 'Enter a valid date.';
        } elseif ($dob > new DateTime('today')) {
            $errors['date_of_birth'] = 'Date of birth cannot be in the future.';
        } elseif ($dob < new DateTime('1900-01-01')) {
            $errors['date_of_birth'] = 'Enter a date after 1 January 1900.';
        }
    }

    // Department
    if ($data['department'] === '') {
        $errors['department'] = 'Department is required.';
    } elseif (mb_strlen($data['department']) < 2 || mb_strlen($data['department']) > 100) {
        $errors['department'] = 'Department must be 2-100 characters.';
    }

    // Uniqueness (registration number and email)
    if ($errors === [] || !isset($errors['reg_no'])) {
        $stmt = $conn->prepare('SELECT id FROM students WHERE reg_no = ? AND id <> ? LIMIT 1');
        $stmt->bind_param('si', $data['reg_no'], $ignoreId);
        $stmt->execute();

        if ($stmt->get_result()->num_rows > 0) {
            $errors['reg_no'] = 'That registration number is already in use.';
        }

        $stmt->close();
    }

    if ($errors === [] || !isset($errors['email'])) {
        $stmt = $conn->prepare('SELECT id FROM students WHERE email = ? AND id <> ? LIMIT 1');
        $stmt->bind_param('si', $data['email'], $ignoreId);
        $stmt->execute();

        if ($stmt->get_result()->num_rows > 0) {
            $errors['email'] = 'That email address is already in use.';
        }

        $stmt->close();
    }

    return $errors;
}

/**
 * Friendly message when an INSERT/UPDATE fails.
 */
function save_error_message(mysqli $conn): string
{
    if ($conn->errno === 1062) {
        return 'That registration number or email address is already in use.';
    }

    return 'The record could not be saved. Please try again.';
}
