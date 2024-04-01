let firstName = 'Anotonia';
let lastName = 'Francesca';

function fullName(first, last) {
    return `${first} ${last}`;
}

const fullName = function(first, last) {
    return `${first} ${last}`;  
}

//Calls and defines the function at the same time
const fullName = (firstName, lastName) => `${firstName} ${lastName}`; 

//Expression that calls fullName and writes the result to an existing HTML element's text node with ID of fullName
document.querySelector('#fullName').innerHTML = fullName(firstName, lastName);

let names = ['Nancy', 'Blessing', 'jorge', 'Svetlana', 'Bob'];
//array.filter() method
let namesB = names.filter(name => name.charAt(0) === 'B');

//array.map()method
let namesLength = names.map((name)=>name.length);

//array.reduce() method
names.reduce((total, currentName) => total + currentName.length, 0)/ names.length;




