<?php
/**
 * Bincom Academy - Assignment 6
 * Student Records: edit an existing student.
 */

require_once __DIR__ . '/config.php';

$id = (int) ($_GET['id'] ?? $_POST['id'] ?? 0);

if ($id < 1) {
    set_flash('Invalid student selected.', 'danger');
    redirect('index.php');
}

$stmt = $conn->prepare(
    'SELECT id, reg_no, first_name, last_name, email, phone, gender, date_of_birth, department, level
     FROM students WHERE id = ? LIMIT 1'
);
$stmt->bind_param('i', $id);
$stmt->execute();
$student = $stmt->get_result()->fetch_assoc();
$stmt->close();

if ($student === null) {
    set_flash('Student not found.', 'danger');
    redirect('index.php');
}

$data = student_input($student);
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = student_input($_POST);
    $errors = validate_student($data, $conn, $id);

    if ($errors === []) {
        $stmt = $conn->prepare(
            'UPDATE students
             SET reg_no = ?, first_name = ?, last_name = ?, email = ?, phone = ?,
                 gender = ?, date_of_birth = ?, department = ?, level = ?
             WHERE id = ?'
        );
        $stmt->bind_param(
            'sssssssssi',
            $data['reg_no'],
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['phone'],
            $data['gender'],
            $data['date_of_birth'],
            $data['department'],
            $data['level'],
            $id
        );

        try {
            $saved = $stmt->execute();
        } catch (Throwable $ex) {
            $saved = false;
        }

        $stmt->close();

        if ($saved) {
            set_flash('Student "' . $data['first_name'] . ' ' . $data['last_name'] . '" was updated.');
            redirect('index.php');
        }

        $errors['form'] = save_error_message($conn);
    }
}

$pageTitle = 'Edit student';
require __DIR__ . '/header.php';
?>

<h1 class="h3 mb-1">Edit student</h1>
<p class="text-muted mb-3">
  <?php echo e($student['reg_no'] . ' - ' . $student['first_name'] . ' ' . $student['last_name']); ?>
</p>

<div class="row">
  <div class="col-lg-9 col-xl-8">
    <div class="card">
      <div class="card-body">
        <?php
        $formAction = 'edit.php?id=' . $id;
        $submitLabel = 'Update student';
        require __DIR__ . '/student_form.php';
        ?>
      </div>
    </div>
  </div>
</div>

<?php require __DIR__ . '/footer.php'; ?>
