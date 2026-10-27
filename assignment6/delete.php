<?php
/**
 * Bincom Academy - Assignment 6
 * Student Records: delete a student (POST only, so a link or a page
 * refresh can never delete a record).
 */

require_once __DIR__ . '/config.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    redirect('index.php');
}

$id = (int) ($_POST['id'] ?? 0);

if ($id < 1) {
    set_flash('Invalid student selected.', 'danger');
    redirect('index.php');
}

$stmt = $conn->prepare('DELETE FROM students WHERE id = ?');
$stmt->bind_param('i', $id);

try {
    $deleted = $stmt->execute();
} catch (Throwable $ex) {
    $deleted = false;
}

$affected = $stmt->affected_rows;
$stmt->close();

if ($deleted && $affected > 0) {
    set_flash('Student record deleted.');
} else {
    set_flash('Student not found or already deleted.', 'danger');
}

redirect('index.php');
