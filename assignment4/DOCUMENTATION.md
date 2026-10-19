# Project Documentation: Bincom Assignment 4

## 1. Introduction

This documentation details the architecture, computational logic, and UI design decisions implemented in the **Bincom Assignment 4 Simple Calculator**. Built with **HTML5**, **CSS3**, and vanilla **JavaScript (ES6+)**, the application delivers an intuitive, accessible, and mathematically reliable desktop and mobile calculator.

The project repository is hosted on GitHub at:
- **GitHub Repository**: [https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment4](https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment4)

---

## 2. Technical Architecture & Approach

The project adheres to a clean separation of concerns:
- **Structure (`index.html`)**: Declares UI elements using HTML5 semantic tags and descriptive `data-*` attributes to decouple layout from logic.
- **Presentation (`style.css`)**: Implements CSS Grid for precise button matrix alignment, responsive sizing, and interactive tactile feedback.
- **Logic (`script.js`)**: Encapsulates state variables (`currentInput`, `previousInput`, `operator`), arithmetic operations, and event listeners using clean, modular functions.

---

## 3. Implementation Breakdown

### 3.1 State Management & Functions

The calculator uses intuitive top-level state variables:
- `currentInput`: String representing the currently active number being entered or the computation output.
- `previousInput`: String representing the stored previous operand before an operator was selected.
- `operator`: String symbol of the chosen binary operation (`+`, `-`, `×`, `÷`).

### 3.2 Core Calculation Logic

Calculations are performed with `parseFloat()` and standard arithmetic operations:
```javascript
switch (operator) {
  case "+":
    result = prev + current;
    break;
  case "-":
    result = prev - current;
    break;
  case "×":
  case "*":
    result = prev * current;
    break;
  case "÷":
  case "/":
    result = current === 0 ? "Error" : prev / current;
    break;
}
```

### 3.3 Precision & Edge Cases Handled

1. **Floating-Point Artifacts**: In standard JavaScript, `0.1 + 0.2` results in `0.30000000000000004` due to binary IEEE 754 float representation. The calculator eliminates this artifact via an epsilon rounding utility:
   ```javascript
   roundResult(number) {
     return Math.round((number + Number.EPSILON) * 1e10) / 1e10;
   }
   ```
2. **Division by Zero**: Dividing by zero sets `currentOperand` to `"Error"` preventing undefined behavior or infinity crashes.
3. **Multiple Decimal Prevention**: Disallows multiple `.` in a single number operand.
4. **Digit Overflow**: Enforces a maximum input limit to prevent text overflow outside the screen bounds.

### 3.4 Display Formatting

Numbers are formatted with thousands commas for readability (e.g. `1,000,000`) without corrupting partial decimal typing (e.g. `1.05` remains intact while typing).

### 3.5 Keyboard Input Handling

Desktop users can operate the calculator directly through keyboard events:
- Numbers: `0` - `9` and `.`
- Operators: `+`, `-`, `*`, `/`
- Actions: `Enter` or `=` for equals, `Backspace` for delete, `Escape` for AC, and `%` for percent.

---

## 4. UI Design & Styling

- **CSS Grid**: Utilizes `grid-template-columns: repeat(4, 1fr)` with a `12px` gap for balanced button proportions.
- **Visual Categorization**:
  - Number keys: Soft neutral background (`#f8fafc`).
  - Operators: Subtle primary tint (`#eff6ff` with `#2563eb` text).
  - Clear / Del actions: Subtle danger tint (`#fee2e2` with `#dc2626` text).
  - Equals button: Prominent solid blue (`#2563eb` with white text).
- **Tactile Feedback**: Includes `transform: scale(0.96)` on button active state for responsive feedback.

---

## 5. Verification & Testing

| Test Case | Input | Expected Output | Status |
| :--- | :--- | :--- | :--- |
| Basic Addition | `7 + 5 =` | `12` | Passed |
| Float Precision | `0.1 + 0.2 =` | `0.3` | Passed |
| Division by Zero | `9 ÷ 0 =` | `Error` | Passed |
| Chained Operations | `10 + 5 × 2 =` | `30` | Passed |
| Percentage | `50 %` | `0.5` | Passed |
| Backspace | `123 DEL` | `12` | Passed |
| Keyboard Input | Type `8 * 7 Enter` | `56` | Passed |

---

## 6. Conclusion

The Assignment 4 Simple Calculator delivers a complete, modular, and maintainable implementation. It fulfills all criteria using HTML5, CSS3, and JavaScript, while incorporating robust error handling and a clean user experience.
