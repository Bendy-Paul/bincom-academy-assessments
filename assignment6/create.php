<?php
/**
 * Bincom Academy - Assignment 6
 * Student Records: create a new student.
 */

require_once __DIR__ . '/config.php';

$data = [
    'reg_no' => '',
    'first_name' => '',
    'last_name' => '',
    'email' => '',
    'phone' => '',
    'gender' => '',
    'date_of_birth' => '',
    'department' => '',
    'level' => '',
];
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = student_input($_POST);
    $errors = validate_student($data, $conn);

    if ($errors === []) {
        $stmt = $conn->prepare(
            'INSERT INTO students
                (reg_no, first_name, last_name, email, phone, gender, date_of_birth, department, level)
             VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)'
        );
        $stmt->bind_param(
            'sssssssss',
            $data['reg_no'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'],
            $data['gender'],
            $data['date_of_birth'],
            $data['department'],
            $data['level']
        );

        // Works whether MySQLi reports errors by return value (PHP 8.0)
        // or by throwing exceptions (PHP 8.1+)
        try {
            $saved = $stmt->execute();
        } catch (Throwable $ex) {
            $saved = false;
        }

        $stmt->close();

        if ($saved) {
            set_flash('Student "' . $data['first_name'] . ' ' . $data['last_name'] . '" was added.');
            redirect('index.php');
        }

        $errors['form'] = save_error_message($conn);
    }
}

$pageTitle = 'Add student';
require __DIR__ . '/header.php';
?>

<h1 class="h3 mb-3">Add student</h1>

<div class="row">
  <div class="col-lg-9 col-xl-8">
    <div class="card">
      <div class="card-body">
        <?php
        $formAction = 'create.php';
        $submitLabel = 'Save student';
        require __DIR__ . '/student_form.php';
        ?>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>
