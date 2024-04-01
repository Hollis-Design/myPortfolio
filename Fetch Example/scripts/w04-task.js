/* LESSON 3 - Programming Tasks */

/* Profile Object  */
let myProfile = {
    name: "Sister Christy Hollis",
    photo: "images/headshot2.jpg",
    favoriteFoods: ["Chocolate", "Coconut Chicken Curry", "Onion Rings", "Steak"],
    hobbies: ["skiing", "hiking", "playing the piano", "programming"],
    placesLived: [],
};

/* Populate Profile Object with placesLive objects */
myProfile.placesLived.push (
    {
        place: 'Provo, UT',
        length: '4 years'
    }
);

myProfile.placesLived.push (
    {
        place: 'Nebraska',
        length: '18 years'
    }
);

myProfile.placesLived.push (
    {
        place: 'Missouri',
        length: '1 year'
    }
);

myProfile.placesLived.push (
    {
        place: 'Colorado',
        length: '25 years'
    }
);

myProfile.placesLived.push (
    {
        place: 'Wisconsin',
        length: '1 year'
    }
);

/* DOM Manipulation - Output */

/* Name */
document.querySelector("#name").textContent = myProfile.name;


/* Photo with attributes */
document.querySelector("#photo").setAttribute('src', myProfile.photo);
document.querySelector("#photo").setAttribute('alt', myProfile.name);

/* Favorite Foods List*/

myProfile.favoriteFoods.forEach((food) => {
    let newListElement = document.createElement("li");
    newListElement.textContent = food;
    document.querySelector('#favorite-foods').appendChild(newListElement);
});

/* Hobbies List */
myProfile.hobbies.forEach((hobby) => {
    let newListElement = document.createElement('li');
    newListElement.textContent = hobby;
    document.querySelector('#hobbies').appendChild(newListElement);
});

/* Places Lived DataList */
myProfile.placesLived.forEach(place =>  {
    let dt = document.createElement('dt');
    dt.textContent = place.place;
    document.querySelector("#places-lived").appendChild(dt);
    let dd = document.createElement('dd');
    dd.textContent = place.length;
    document.querySelector("#places-lived").appendChild(dd);
});