/**
 * Bincom Assignment 4 - Simple Calculator
 * Handles arithmetic calculations, state management, and user interactions.
 */

class Calculator {
  constructor(previousOperandElement, currentOperandElement) {
    this.previousOperandElement = previousOperandElement;
    this.currentOperandElement = currentOperandElement;
    this.clear();
  }

  clear() {
    this.currentOperand = "0";
    this.previousOperand = "";
    this.operation = undefined;
    this.shouldResetScreen = false;
  }

  delete() {
    if (this.currentOperand === "Error") {
      this.clear();
      return;
    }
    if (this.shouldResetScreen) {
      return;
    }
    if (this.currentOperand.length <= 1) {
      this.currentOperand = "0";
    } else {
      this.currentOperand = this.currentOperand.slice(0, -1);
    }
  }

  appendNumber(number) {
    if (this.currentOperand === "Error" || (this.currentOperand === "0" && number !== ".") || this.shouldResetScreen) {
      if (number === ".") {
        this.currentOperand = "0.";
      } else {
        this.currentOperand = number.toString();
      }
      this.shouldResetScreen = false;
      return;
    }

    if (number === "." && this.currentOperand.includes(".")) {
      return;
    }

    // Prevent overly long numbers that overflow screen
    if (this.currentOperand.length >= 14) {
      return;
    }

    this.currentOperand += number.toString();
  }

  applyPercent() {
    if (this.currentOperand === "Error") return;
    const current = parseFloat(this.currentOperand);
    if (isNaN(current)) return;

    const result = current / 100;
    this.currentOperand = this.roundResult(result).toString();
  }

  chooseOperation(operation) {
    if (this.currentOperand === "Error") return;

    if (this.currentOperand === "" && this.previousOperand !== "") {
      this.operation = operation;
      return;
    }

    if (this.previousOperand !== "") {
      this.compute();
    }

    this.operation = operation;
    this.previousOperand = this.currentOperand;
    this.currentOperand = "";
  }

  compute() {
    if (this.currentOperand === "Error") return;

    let computation;
    const prev = parseFloat(this.previousOperand);
    const current = parseFloat(this.currentOperand);

    if (isNaN(prev) || isNaN(current)) return;

    switch (this.operation) {
      case "+":
        computation = prev + current;
        break;
      case "-":
      case "−":
        computation = prev - current;
        break;
      case "×":
      case "*":
        computation = prev * current;
        break;
      case "÷":
      case "/":
        if (current === 0) {
          this.currentOperand = "Error";
          this.previousOperand = "";
          this.operation = undefined;
          this.shouldResetScreen = true;
          return;
        }
        computation = prev / current;
        break;
      default:
        return;
    }

    this.currentOperand = this.roundResult(computation).toString();
    this.operation = undefined;
    this.previousOperand = "";
    this.shouldResetScreen = true;
  }

  roundResult(number) {
    // Avoid precision issues (e.g. 0.1 + 0.2 = 0.30000000000000004)
    return Math.round((number + Number.EPSILON) * 1e10) / 1e10;
  }

  formatDisplayNumber(numberStr) {
    if (numberStr === "Error") return "Error";
    if (numberStr === "" || numberStr === undefined) return "";

    const parts = numberStr.toString().split(".");
    const integerDigits = parseFloat(parts[0]);
    const decimalDigits = parts[1];

    let integerDisplay;
    if (isNaN(integerDigits)) {
      integerDisplay = "";
    } else {
      integerDisplay = integerDigits.toLocaleString("en", {
        maximumFractionDigits: 0
      });
    }

    if (decimalDigits != null) {
      return `${integerDisplay}.${decimalDigits}`;
    } else {
      return integerDisplay;
    }
  }

  updateDisplay() {
    this.currentOperandElement.innerText = this.formatDisplayNumber(this.currentOperand);

    if (this.operation != null) {
      this.previousOperandElement.innerText = `${this.formatDisplayNumber(this.previousOperand)} ${this.operation}`;
    } else {
      this.previousOperandElement.innerText = "";
    }
  }
}

// DOM Elements
const previousOperandElement = document.getElementById("previousOperand");
const currentOperandElement = document.getElementById("currentOperand");

const calculator = new Calculator(previousOperandElement, currentOperandElement);

// Event Listeners for UI buttons
document.querySelectorAll("[data-number]").forEach((button) => {
  button.addEventListener("click", () => {
    calculator.appendNumber(button.dataset.number);
    calculator.updateDisplay();
  });
});

document.querySelectorAll("[data-operation]").forEach((button) => {
  button.addEventListener("click", () => {
    calculator.chooseOperation(button.dataset.operation);
    calculator.updateDisplay();
  });
});

document.querySelectorAll("[data-action]").forEach((button) => {
  button.addEventListener("click", () => {
    const action = button.dataset.action;
    switch (action) {
      case "clear":
        calculator.clear();
        break;
      case "delete":
        calculator.delete();
        break;
      case "percent":
        calculator.applyPercent();
        break;
      case "equals":
        calculator.compute();
        break;
    }
    calculator.updateDisplay();
  });
});

// Keyboard support
window.addEventListener("keydown", (e) => {
  if ((e.key >= "0" && e.key <= "9") || e.key === ".") {
    calculator.appendNumber(e.key);
  } else if (e.key === "+" || e.key === "-") {
    calculator.chooseOperation(e.key);
  } else if (e.key === "*") {
    calculator.chooseOperation("×");
  } else if (e.key === "/") {
    e.preventDefault(); // Prevent browser quick-find
    calculator.chooseOperation("÷");
  } else if (e.key === "%") {
    calculator.applyPercent();
  } else if (e.key === "Enter" || e.key === "=") {
    e.preventDefault();
    calculator.compute();
  } else if (e.key === "Backspace") {
    calculator.delete();
  } else if (e.key === "Escape") {
    calculator.clear();
  }
  calculator.updateDisplay();
});
