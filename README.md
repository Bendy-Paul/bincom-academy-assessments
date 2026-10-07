# Bincom PHP Course - Assessment 1

This is my first assessment for the Bincom PHP course.

The task is to create a simple one-page website using **HTML** and **CSS**.

## Environment

- **Editor:** Visual Studio Code (VS Code)
- **Local Server:** XAMPP

## How to Run

1. Place this project folder inside the XAMPP `htdocs` directory.
2. Start the **Apache** server from the XAMPP Control Panel.
3. Open your browser and navigate to `http://localhost/bincom/assignment1.html`.

## Project Structure

```
bincom/
├── assignment1.html          # One-page website markup
├── assets/
│   ├── css/
│   │   └── assessment1.css   # External stylesheet
│   └── img/
│       └── hero.png          # Hero / section image
├── README.md
└── documentation.txt
```

## Built With

- **HTML5** — semantic page structure
- **CSS3** — external stylesheet (`assets/css/assessment1.css`), CSS variables,
  CSS Grid, Flexbox, gradients, transitions and a responsive media query
- **Google Fonts** — Poppins
- **Font Awesome 6** — icons

## Page Sections

- Header with brand, navigation and a "Drop us a Message" button
- Hero section with headline, description and call-to-action buttons
- "Our Service Arms" feature grid (3 columns)
- About split section with image and badge
- "Projects & Clients Case Study" reversed split section with checklist
- Footer with brand, service links and contact information

## Recent Changes

- Moved all CSS out of the inline `<style>` block into `assets/css/assessment1.css`.
- Added `assets/img/hero.png` and used it across the hero and split sections.
- Added Font Awesome icons and the Poppins font for a refreshed design.
- Rebuilt the layout with a responsive grid/hero design and a mobile breakpoint.
