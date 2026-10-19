# Bincom Assignment 3 - Personal Profile Page

A simple and responsive profile web page built with **PHP, HTML5, and minimal CSS**. This project was created as part of the Bincom Academy assessment.

- **GitHub Repository**: [https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment3](https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment3)

---

## 📌 Project Overview

The objective of this assignment is to build a personal profile page using PHP. It demonstrates the fundamental concepts of server-side data handling by using **constants** and **variables** to store personal details and rendering them dynamically onto the webpage using PHP's `echo` statements.

---

## ✨ Features

- **PHP Constants**: Used `define()` to store immutable personal information such as Full Name, Date of Birth, and Nationality.
- **PHP Variables**: Stored dynamic profile information such as Job Title, Bio, Contact Information, and indexed arrays for Skills and Hobbies.
- **Dynamic Content Rendering**: Information is rendered into the HTML document using PHP `echo` and loop constructs (`foreach`).
- **Minimal & Clean CSS**: Responsive card layout styled with a clean color palette and clear visual hierarchy without heavy frontend dependencies.

---

## 🛠️ Technologies Used

- **PHP 8+**: Server-side scripting, constant definition (`define()`), variable declarations, array handling, and dynamic HTML output.
- **HTML5**: Semantic elements for structured content representation.
- **CSS3**: Lightweight custom styles using Flexbox and CSS Grid for layout structuring and clean presentation.

---

## 🚀 How to Run the Application

Because this application uses PHP, it must be executed within a PHP-supported environment (such as XAMPP, WampServer, or the built-in PHP development server).

### Option 1: Using Localhost (XAMPP)
1. Start the **Apache** server from the XAMPP Control Panel.
2. Ensure the project is located within your `htdocs` directory:
   ```
   C:\xampp\htdocs\bincom\assignment3\
   ```
3. Open your browser and navigate to:
   ```
   http://localhost/bincom/assignment3/
   ```

### Option 2: Using PHP Built-in Server
1. Open a terminal and navigate to the assignment directory:
   ```bash
   cd C:\xampp\htdocs\bincom\assignment3
   ```
2. Start the local server:
   ```bash
   php -S localhost:8000
   ```
3. Open your web browser and visit `http://localhost:8000`.

---

## 📂 File Structure

```text
assignment3/
├── index.php          # Main PHP script containing constants, variables, markup, and styling
├── README.md          # Project overview and execution instructions
└── DOCUMENTATION.md   # Detailed technical documentation and implementation breakdown
```
