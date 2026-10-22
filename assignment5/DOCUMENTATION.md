# Assignment 5 - Technical Notes

A small PHP + MySQLi ToDo app. No frameworks or JavaScript.

## How it works

- `config.php` opens the MySQLi connection.
- `index.php` handles three POST actions (`add`, `toggle`, `delete`), then redirects back to the page.
- Tasks are read with `SELECT id, title, is_done FROM tasks` and rendered in a list.
- `style.css` contains plain, minimal styling.

## Database

Database: `bincom_todo`  
Table: `tasks`

| Column       | Type         | Notes                     |
| :----------- | :----------- | :------------------------ |
| `id`         | INT UNSIGNED | Primary key, auto-increment |
| `title`      | VARCHAR(255) | Task text                 |
| `is_done`    | TINYINT(1)   | `0` = active, `1` = done  |
| `created_at` | TIMESTAMP    | Set automatically         |

## SQL used

```php
// Add
INSERT INTO tasks (title) VALUES (?)

// Toggle
UPDATE tasks SET is_done = 1 - is_done WHERE id = ?

// Delete
DELETE FROM tasks WHERE id = ?
```

All three use prepared statements with bound parameters.

## Security

- Prepared statements for every query.
- Output escaped with `htmlspecialchars()`.
- IDs cast to integers.

## Screenshots

> Add your screenshots to `assignment5/screenshots/` and replace the placeholder paths below.

### Main page

![ToDo app main page](screenshots/todo-main.png)

*Figure 1: The task list with the add form.*

### Completed task

![Task marked as done](screenshots/todo-completed.png)

*Figure 2: A task shown with a strikethrough after clicking Done.*

### Database table

![tasks table in phpMyAdmin](screenshots/todo-database.png)

*Figure 3: The `tasks` table in phpMyAdmin.*

## Tested

| Action        | Expected                    | Result |
| :------------ | :-------------------------- | :----- |
| Add task      | Appears in the list         | Works  |
| Mark done     | Text gets struck through    | Works  |
| Undo          | Text returns to normal      | Works  |
| Delete        | Task disappears             | Works  |
| Empty title   | Nothing is added            | Works  |
| Refresh page  | No duplicate submission     | Works  |
