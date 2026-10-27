<?php
/**
 * Shared page header. Expects $pageTitle to be set before including.
 */
$flash = get_flash();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php echo e($pageTitle ?? APP_NAME); ?> - <?php echo e(APP_NAME); ?></title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="bg-white">

  <nav class="navbar navbar-expand bg-light border-bottom mb-4">
    <div class="container">
      <a class="navbar-brand" href="index.php"><?php echo e(APP_NAME); ?></a>
      <div class="navbar-nav">
        <a class="nav-link" href="index.php">Students</a>
        <a class="nav-link" href="create.php">Add student</a>
      </div>
    </div>
  </nav>

  <main class="container pb-5">

    <?php if ($flash !== null): ?>
      <div class="alert alert-<?php echo e($flash['type']); ?> alert-dismissible fade show" role="alert">
        <?php echo e($flash['message']); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    <?php endif; ?>
