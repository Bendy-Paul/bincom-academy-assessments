<?php
/**
 * Bincom Academy - Assignment 6
 * Student Records: list, search and delete.
 */

require_once __DIR__ . '/config.php';

$search = trim((string) ($_GET['q'] ?? ''));
$columns = 'id, reg_no, first_name, last_name, email, phone, gender, date_of_birth, department, level';

if ($search !== '') {
    // Escape LIKE wildcards so a literal % or _ only matches itself
    $like = '%' . addcslashes($search, '%_\\') . '%';

    $stmt = $conn->prepare(
        "SELECT $columns FROM students
         WHERE reg_no LIKE ? OR first_name LIKE ? OR last_name LIKE ?
            OR email LIKE ? OR department LIKE ?
         ORDER BY last_name ASC, first_name ASC"
    );
    $stmt->bind_param('sssss', $like, $like, $like, $like, $like);
    $stmt->execute();
    $students = $stmt->get_result();
} else {
    $students = $conn->query(
        "SELECT $columns FROM students ORDER BY last_name ASC, first_name ASC"
    );
}

$total = $students->num_rows;
$pageTitle = 'Students';
require __DIR__ . '/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
  <h1 class="h3 mb-0">Students</h1>
  <a class="btn btn-primary" href="create.php">Add student</a>
</div>

<form method="get" action="index.php" class="row g-2 mb-3">
  <div class="col-sm-8 col-md-5">
    <label for="q" class="visually-hidden">Search students</label>
    <input type="search" class="form-control" id="q" name="q"
           value="<?php echo e($search); ?>"
           placeholder="Search name, reg no, email or department">
  </div>
  <div class="col-auto">
    <button type="submit" class="btn btn-outline-secondary">Search</button>
  </div>
  <?php if ($search !== ''): ?>
    <div class="col-auto">
      <a class="btn btn-link" href="index.php">Clear</a>
    </div>
  <?php endif; ?>
</form>

<p class="text-muted small">
  <?php if ($search !== ''): ?>
    <?php echo (int) $total; ?> result<?php echo $total === 1 ? '' : 's'; ?>
    for &ldquo;<?php echo e($search); ?>&rdquo;.
  <?php else: ?>
    <?php echo (int) $total; ?> student<?php echo $total === 1 ? '' : 's'; ?> on record.
  <?php endif; ?>
</p>

<div class="table-responsive">
  <table class="table table-bordered table-hover align-middle">
    <thead class="table-light">
      <tr>
        <th scope="col">Reg no</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Phone</th>
        <th scope="col">Gender</th>
        <th scope="col">Date of birth</th>
        <th scope="col">Department</th>
        <th scope="col">Level</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php if ($total === 0): ?>
        <tr>
          <td colspan="9" class="text-center text-muted py-4">
            <?php if ($search !== ''): ?>
              No students match your search.
            <?php else: ?>
              No students yet. Click &ldquo;Add student&rdquo; to create the first record.
            <?php endif; ?>
          </td>
        </tr>
      <?php else: ?>
        <?php while ($student = $students->fetch_assoc()): ?>
          <tr>
            <td><?php echo e($student['reg_no']); ?></td>
            <td><?php echo e($student['last_name'] . ', ' . $student['first_name']); ?></td>
            <td><?php echo e($student['email']); ?></td>
            <td><?php echo e($student['phone']); ?></td>
            <td><?php echo e($student['gender']); ?></td>
            <td><?php echo e(date('d M Y', strtotime($student['date_of_birth']))); ?></td>
            <td><?php echo e($student['department']); ?></td>
            <td><?php echo e($student['level']); ?></td>
            <td class="text-nowrap">
              <a class="btn btn-sm btn-outline-secondary"
                 href="edit.php?id=<?php echo (int) $student['id']; ?>">Edit</a>
              <form method="post" action="delete.php" class="d-inline">
                <input type="hidden" name="id" value="<?php echo (int) $student['id']; ?>">
                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
              </form>
            </td>
          </tr>
        <?php endwhile; ?>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<?php require __DIR__ . '/footer.php'; ?>
