# Project Documentation: Bincom Assignment 2

## 1. Introduction

This documentation details the technical architecture, design decisions, and implementation techniques used to build the **Bincom Assignment 2 To-Do App** using exclusively **HTML5** and **CSS3**.

The repository for this assignment is hosted on GitHub at:
- **GitHub Repository**: [https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment2](https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment2)

The goal of this assignment is to produce a functional, clean, and interactive user interface without relying on JavaScript or external frontend dependencies.

---

## 2. Technical Architecture & Approach

In modern web development, dynamic interactions are typically handled via JavaScript. However, CSS provides native state mechanisms through HTML form controls.

This project implements the **Checkbox Toggle Pattern**:
1. An `<input type="checkbox">` stores the binary state (`checked` vs. `unchecked`).
2. A `<label>` element wraps the input and label text, expanding the clickable target area.
3. The CSS `:checked` pseudo-class combined with the sibling combinator (`~`) modifies the visual appearance of adjacent text based on user interaction.

---

## 3. Implementation Breakdown

### 3.1 HTML Structure (`index.html`)

The document uses standard HTML5 semantic elements:
- `<div class="todo-container">`: Acts as the central card housing the header, list, and footer.
- `<ul class="todo-list">` & `<li>`: Provides semantic grouping for the collection of tasks.
- `<label class="todo-item">`: Wraps both the checkbox and the task title. When an element is wrapped in a `<label>`, clicking anywhere on the item row automatically toggles the checkbox inside it.
- `<span class="task-title">`: Contains the task description text so it can be targeted independently in CSS.

```html
<label class="todo-item">
  <input type="checkbox" />
  <span class="task-title">Review Bincom assignment guidelines</span>
</label>
```

---

### 3.2 CSS Styling & Layout

#### Layout & Centering
- `display: flex; justify-content: center; align-items: center; min-height: 100vh;` is used on the `<body>` to center the application card both vertically and horizontally across all viewports.
- `box-sizing: border-box;` is applied globally to ensure consistent sizing and prevent padding from causing overflow.

#### Interactive State Mechanism
The core interactivity is achieved with the following rule:

```css
.todo-item input[type="checkbox"]:checked ~ .task-title {
  text-decoration: line-through;
  color: #999999;
}
```

- `:checked`: Detects when the user clicks and activates the checkbox.
- `~` (Subsequent Sibling Combinator): Targets `.task-title` elements that share the same parent and follow the checkbox in the DOM.
- `text-decoration: line-through`: Visually marks the task as completed.
- `color: #999999`: Dims the text to provide immediate visual contrast between active and finished tasks.

#### Modern Form Controls
- `accent-color: #007bff;` is used to style the checkbox checkmark color natively without breaking accessibility.
- `cursor: pointer;` ensures clear visual feedback indicating that the row is clickable.

---

## 4. Key Considerations & Limitations

| Aspect | Pure HTML/CSS | With JavaScript |
| :--- | :--- | :--- |
| **Task Completion** | Supported via `:checked` | Supported via state management / DOM manipulation |
| **Adding New Tasks** | Not supported (requires form submission or JS) | Supported dynamically at runtime |
| **Data Persistence** | None (resets on page reload) | Supported via `localStorage` or backend databases |
| **Performance** | Instantaneous, zero script overhead | Minimal overhead depending on libraries |

---

## 5. Conclusion

This assignment illustrates how foundational HTML and CSS capabilities can be leveraged to build responsive, accessible, and interactive components. By combining semantic markup with CSS pseudo-classes, we achieved an intuitive To-Do checklist experience while keeping the codebase lightweight and maintainable.
