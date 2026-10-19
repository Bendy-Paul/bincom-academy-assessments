# Project Documentation: Bincom Assignment 3

## 1. Introduction

This document provides a technical walkthrough of the **Bincom Assignment 3 Personal Profile Page**. The goal of this assignment is to showcase foundational server-side development concepts in **PHP**, specifically the declaration and application of constants and variables, while outputting dynamic content to an HTML interface styled with minimal CSS.

The project repository is hosted on GitHub at:
- **GitHub Repository**: [https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment3](https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment3)

---

## 2. Technical Architecture & Approach

This application follows a basic single-file script architecture where data declaration is separated from presentation:

1. **Data Initialization Block**:
   - Constants are declared at the very top of the script using PHP's `define()` function for values that remain fixed.
   - Variables are declared below constants for attributes that can change or represent structured data (strings, arrays).

2. **Template / Presentation Block**:
   - The document renders standard HTML5 markup.
   - Embedded PHP tags (`<?php echo ...; ?>`) inject the stored data directly into the DOM.
   - Arrays (such as skills and hobbies) are iterated through using `foreach` loops to generate repetitive list elements dynamically.

3. **Styling Layer**:
   - Embedded minimal CSS in the `<head>` tag handles layout, typography, responsive card sizing, and tag badges.

---

## 3. Implementation Breakdown

### 3.1 Constants vs. Variables in PHP

In PHP, constants and variables serve distinct purposes for managing state and data:

| Feature | Constant (`define()`) | Variable (`$variable`) |
| :--- | :--- | :--- |
| **Prefix** | No `$` prefix | Prefixed with `$` symbol |
| **Mutability** | Cannot be changed or undefined once defined | Can be reassigned at any point |
| **Scope** | Globally accessible across functions and files | Subject to local/global variable scoping rules |
| **Use Case in Profile** | Fixed identity values (e.g. `FULL_NAME`, `DATE_OF_BIRTH`, `NATIONALITY`) | Mutable / dynamic attributes (e.g. `$title`, `$bio`, `$skills`) |

#### Code Implementation:
```php
// Constants defined for fixed values
define('APP_NAME', 'Personal Profile');
define('FULL_NAME', 'Alex Johnson');
define('DATE_OF_BIRTH', 'October 15, 2000');
define('NATIONALITY', 'Nigerian');

// Variables defined for dynamic / structured details
$title = "Web Developer & Tech Enthusiast";
$email = "alex.johnson@example.com";
$phone = "+234 801 234 5678";
$location = "Lagos, Nigeria";
$bio = "Hello! I am an aspiring software developer with a strong passion for web development and technology...";
$hobbies = ["Coding", "Reading Tech Blogs", "Playing Chess", "Music"];
$skills = ["HTML5 & CSS3", "PHP & MySQL", "JavaScript Basics", "Git & GitHub"];
```

---

### 3.2 Dynamic Output Rendering

Data is embedded directly into the HTML structure using PHP `echo`:

#### Direct Echoing
```html
<h1><?php echo FULL_NAME; ?></h1>
<p><?php echo $title; ?></p>
```

#### Looping Over Arrays
Arrays such as `$skills` and `$hobbies` are displayed using `foreach` loops:
```php
<ul class="tag-list">
    <?php foreach ($skills as $skill): ?>
        <li class="tag"><?php echo $skill; ?></li>
    <?php endforeach; ?>
</ul>
```

---

### 3.3 CSS Layout & Styling

The CSS styling is kept clean and minimal:
- **Card Container**: Centered layout using `max-width: 650px` with subtle shadow (`rgba(0, 0, 0, 0.08)`) and border radius.
- **Header**: High-contrast blue header (`#2563eb`) displaying the candidate's name and headline.
- **Two-Column Info Grid**: Uses CSS Grid (`grid-template-columns: 140px 1fr`) to align labels and data items neatly.
- **Badges**: Flexbox-based tag pills (`.tag-list` and `.tag`) for displaying skills and hobbies clearly.

---

## 4. Testing & Verification

1. **Syntax Validation**: Checked with the PHP CLI linter:
   ```bash
   php -l assignment3/index.php
   # Output: No syntax errors detected in C:\xampp\htdocs\bincom\assignment3\index.php
   ```
2. **Runtime Execution**: Verified that XAMPP Apache serves the script properly without runtime warnings or undefined variable notices.

---

## 5. Conclusion

This project successfully fulfills the requirements of Bincom Assignment 3. It demonstrates fundamental PHP syntax, proper differentiation between constants and variables, dynamic page output, and lightweight styling for a clean presentation.
