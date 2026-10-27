# Assignment 6 - Technical Notes

A small PHP + MySQLi student record app. No frameworks, no custom CSS; the
interface uses Bootstrap 5 classes only.

## How it works

- `config.php` opens the MySQLi connection, starts the session, and holds the
  shared helpers: `e()`, `redirect()`, `set_flash()`, `get_flash()`, `old()`,
  `student_input()`, `validate_student()` and `save_error_message()`.
- `index.php` reads `?q=` and lists students. Search uses a prepared `LIKE`
  query across `reg_no`, `first_name`, `last_name`, `email` and `department`.
- `create.php` validates the form and runs an `INSERT`. On success it stores a
  flash message and redirects to `index.php`.
- `edit.php` loads the record from `?id=`, reuses the same form partial, and
  runs an `UPDATE`.
- `delete.php` accepts **POST only**, runs a `DELETE`, then redirects.
- `student_form.php` is included by `create.php` and `edit.php` so the form
  markup exists in one place.
- `header.php` / `footer.php` hold the page shell, navbar, flash alert, and the
  Bootstrap CDN links.

Every form submission ends in a redirect (POST → redirect → GET), so refreshing
the page never repeats an add, edit, or delete.

## Database

Database: `bincom_students`  
Table: `students`

| Column          | Type                         | Notes                       |
| :-------------- | :--------------------------- | :-------------------------- |
| `id`            | INT UNSIGNED                 | Primary key, auto-increment |
| `reg_no`        | VARCHAR(20)                  | Unique, required            |
| `first_name`    | VARCHAR(50)                  | Required                    |
| `last_name`     | VARCHAR(50)                  | Required                    |
| `email`         | VARCHAR(100)                 | Unique, required            |
| `phone`         | VARCHAR(20)                  | Required                    |
| `gender`        | ENUM('Male','Female','Other')| Required                    |
| `date_of_birth` | DATE                         | Required, not in the future |
| `department`    | VARCHAR(100)                 | Required                    |
| `level`         | VARCHAR(20)                  | `100`-`500`                 |
| `created_at`    | TIMESTAMP                    | Set automatically           |

`database.sql` also inserts 10 dummy students across five departments.

## SQL used

```php
// List / search
SELECT ... FROM students WHERE reg_no LIKE ? OR first_name LIKE ? ...
SELECT ... FROM students ORDER BY last_name ASC, first_name ASC

// Create
INSERT INTO students (reg_no, first_name, last_name, email, phone,
                      gender, date_of_birth, department, level)
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)

// Update
UPDATE students SET reg_no = ?, first_name = ?, ... WHERE id = ?

// Delete
DELETE FROM students WHERE id = ?
```

Every query uses a prepared statement with bound parameters.

## Validation

Validation lives in `validate_student()` and returns an array of field errors.

- All fields are required and trimmed.
- Registration number: 3-20 letters, numbers, `/ . _ -`.
- Names: 2-50 letters, spaces, apostrophes, dots or hyphens.
- Email: `filter_var(..., FILTER_VALIDATE_EMAIL)` and max 100 characters.
- Phone: 7-20 digits, spaces, `+`, `(`, `)` or `-`.
- Gender and level must match the allowed lists (`GENDERS`, `LEVELS`).
- Date of birth: real `Y-m-d` date, not in the future, after 1900.
- `reg_no` and `email` must be unique; the edit form ignores the current record.

Invalid fields get Bootstrap's `is-invalid` class and an `invalid-feedback`
message. Submitted values are re-filled with `old()` so the user does not have
to type everything again.

## Security

- Prepared statements for every query, including the search.
- Output escaped with `htmlspecialchars()` via `e()`.
- IDs cast to integers before use.
- Mutations are POST only; delete rejects GET requests.
- LIKE wildcards (`%`, `_`) are escaped so they match literally.
- Duplicate-key errors (MySQL 1062) are turned into a readable message.

Known limitation: there is no CSRF token, to keep the app beginner-simple. A
production version should add one.

## Styling

Bootstrap 5.3.3 from jsDelivr. Classes used are `container`, `navbar`,
`table table-bordered table-hover`, `form-control`, `form-select`, `form-label`,
`is-invalid`, `invalid-feedback`, `btn btn-primary`, `btn-outline-secondary`,
`btn-outline-danger`, and `alert`. There is no custom stylesheet, no gradients,
and no decorative borders.

## Screenshots

> Add screenshots to `assignment6/screenshots/` and replace the placeholders.

### Student list

![Student list](screenshots/students-list.png)

*Figure 1: The student list with the search box.*

### Add form

![Add student form](screenshots/students-add.png)

*Figure 2: The add form with validation messages.*

### Database table

![students table in phpMyAdmin](screenshots/students-database.png)

*Figure 3: The `students` table with the dummy records.*

## Tested

| Action                          | Expected                              | Result |
| :------------------------------ | :------------------------------------ | :----- |
| List students                   | 10 dummy students appear              | Works  |
| Search "computer"               | Only Computer Science students appear | Works  |
| Add a valid student             | Saved, success alert, appears in list | Works  |
| Add with empty fields           | Field errors, nothing saved           | Works  |
| Add duplicate reg no / email    | "Already in use" error                | Works  |
| Add invalid email               | "Enter a valid email address."        | Works  |
| Edit a student                  | Values update, success alert          | Works  |
| Delete a student                | Row removed, success alert            | Works  |
| Open `delete.php` directly      | Redirected, nothing deleted           | Works  |
| Refresh after submitting        | No duplicate record                   | Works  |
