<?php
/**
 * Shared add/edit form.
 *
 * Expects these variables before including:
 *   $data        - current field values
 *   $errors      - field name => error message
 *   $formAction  - where the form posts to
 *   $submitLabel - text for the submit button
 */
?>
<form method="post" action="<?php echo e($formAction); ?>" novalidate>

  <?php if (isset($errors['form'])): ?>
    <div class="alert alert-danger" role="alert"><?php echo e($errors['form']); ?></div>
  <?php endif; ?>

  <div class="row g-3">

    <div class="col-md-4">
      <label for="reg_no" class="form-label">Registration number</label>
      <input type="text" class="form-control<?php echo isset($errors['reg_no']) ? ' is-invalid' : ''; ?>"
             id="reg_no" name="reg_no" maxlength="20" placeholder="BIN/CS/011"
             value="<?php echo old($data, 'reg_no'); ?>" required>
      <?php if (isset($errors['reg_no'])): ?>
        <div class="invalid-feedback"><?php echo e($errors['reg_no']); ?></div>
      <?php endif; ?>
    </div>

    <div class="col-md-4">
      <label for="first_name" class="form-label">First name</label>
      <input type="text" class="form-control<?php echo isset($errors['first_name']) ? ' is-invalid' : ''; ?>"
             id="first_name" name="first_name" maxlength="50"
             value="<?php echo old($data, 'first_name'); ?>" required>
      <?php if (isset($errors['first_name'])): ?>
        <div class="invalid-feedback"><?php echo e($errors['first_name']); ?></div>
      <?php endif; ?>
    </div>

    <div class="col-md-4">
      <label for="last_name" class="form-label">Last name</label>
      <input type="text" class="form-control<?php echo isset($errors['last_name']) ? ' is-invalid' : ''; ?>"
             id="last_name" name="last_name" maxlength="50"
             value="<?php echo old($data, 'last_name'); ?>" required>
      <?php if (isset($errors['last_name'])): ?>
        <div class="invalid-feedback"><?php echo e($errors['last_name']); ?></div>
      <?php endif; ?>
    </div>

    <div class="col-md-6">
      <label for="email" class="form-label">Email address</label>
      <input type="email" class="form-control<?php echo isset($errors['email']) ? ' is-invalid' : ''; ?>"
             id="email" name="email" maxlength="100"
             value="<?php echo old($data, 'email'); ?>" required>
      <?php if (isset($errors['email'])): ?>
        <div class="invalid-feedback"><?php echo e($errors['email']); ?></div>
      <?php endif; ?>
    </div>

    <div class="col-md-6">
      <label for="phone" class="form-label">Phone number</label>
      <input type="tel" class="form-control<?php echo isset($errors['phone']) ? ' is-invalid' : ''; ?>"
             id="phone" name="phone" maxlength="20" placeholder="+234 801 234 5678"
             value="<?php echo old($data, 'phone'); ?>" required>
      <?php if (isset($errors['phone'])): ?>
        <div class="invalid-feedback"><?php echo e($errors['phone']); ?></div>
      <?php endif; ?>
    </div>

    <div class="col-md-4">
      <label for="gender" class="form-label">Gender</label>
      <select class="form-select<?php echo isset($errors['gender']) ? ' is-invalid' : ''; ?>"
              id="gender" name="gender" required>
        <option value="">Select gender</option>
        <?php foreach (GENDERS as $gender): ?>
          <option value="<?php echo e($gender); ?>"<?php echo $data['gender'] === $gender ? ' selected' : ''; ?>>
            <?php echo e($gender); ?>
          </option>
        <?php endforeach; ?>
      </select>
      <?php if (isset($errors['gender'])): ?>
        <div class="invalid-feedback"><?php echo e($errors['gender']); ?></div>
      <?php endif; ?>
    </div>

    <div class="col-md-4">
      <label for="date_of_birth" class="form-label">Date of birth</label>
      <input type="date" class="form-control<?php echo isset($errors['date_of_birth']) ? ' is-invalid' : ''; ?>"
             id="date_of_birth" name="date_of_birth"
             value="<?php echo old($data, 'date_of_birth'); ?>" required>
      <?php if (isset($errors['date_of_birth'])): ?>
        <div class="invalid-feedback"><?php echo e($errors['date_of_birth']); ?></div>
      <?php endif; ?>
    </div>

    <div class="col-md-4">
      <label for="level" class="form-label">Level</label>
      <select class="form-select<?php echo isset($errors['level']) ? ' is-invalid' : ''; ?>"
              id="level" name="level" required>
        <option value="">Select level</option>
        <?php foreach (LEVELS as $level): ?>
          <option value="<?php echo e($level); ?>"<?php echo $data['level'] === $level ? ' selected' : ''; ?>>
            <?php echo e($level); ?>
          </option>
        <?php endforeach; ?>
      </select>
      <?php if (isset($errors['level'])): ?>
        <div class="invalid-feedback"><?php echo e($errors['level']); ?></div>
      <?php endif; ?>
    </div>

    <div class="col-12">
      <label for="department" class="form-label">Department</label>
      <input type="text" class="form-control<?php echo isset($errors['department']) ? ' is-invalid' : ''; ?>"
             id="department" name="department" maxlength="100" placeholder="Computer Science"
             value="<?php echo old($data, 'department'); ?>" required>
      <?php if (isset($errors['department'])): ?>
        <div class="invalid-feedback"><?php echo e($errors['department']); ?></div>
      <?php endif; ?>
    </div>

  </div>

  <div class="mt-4">
    <button type="submit" class="btn btn-primary"><?php echo e($submitLabel); ?></button>
    <a class="btn btn-outline-secondary" href="index.php">Cancel</a>
  </div>

</form>
