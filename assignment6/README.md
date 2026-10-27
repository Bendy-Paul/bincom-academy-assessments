# Bincom Assignment 6 - Student Records

A simple student record app built with **PHP, MySQLi, and Bootstrap 5**. Students
can be listed, searched, added, edited, and deleted. Records are stored in MySQL.

## Features

- List all students
- Search by name, registration number, email, or department
- Add a student
- Edit a student
- Delete a student
- Server-side validation with inline error messages
- Success messages after add, update, and delete

## Setup

1. Start **Apache** and **MySQL** in XAMPP.
2. Import `database.sql` in phpMyAdmin (`http://localhost/phpmyadmin` > Import),
   or run it from the command line:

   ```text
   C:\xampp\mysql\bin\mysql.exe -u root < C:\xampp\htdocs\bincom\assignment6\database.sql
   ```

   The file creates the `bincom_students` database, the `students` table, and
   10 dummy students.
3. If your MySQL password is not empty, edit `config.php`.
4. Open `http://localhost/bincom/assignment6/`.

## Files

```text
assignment6/
├── index.php        # Student list, search and delete buttons
├── create.php       # Add a student
├── edit.php         # Edit a student
├── delete.php       # Deletes a student (POST only)
├── student_form.php # Form shared by create.php and edit.php
├── header.php       # Page head, navbar, flash message
├── footer.php       # Footer and Bootstrap script
├── config.php       # MySQLi connection, helpers and validation
├── database.sql     # Database, table and dummy data
├── README.md
└── DOCUMENTATION.md
```

## Built With

- **PHP 8** (MySQLi, prepared statements)
- **Bootstrap 5.3** via CDN (no custom CSS)
- **MySQL** (InnoDB, `utf8mb4`)

## Note

Bootstrap is loaded from a CDN, so the page needs an internet connection to be
styled. Without it the app still works, just unstyled.
