<?php
// Supported operations: key => label / symbol
$operations = [
    'add'      => ['label' => 'Addition (+)',       'symbol' => '+'],
    'subtract' => ['label' => 'Subtraction (−)',    'symbol' => '−'],
    'multiply' => ['label' => 'Multiplication (×)', 'symbol' => '×'],
    'divide'   => ['label' => 'Division (÷)',       'symbol' => '÷'],
];

// Form state (kept so the submitted values remain visible after the request)
$number1   = '';
$number2   = '';
$operation = 'add';
$result    = null;
$error     = '';
$expression = '';

/**
 * Format a number for display: trims trailing zeros and adds thousands separators.
 */
function formatNumber(float $number): string
{
    $number = round($number, 10);

    if (floor($number) === $number && abs($number) < 1e15) {
        return number_format($number, 0, '.', ',');
    }

    return rtrim(rtrim(number_format($number, 10, '.', ','), '0'), '.');
}

// A calculation is only attempted when all three GET parameters are present
if (isset($_GET['number1'], $_GET['number2'], $_GET['operation'])) {
    $number1   = trim((string) $_GET['number1']);
    $number2   = trim((string) $_GET['number2']);
    $operation = (string) $_GET['operation'];

    if (!array_key_exists($operation, $operations)) {
        $error = 'Please choose a valid operation.';
    } elseif (!is_numeric($number1) || !is_numeric($number2)) {
        $error = 'Please enter a valid number in both fields.';
    } elseif ($operation === 'divide' && (float) $number2 == 0.0) {
        $error = 'Cannot divide by zero.';
    } else {
        $first  = (float) $number1;
        $second = (float) $number2;

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

        $expression = formatNumber($first) . ' ' . $operations[$operation]['symbol'] . ' ' . formatNumber($second) . ' =';
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bincom Assignment 4 - Simple Calculator</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <div class="calculator-container">
    <div class="calculator-header">
      <h2>Simple Calculator</h2>
      <p>Bincom Academy - Assignment 4</p>
    </div>

    <div class="calculator">
      <!-- Screen / Display Area -->
      <div class="display">
        <div class="previous-operand">
          <?php echo $expression !== '' ? htmlspecialchars($expression, ENT_QUOTES) : '&nbsp;'; ?>
        </div>
        <div class="current-operand<?php echo $error !== '' ? ' is-error' : ''; ?>">
          <?php
          if ($error !== '') {
              echo htmlspecialchars($error, ENT_QUOTES);
          } elseif ($result !== null) {
              echo htmlspecialchars(formatNumber($result), ENT_QUOTES);
          } else {
              echo '0';
          }
          ?>
        </div>
      </div>

      <!-- GET form: the values travel in the URL as ?number1=...&number2=...&operation=... -->
      <form class="calculator-form" method="get" action="index.php" autocomplete="off">
        <div class="field">
          <label for="number1">Number 1</label>
          <input type="number" step="any" id="number1" name="number1"
                 value="<?php echo htmlspecialchars($number1, ENT_QUOTES); ?>"
                 placeholder="0" required>
        </div>

        <div class="field">
          <label for="operation">Operation</label>
          <select id="operation" name="operation">
            <?php foreach ($operations as $key => $op): ?>
              <option value="<?php echo htmlspecialchars($key, ENT_QUOTES); ?>"<?php echo $key === $operation ? ' selected' : ''; ?>>
                <?php echo htmlspecialchars($op['label'], ENT_QUOTES); ?>
              </option>
            <?php endforeach; ?>
          </select>
        </div>

        <div class="field">
          <label for="number2">Number 2</label>
          <input type="number" step="any" id="number2" name="number2"
                 value="<?php echo htmlspecialchars($number2, ENT_QUOTES); ?>"
                 placeholder="0" required>
        </div>

        <button type="submit" class="btn btn-equal">Calculate</button>
        <a class="clear-link" href="index.php">AC &mdash; Clear all</a>
      </form>
    </div>
  </div>

</body>
</html>
