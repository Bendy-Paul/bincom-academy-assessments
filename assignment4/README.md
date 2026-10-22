# Bincom Assignment 4 - Simple Calculator

A simple, responsive calculator built with **PHP, HTML5, and CSS3**. All arithmetic is performed on the server, and the operands are submitted through an HTML **GET** form. There is no JavaScript in this project.

- **GitHub Repository**: [https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment4](https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment4)

---

## 📌 Project Overview

This assignment demonstrates server-side form handling in PHP. The user enters two numbers, selects an operation, and submits the form. The browser sends the values in the URL query string, PHP validates them, computes the result, and renders the page again with the answer on the calculator display.

Example request:

```text
http://localhost/bincom/assignment4/index.php?number1=12&number2=8&operation=add
```

---

## ✨ Features

- **Standard Arithmetic Operations**: Addition (`+`), Subtraction (`−`), Multiplication (`×`), and Division (`÷`).
- **GET Request Handling**: Values are passed as `number1`, `number2`, and `operation`.
- **Server-Side Validation**:
  - Both operands must be numeric.
  - The operation must be one of the four supported values.
  - Division by zero is reported as an error instead of crashing.
- **Human-Readable Output**: Results are rounded to remove floating-point artifacts and formatted with thousands separators.
- **Sticky Form Values**: Submitted values remain in the fields after the calculation.
- **Responsive UI**: The same clean card design adapts to mobile and desktop screens.
- **No JavaScript**: The entire flow works with plain HTML and PHP.

---

## 🛠️ Technologies Used

- **PHP 8**: Request handling (`$_GET`), validation, arithmetic, and number formatting.
- **HTML5**: Semantic markup and a native `method="get"` form.
- **CSS3**: Flexbox layout, focus states, hover effects, and a responsive media query.

---

## 🚀 How to Run the Application

### Using XAMPP (required, because PHP must be executed)

1. Start the **Apache** server from the XAMPP Control Panel.
2. Place the project folder inside `C:\xampp\htdocs\`.
3. Open your browser and visit:

   ```text
   http://localhost/bincom/assignment4/
   ```

Opening `index.php` directly as a file will not work, since PHP code must be executed by a web server.

---

## 📂 File Structure

```text
assignment4/
├── index.php          # Form, PHP calculation logic, and result display
├── style.css          # Calculator and form styling
├── README.md          # Project overview and setup instructions
└── DOCUMENTATION.md   # In-depth technical breakdown
```

---

## 🔢 Query Parameters

| Parameter   | Type   | Required | Description                                        |
| :---------- | :----- | :------- | :------------------------------------------------- |
| `number1`   | number | Yes      | The first operand.                                 |
| `number2`   | number | Yes      | The second operand.                                |
| `operation` | string | Yes      | One of `add`, `subtract`, `multiply`, or `divide`. |

---

## 🧪 Quick Test URLs

| Calculation     | URL                                                        |
| :-------------- | :--------------------------------------------------------- |
| `12 + 8`        | `index.php?number1=12&number2=8&operation=add`              |
| `12 − 8`        | `index.php?number1=12&number2=8&operation=subtract`         |
| `12 × 8`        | `index.php?number1=12&number2=8&operation=multiply`         |
| `12 ÷ 8`        | `index.php?number1=12&number2=8&operation=divide`           |
| Division by zero | `index.php?number1=12&number2=0&operation=divide`          |
