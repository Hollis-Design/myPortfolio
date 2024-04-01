/* LESSON 3 - Programming Tasks */

/* FUNCTIONS */
/* Function Definition - Add Numbers */   
function add (number1, number2) {
    return number1 + number2;    
}

function addNumbers (add1, add2) {
    let addNumber1 = Number(document.querySelector("#add1").value); 
    let addNumber2 = Number(document.querySelector("#add2").value);   

    document.querySelector("#sum").value = add(addNumber1, addNumber2);
}

document.querySelector("#addNumbers").addEventListener("click", addNumbers);

/* Function Expression - Subtract Numbers */
function subtract (number1, number2) {
    return number1 - number2;    
}

function subtractNumbers (subtract1, subtract2) {
    let subtractNumber1 = Number(document.querySelector("#subtract1").value); 
    let subtractNumber2 = Number(document.querySelector("#subtract2").value);   

    document.querySelector("#difference").value = subtract(subtractNumber1, subtractNumber2);
}

document.querySelector("#subtractNumbers").addEventListener("click", subtractNumbers);

/* Arrow Function - Multiply Numbers */
const multiply = (x, y) => x * y;

const multiplyNumbers = () => {

    let factor1 = Number(document.getElementById("factor1").value);
    let factor2 = Number(document.getElementById("factor2").value);
    let product = multiply (factor1, factor2);
    document.getElementById("product").value = product.toFixed(0);

};
document.getElementById("multiplyNumbers").addEventListener("click", multiplyNumbers);

/* Open Function Use - Divide Numbers */
const divide = (x, y) => x / y;

const divideNumbers = () => {
    let dividend = parseFloat(document.getElementById("dividend").value);
    let divisor = parseFloat(document.getElementById("divisor").value);
    let quotient = divide (dividend, divisor);
    document.getElementById("quotient").value = quotient.toFixed(0);
};

document.getElementById("divideNumbers").addEventListener("click", divideNumbers);   

/* Decision Structure */
function getTotal() {
//input
    let subtotal = parseFloat(document.getElementById("subtotal").value);
//processing
    if (document.getElementById("member").checked) {
        subtotal = subtotal - subtotal * 0.15; //15% discount
    }
//uotput
    document.getElementById("total").textContent = `$${subtotal.toFixed(2)}`;

}

document.getElementById("getTotal").addEventListener("click", getTotal);

/* ARRAY METHODS - Functional Programming */
/* Output Source Array */
let numbersArray = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13];
document.getElementById("array").innerHTML = numbersArray.join(", ");

/* Output Odds Only Array */
let impares = numbersArray.filter(elemento => elemento % 2 !== 0);
/*let contenidoHTML = impares.map(elemento => `<p>${elemento}</p>`).join(''); */
document.getElementById("odds").innerHTML = impares.join(", ");
 

/* Output Evens Only Array */
let evens = numbersArray.filter(elemento => elemento % 2 === 0);
document.getElementById("evens").innerHTML = evens.join(", ");

/* Output Sum of Org. Array */
numbersArray.reduce((sum, number) => sum + number)
/* Output Multiplied by 2 Array */
numbersArray.map(number => number * 2)
/* Output Sum of Multiplied by 2 Array */

document.querySelector('#sumOfArray').innerHTML = numbers.reduce((total, item) => total + item);

/* Output Multiplied by 2 Array */
const multArray = numbers.map((number) => number*2);
document.querySelector('#multiplied').innerHTML = multArray;

/* Output Sum of Multiplied by 2 Array */
document.querySelector('#sumOfMultiplied').innerHTML = multArray.reduce((total, item) => total + item);