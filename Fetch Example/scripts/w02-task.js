/* W02-Task - Profile Home Page */

/* Step 1 - Setup type tasks - no code required */

/* Step 2 - Variables */
let fullName = "Christy Hollis";
let currentYear = "2024";
let profilePicture = "images/headshot2.jpg";

/* Step 3 - Element Variables */
const nameElement = document.getElementById("name");
const foodElement = document.getElementById("food");
let yearElement = document.querySelector("#year");
let imageElement = document.querySelector("img");


/* Step 4 - Adding Content */
nameElement.innerHTML = `<strong>${fullName}</strong>`;
yearElement.textContent = currentYear;
imageElement.setAttribute('src', profilePicture);
imageElement.setAttribute('alt', `Profile image of ${fullName}`);


/* Step 5 - Array */

let favs = ["Chocolate", "Coconut Chicken Curry", "Onion Rings", "Steak"];
let foodItems = "";
for (const fav of favs) {
    foodItems += `${fav}, `;
}
foodElement.innerHTML = `<p>${foodItems}</br></p>`;

//Add an element
const anotherFav = "Salmon";
favs.push(anotherFav);
foodElement.innerHTML += `<p>${foodItems} ${favs[4]}</br></p>`; 

//Remove the first element
favs.shift();
foodElement.innerHTML += `<p>${favs}</br></p>`;

//Remove the last element
favs.pop();
foodElement.innerHTML += `<p>${favs}</br></p>`;

//Alternative shortcut:
//foodElement.textContent = favs;

