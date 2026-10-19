# Bincom Assignment 4 - Simple Calculator

A modern, responsive, and lightweight calculator application built using **HTML5, CSS3, and JavaScript**. This project was created as part of the Bincom Academy assessment.

- **GitHub Repository**: [https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment4](https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment4)

---

## 📌 Project Overview

This assignment demonstrates how to build a fully functional, interactive calculator application using client-side technologies. It features fundamental arithmetic operations, state management, edge-case handling (such as floating-point precision and division by zero), clean CSS Grid layout, and keyboard event support.

---

## ✨ Features

- **Standard Arithmetic Operations**: Addition (`+`), Subtraction (`−`), Multiplication (`×`), and Division (`÷`).
- **Additional Functions**:
  - `AC` (All Clear): Resets the entire calculator state.
  - `DEL` (Backspace): Deletes the last entered digit.
  - `%` (Percentage): Converts current number to a percentage.
  - `.` (Decimal): Allows precise decimal calculations with prevention of multiple dots.
- **Two-Line Display**: Shows the active calculation history on the top line and current input/result on the main display.
- **Floating-Point Precision Fix**: Automatically eliminates precision artifacts (e.g., `0.1 + 0.2 = 0.3`).
- **Division by Zero Protection**: Gracefully alerts with `Error` instead of crashing.
- **Full Keyboard Support**: Seamlessly type numbers, operators (`+`, `-`, `*`, `/`), `Enter` / `=`, `Backspace`, `Escape` for AC, and `%`.
- **Responsive & Minimalist UI**: Clean card design with CSS Grid layout that adapts to any screen or mobile device.

---

## 🛠️ Technologies Used

- **HTML5**: Semantic document structure and data attributes (`data-number`, `data-operation`, `data-action`) for clean JavaScript hook separation.
- **CSS3**: CSS Grid for button matrix, Flexbox for display alignment, hover/active pseudo-classes, and responsive media queries.
- **JavaScript (ES6+)**: Object-Oriented `Calculator` class managing arithmetic calculations, display updates, formatted number commas, and keyboard listeners.

---

## 🚀 How to Run the Application

You can view and test this project in multiple ways:

### Option 1: Direct File Open
1. Navigate to the project directory:
   ```
   C:\xampp\htdocs\bincom\assignment4\
   ```
2. Double-click `index.html` to open it in your default web browser (Chrome, Edge, Firefox, etc.).

### Option 2: Using Localhost (XAMPP)
1. Start the **Apache** server from the XAMPP Control Panel.
2. Open your web browser.
3. Visit the URL:
   ```
   http://localhost/bincom/assignment4/
   ```

---

## 📂 File Structure

```text
assignment4/
├── index.html         # Application layout and markup
├── style.css          # Minimal styles and CSS Grid layout
├── script.js          # Calculator logic, state handling, and keyboard support
├── README.md          # Project overview and setup instructions
└── DOCUMENTATION.md   # In-depth technical breakdown and design decisions
```
