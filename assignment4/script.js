// Display elements
const currentDisplay = document.getElementById("currentOperand");
const previousDisplay = document.getElementById("previousOperand");

// State variables
let currentInput = "0";
let previousInput = "";
let operator = null;

// Update the screen display
function updateDisplay() {
  currentDisplay.innerText = currentInput;
  previousDisplay.innerText = operator ? `${previousInput} ${operator}` : "";
}

// Append a number or decimal point
function appendNumber(num) {
  if (currentInput === "0" && num !== ".") {
    currentInput = num;
  } else if (num === "." && currentInput.includes(".")) {
    return;
  } else {
    currentInput += num;
  }
  updateDisplay();
}

// Select an arithmetic operator
function setOperator(op) {
  if (currentInput === "" || currentInput === "Error") return;
  if (previousInput !== "") calculate();
  operator = op;
  previousInput = currentInput;
  currentInput = "";
  updateDisplay();
}

// Compute the result
function calculate() {
  const prev = parseFloat(previousInput);
  const current = parseFloat(currentInput);

  if (isNaN(prev) || isNaN(current)) return;

  let result;
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
    default:
      return;
  }

  currentInput = result.toString();
  operator = null;
  previousInput = "";
  updateDisplay();
}

// Clear all inputs
function clearAll() {
  currentInput = "0";
  previousInput = "";
  operator = null;
  updateDisplay();
}

// Delete the last character
function deleteLast() {
  if (currentInput === "Error" || currentInput.length <= 1) {
    currentInput = "0";
  } else {
    currentInput = currentInput.slice(0, -1);
  }
  updateDisplay();
}

// Convert current number to percentage
function applyPercent() {
  if (currentInput !== "Error" && currentInput !== "") {
    currentInput = (parseFloat(currentInput) / 100).toString();
    updateDisplay();
  }
}

// Button click listeners
document.querySelectorAll(".btn").forEach((button) => {
  button.addEventListener("click", () => {
    if (button.dataset.number) {
      appendNumber(button.dataset.number);
    } else if (button.dataset.operation) {
      setOperator(button.dataset.operation);
    } else if (button.dataset.action === "clear") {
      clearAll();
    } else if (button.dataset.action === "delete") {
      deleteLast();
    } else if (button.dataset.action === "percent") {
      applyPercent();
    } else if (button.dataset.action === "equals") {
      calculate();
    }
  });
});

// Keyboard input support
window.addEventListener("keydown", (e) => {
  if ((e.key >= "0" && e.key <= "9") || e.key === ".") appendNumber(e.key);
  if (e.key === "+" || e.key === "-") setOperator(e.key);
  if (e.key === "*") setOperator("×");
  if (e.key === "/") setOperator("÷");
  if (e.key === "%") applyPercent();
  if (e.key === "Enter" || e.key === "=") calculate();
  if (e.key === "Backspace") deleteLast();
  if (e.key === "Escape") clearAll();
});
