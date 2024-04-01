/* LESSON 3 - Programming Tasks */

/* FUNCTIONS */
/* Function Definition - Add Numbers */
function add (number1, number2) {
    return number1+number2;
}

function addNumbers() {
    let addNumber1 = Number(document.querySelector('#add1').value);
    let addNumber2 = Number(document.querySelector('#add2').value);
    document.querySelector('#sum').value = add(addNumber1, addNumber2);
}

document.getElementById("addNumbers").addEventListener("click", addNumbers);

/* Function Expression - Subtract Numbers */
function subtract (number1, number2) {
    return number1 - number2;
}

function subtractNumbers() {
    let subNumber1 = Number(document.querySelector('#subtract1').value);
    let subNumber2 = Number(document.querySelector('#subtract2').value);
    document.querySelector('#difference').value = subtract(subNumber1, subNumber2);
}

document.querySelector('#subtractNumbers').addEventListener("click", subtractNumbers);


/* Arrow Function - Multiply Numbers */
const multiply = (number1, number2)=>number1*number2;

const multiplyNumbers = () => {
    let number1 = Number(document.querySelector('#factor1').value);
    let number2 = Number(document.querySelector('#factor2').value);
    document.querySelector('#product').value = multiply(number1, number2);
}

document.querySelector('#multiplyNumbers').addEventListener('click', multiplyNumbers);

/* Open Function Use - Divide Numbers */
const divide = (number1, number2)=>number1/number2;

const divideNumbers = () => {
    let number1 = Number(document.querySelector('#dividend').value);
    let number2 = Number(document.querySelector('#divisor').value);
    document.querySelector('#quotient').value = divide(number1, number2);
}

document.querySelector('#divideNumbers').addEventListener('click', divideNumbers);

/* Decision Structure */
const findTotal = () => {
    let subtotal = Number(document.querySelector('#subtotal').value);
    if (document.querySelector('#member').checked) {
        subtotal -= subtotal*0.15;
    }
    let total = subtotal.toFixed(2);
    document.querySelector('span#total').innerHTML = `$${total}`;
}
document.querySelector('#getTotal').addEventListener('click', findTotal);

/* ARRAY METHODS - Functional Programming */
let numbers = [1,2,3,4,5,6,7,8,9,10,11,12,13];
/* Output Source Array */
document.querySelector('#array').textContent = numbers;
/* Output Odds Only Array */
document.querySelector('#odds').textContent = numbers.filter((number) => number%2 == 1);

/* Output Evens Only Array */
document.querySelector('#evens').textContent = numbers.filter((number) => number%2 == 0);

/* Output Sum of Org. Array */
document.querySelector('#sumOfArray').innerHTML = numbers.reduce((total, item) => total + item);

/* Output Multiplied by 2 Array */
const multArray = numbers.map((number) => number*2);
document.querySelector('#multiplied').innerHTML = multArray;

/* Output Sum of Multiplied by 2 Array */
document.querySelector('#sumOfMultiplied').innerHTML = multArray.reduce((total, item) => total + item);