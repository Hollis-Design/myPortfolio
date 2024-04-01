
const myArray = ['one', 'two', 'three'];

//Convert array of strings into an array of HTML list items
const new_array = myArray.map((name) => `<li>${name}</li>`);

//Set list of HTML strings into the myList list
document.getElementById("myList").innerHTML = new_array.join('');

//Map grades to GPA points
const grades = ["A", "B", "A"];
const gpaPoints = grades.map(convertToGPA);

function convertToGPA(grade) {
  switch (grade) {
    case "A":
      return 4;
    case "B":
      return 3;
    case "C":
      return 2;
    case "D":
      return 1;
    case "F":
      return 0;
  }
};
document.querySelector("#myList").innerHTML = gpaPoints.join();

//Activity 3 - Reduce
/*
const gpaPoints = grades.map(convertGradeToPoints);
const pointsTotal = gpaPoints.reduce(function (total, item) {
  return total + item;
});
const gpa = pointsTotal / gpaPoints.length;

// example 2
// this is the same thing as above, but with an arrow function
const pointsTotal = gpaPoints.reduce((total, item) => total + item);
const gpa = pointsTotal / gpaPoints.length;
*/

//example 3
const gpa = gpaPoints.reduce((gpaTotal, gpaPoint) => gpaTotal + gpaPoint)/gpaPoints.length;
document.querySelector("#myList").innerHTML += `<br>${gpa}`;

//Activity 4 - Filter
/*
const words = ["watermelon", "peach", "apple", "tomato", "grape"];
const shortWords = words.filter(function (word) {
  return word.length < 6;
});
*/


const foods = ['watermelon', 'peach', 'apple', 'tomato', 'grape'];

const result = foods.filter((food) => food.length > 6);

document.querySelector("#myList").innerHTML += `<br>${result}`;


//Activity 5 - indexOf
const numArray = [12, 34, 21, 54];

const luckNumber = 21;

let index = numArray.indexOf(luckNumber);
document.querySelector("#myList").innerHTML += `<br>Index of Lucky #:${index}`;

//Event Handlers
const buttonElement = document.getElementById("submitButton");

function copyInput(event) {
  console.log(event);
  const inputElement = document.getElementById("inputBox");
  const outputElement = document.getElementById("output");
  outputElement.innerHTML = inputElement.value;
}
buttonElement.addEventListener("click", copyInput);

let tasks=[];

function renderTasks(tasks) {
  // get the list element from the DOM
  const listElement = document.querySelector('#todoList');

  // make sure it is empty
  listElement.innerHTML = "";

  // loop through the tasks array. for each of them we need to add the HTML markup for each todo to the list element.
  tasks.forEach((task) => {
    listElement.innerHTML += `<li ${task.completed ? 'class="strike"' : ""}>
      <p>${task.detail}</p>
      <div>
        <span data-function="delete">❎</span>
        <span data-function="complete">✅</span>
      </div>
    </li>`
  });
    
}

function newTask() {
  // get the value entered into the #todo input
  const task = document.querySelector("#todo").value;
 // const toDoValue = toDoElement.value;
  // add it to our arrays tasks
  tasks.push({detail: task, completed: false});
  // render out the list.
  renderTasks(tasks);
}

function removeTask(taskElement) {
  // note the use of Array.filter to remove the element from our task array
  tasks = tasks.filter(
    (task) => task.detail != taskElement.childNodes[0].innerText
  );
  // this line removes the HTML element from the DOM
  taskElement.remove();
}

function completeTask(taskElement) {
  // In this case we need to find the index of the task so we can modify it.
  const taskIndex = tasks.findIndex(
    (task) => task.detail === taskElement.childNodes[0].innerText
  );
  // once we have the index we can modify the complete field.
  // tasks[taskIndex].completed ? false : true is a ternary expression.
  // If the first part is true (left of the ?), then the value on the left of the : will get returned, otherwise the value on the right of the : will be returned.
  tasks[taskIndex].completed = tasks[taskIndex].completed ? false : true;
  // toggle adds a class if it is not there, removes it if it is.
  taskElement.classList.toggle("strike");
  console.log(tasks);
}

function manageTasks(event) {
  // did they click the delete or complete icon?
  console.log(event.target);
  console.log(event.currentTarget);
  // event.target will point to the actual icon clicked on. We need to get the parent li to work with however. HINT: Remember element.closest()? Look it up if you don't
  const parent = event.target.closest("li");
    // because we added 'data-function="delete"' to each icon in a task we can access a dataset property on our target
  // use that in a couple of if statements to decide whether to run removeTask or completeTask
    if (event.target.dataset.function === "delete") {
      removeTask(parent);
    }
    if (event.target.dataset.function === "complete") {
      completeTask(parent);
    }
}

// we need to attach listeners to the submit button and the list. Listen for a click, call the 'newTask' function on submit and call the 'manageTasks' function if either of the icons are clicked in the list of tasks.
const submitButtonElement = document.getElementById('submitTask');
submitButtonElement.addEventListener('click', newTask);
const listButtonElement = document.querySelector("todoList");
listButtonElement.addEventListener('click', manageTasks);

renderTasks(tasks);