/* W05: Programming Tasks */

/* Declare and initialize global variables */
const templesElement = document.getElementById("temples");
let templeList = [];

/* async displayTemples Function */
const displayTemples = (temples) => {
    temples.forEach((temple)=>{
        const myArticle = document.createElement("article");
        const h3Element = document.createElement('h3');
        h3Element.textContent = temple.templeName;
        const imgElement = document.createElement("img");
        imgElement.setAttribute("src", temple.imageUrl);
        imgElement.setAttribute("alt", temple.location);
        myArticle.appendChild(h3Element);
        myArticle.appendChild(imgElement);
        templesElement.appendChild(myArticle);
    });
}

/* async getTemples Function using fetch()*/
const getTemples = async() => {
    const response = await fetch("https://run.mocky.io/v3/bd655eb0-1a4a-47d1-b6ed-5812f1adeb88");
    templeList = await response.json();
    displayTemples(templeList);
}

/* reset Function */
const reset = () => {
    document.getElementById("temples").innerHTML = "";
}

/* filterTemples Function */

function isOlderTemple(temple) {
    const dedicate = parseInt(temple.dedicated.slice(0,4));
    return dedicate < 1950;
}

function filterTemples(temples) {
    reset();
    const filter = document.getElementById("filtered").value;
    let filteredTemples;
    
    switch (filter) {
        case "utah": 
            filteredTemples = temples.filter((temple) => temple.location.toLowerCase().includes("utah"));
        break;
        
        case "notutah":
            filteredTemples = temples.filter((temple) => !(temple.location.toLowerCase().includes("utah")));
        break;

        case "older":
            filteredTemples = temples.filter(isOlderTemple);
        break;

        default:
            filteredTemples = temples;
    }
    displayTemples(filteredTemples);
}

getTemples();

console.log(templeList);
/* Event Listener */

const optionElement = document.createElement("option");
optionElement.setAttribute("value", "alphabetical");
optionElement.textContent = ("Alphabetical");
const filtered = document.getElementById("filtered");
filtered.appendChild(optionElement);
document.getElementById("filtered").addEventListener("change", () => {filterTemples(templeList)});