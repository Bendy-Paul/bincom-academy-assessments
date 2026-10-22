<?php
/**
 * Bincom Academy - Assignment 5
 * Minimal ToDo app: add, mark done, delete.
 */

require_once __DIR__ . '/config.php';

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

// Handle form submissions, then redirect so refreshing does not repeat them
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        $title = trim((string) ($_POST['title'] ?? ''));

        if ($title !== '') {
            $stmt = $conn->prepare('INSERT INTO tasks (title) VALUES (?)');
            $stmt->bind_param('s', $title);
            $stmt->execute();
            $stmt->close();
        }
    } elseif (isset($_POST['toggle'], $_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare('UPDATE tasks SET is_done = 1 - is_done WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    } elseif (isset($_POST['delete'], $_POST['id'])) {
        $id = (int) $_POST['id'];
        $stmt = $conn->prepare('DELETE FROM tasks WHERE id = ?');
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->close();
    }

    header('Location: index.php');
    exit;
}

$tasks = $conn->query('SELECT id, title, is_done FROM tasks ORDER BY is_done ASC, id DESC');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bincom Assignment 5 - ToDo App</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="container">
    <h1>ToDo List</h1>
    <p class="subtitle">Bincom Academy - Assignment 5</p>

    <form method="post" class="add-form">
      <input type="text" name="title" maxlength="255" placeholder="New task" required autofocus>
      <button type="submit" name="add">Add</button>
    </form>

    <ul>
      <?php if ($tasks->num_rows === 0): ?>
        <li class="empty">No tasks yet. Add one above.</li>
      <?php else: ?>
        <?php while ($task = $tasks->fetch_assoc()): ?>
          <li>
            <form method="post">
              <input type="hidden" name="id" value="<?php echo (int) $task['id']; ?>">
              <button type="submit" name="toggle">
                <?php echo $task['is_done'] ? 'Undo' : 'Done'; ?>
              </button>
            </form>

            <span class="task-text<?php echo $task['is_done'] ? ' done' : ''; ?>">
              <?php echo e($task['title']); ?>
            </span>

            <form method="post">
              <input type="hidden" name="id" value="<?php echo (int) $task['id']; ?>">
              <button type="submit" name="delete" class="delete">Delete</button>
            </form>
          </li>
        <?php endwhile; ?>
      <?php endif; ?>
    </ul>
  </div>

</body>
</html>
<?php $conn->close(); ?>
