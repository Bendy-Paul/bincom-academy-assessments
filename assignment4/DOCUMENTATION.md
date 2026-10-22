# Project Documentation: Bincom Assignment 4

## 1. Introduction

This documentation explains the architecture, server-side logic, and UI design of the **Bincom Assignment 4 Simple Calculator**.

The calculator is implemented entirely with **PHP, HTML5, and CSS3**. The form submits with the HTTP **GET** method, sending `number1`, `number2`, and `operation` in the URL. PHP reads those parameters, validates them, performs the arithmetic, and renders the result. No JavaScript file is used anywhere in the project.

The project repository is hosted on GitHub at:

- **GitHub Repository**: [https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment4](https://github.com/Bendy-Paul/bincom-academy-assessments/tree/main/assignment4)

---

## 2. Technical Architecture

The project keeps a clear separation of concerns:

- **Logic (`index.php` top block)**: Defines the supported operations, reads `$_GET`, validates the input, calculates the result, and prepares display values.
- **Structure (`index.php` HTML block)**: Renders the display, the GET form, and the result. PHP only echoes already-prepared values.
- **Presentation (`style.css`)**: Styles the display, the input fields, the select box, buttons, and the responsive layout.

The request/response cycle is:

1. The browser requests `index.php` (no query string on the first visit).
2. The user fills in the two number fields and chooses an operation.
3. The form submits to `index.php?number1=...&number2=...&operation=...`.
4. PHP validates and computes the answer.
5. The page is rendered with the expression and result shown on the display.

---

## 3. Implementation Breakdown

### 3.1 Supported Operations

Operations are defined in a whitelist array, which doubles as the source for the `<select>` options and the symbol shown in the display:

```php
$operations = [
    'add'      => ['label' => 'Addition (+)',       'symbol' => '+'],
    'subtract' => ['label' => 'Subtraction (−)',    'symbol' => '−'],
    'multiply' => ['label' => 'Multiplication (×)', 'symbol' => '×'],
    'divide'   => ['label' => 'Division (÷)',       'symbol' => '÷'],
];
```

### 3.2 Request Handling

A calculation only runs when all three parameters are present:

```php
if (isset($_GET['number1'], $_GET['number2'], $_GET['operation'])) {
    $number1   = trim((string) $_GET['number1']);
    $number2   = trim((string) $_GET['number2']);
    $operation = (string) $_GET['operation'];
    // ...
}
```

### 3.3 Validation and Calculation

Validation happens in this order:

1. The operation must exist in the whitelist.
2. Both operands must pass `is_numeric()`.
3. Division by zero is rejected.

```php
switch ($operation) {
    case 'add':
        $result = $first + $second;
        break;
    case 'subtract':
        $result = $first - $second;
        break;
    case 'multiply':
        $result = $first * $second;
        break;
    case 'divide':
        $result = $first / $second;
        break;
}
```

### 3.4 Number Formatting

PHP floats can still show binary representation artifacts (for example `0.1 + 0.2`). Results are rounded to 10 decimal places before display:

```php
function formatNumber(float $number): string
{
    $number = round($number, 10);

    if (floor($number) === $number && abs($number) < 1e15) {
        return number_format($number, 0, '.', ',');
    }

    return rtrim(rtrim(number_format($number, 10, '.', ','), '0'), '.');
}
```

Whole numbers get thousands separators (`1,234`), while decimals keep only their meaningful digits (`1,234.5`).

### 3.5 Output Escaping

Every value echoed back into the page is passed through `htmlspecialchars(..., ENT_QUOTES)` so that user input cannot inject markup or break the HTML attributes.

### 3.6 Error States

Errors are shown on the calculator display with a dedicated `.is-error` style:

- `Please choose a valid operation.` — unknown `operation` value.
- `Please enter a valid number in both fields.` — missing or non-numeric operand.
- `Cannot divide by zero.` — division where the second operand is `0`.

---

## 4. UI Design & Styling

- **Display**: Dark panel (`#0f172a`) showing the submitted expression on the top line and the result (or error) on the main line.
- **Form**: Stacked fields in a flex column, each with a small uppercase label.
- **Inputs and Select**: Light background (`#f8fafc`), rounded corners, and a blue focus ring (`box-shadow`) for clear keyboard feedback.
- **Calculate Button**: Prominent solid blue (`#2563eb`) matching the original design.
- **AC Link**: A plain link to `index.php` that clears the URL parameters and resets the form, replacing the old JavaScript clear action.
- **Responsive Layout**: Cards are capped at `400px` wide with reduced padding below `400px`.

---

## 5. Verification & Testing

| Test Case           | Query String                                     | Expected Output | Status |
| :------------------ | :----------------------------------------------- | :-------------- | :----- |
| Basic Addition      | `?number1=7&number2=5&operation=add`             | `12`            | Passed |
| Subtraction         | `?number1=7&number2=5&operation=subtract`        | `2`             | Passed |
| Multiplication      | `?number1=7&number2=5&operation=multiply`        | `35`            | Passed |
| Division            | `?number1=10&number2=4&operation=divide`         | `2.5`           | Passed |
| Float Precision     | `?number1=0.1&number2=0.2&operation=add`         | `0.3`           | Passed |
| Division by Zero    | `?number1=9&number2=0&operation=divide`          | Error message   | Passed |
| Invalid Operation   | `?number1=1&number2=2&operation=power`           | Error message   | Passed |
| Non-Numeric Input   | `?number1=abc&number2=2&operation=add`           | Error message   | Passed |
| Empty First Visit   | `index.php`                                      | `0`             | Passed |

---

## 6. Conclusion

The Assignment 4 calculator is now a server-rendered PHP application. It keeps the original interface while replacing all client-side JavaScript with a GET form, PHP validation, arithmetic, and escaped output. The result is a small, readable project that demonstrates the core PHP request-handling workflow.
