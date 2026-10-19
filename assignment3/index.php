<?php
// Define constants for fixed information
define('APP_NAME', 'Personal Profile');
define('FULL_NAME', 'Alex Johnson');
define('DATE_OF_BIRTH', 'October 15, 2000');
define('NATIONALITY', 'Nigerian');

// Define variables for dynamic / personal details
$title = "Web Developer & Tech Enthusiast";
$email = "alex.johnson@example.com";
$phone = "+234 801 234 5678";
$location = "Lagos, Nigeria";
$bio = "Hello! I am an aspiring software developer with a strong passion for web development and technology. I enjoy solving problems, learning modern tech stacks, and building clean, user-friendly digital experiences.";
$hobbies = ["Coding", "Boxing", "Playing Chess", "Music"];
$skills = ["HTML5 & CSS3", "PHP & MySQL", "JavaScript Basics", "Git & GitHub", "Laravel", "Alpine.js", "Bootstrap", "Tailwind CSS"];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo APP_NAME . " - " . FULL_NAME; ?></title>
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
        }
        body {
            background-color: #f4f6f9;
            color: #333;
            line-height: 1.6;
            padding: 40px 20px;
        }
        .container {
            max-width: 650px;
            margin: 0 auto;
            background: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            border: 1px solid #e1e4e8;
        }
        .header {
            background: #2563eb;
            color: #ffffff;
            padding: 30px;
            text-align: center;
        }
        .header h1 {
            font-size: 1.8rem;
            margin-bottom: 5px;
        }
        .header p {
            font-size: 1rem;
            opacity: 0.9;
        }
        .content {
            padding: 30px;
        }
        .section {
            margin-bottom: 24px;
        }
        .section:last-child {
            margin-bottom: 0;
        }
        .section h2 {
            font-size: 1.15rem;
            color: #1e293b;
            border-bottom: 2px solid #e2e8f0;
            padding-bottom: 6px;
            margin-bottom: 12px;
        }
        .info-grid {
            display: grid;
            grid-template-columns: 140px 1fr;
            row-gap: 8px;
            font-size: 0.95rem;
        }
        .label {
            font-weight: 600;
            color: #64748b;
        }
        .tag-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            list-style: none;
        }
        .tag {
            background: #e0e7ff;
            color: #3730a3;
            padding: 4px 10px;
            border-radius: 16px;
            font-size: 0.85rem;
            font-weight: 500;
        }
        .footer {
            text-align: center;
            padding: 16px;
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            font-size: 0.85rem;
            color: #64748b;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header">
        <h1><?php echo FULL_NAME; ?></h1>
        <p><?php echo $title; ?></p>
    </div>

    <div class="content">
        <!-- About Me Section -->
        <div class="section">
            <h2>About Me</h2>
            <p><?php echo $bio; ?></p>
        </div>

        <!-- Personal Information Section (Constants & Variables) -->
        <div class="section">
            <h2>Personal Information</h2>
            <div class="info-grid">
                <span class="label">Full Name:</span>
                <span><?php echo FULL_NAME; ?></span>

                <span class="label">Date of Birth:</span>
                <span><?php echo DATE_OF_BIRTH; ?></span>

                <span class="label">Nationality:</span>
                <span><?php echo NATIONALITY; ?></span>

                <span class="label">Email:</span>
                <span><?php echo $email; ?></span>

                <span class="label">Phone:</span>
                <span><?php echo $phone; ?></span>

                <span class="label">Location:</span>
                <span><?php echo $location; ?></span>
            </div>
        </div>

        <!-- Skills Section -->
        <div class="section">
            <h2>Skills</h2>
            <ul class="tag-list">
                <?php foreach ($skills as $skill): ?>
                    <li class="tag"><?php echo $skill; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Hobbies Section -->
        <div class="section">
            <h2>Interests & Hobbies</h2>
            <ul class="tag-list">
                <?php foreach ($hobbies as $hobby): ?>
                    <li class="tag" style="background: #f1f5f9; color: #334155;"><?php echo $hobby; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>

    <div class="footer">
        &copy; <?php echo date("Y"); ?> <?php echo FULL_NAME; ?>. All rights reserved.
    </div>
</div>

>
    
</body>
</html>