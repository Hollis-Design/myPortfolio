"use strict";
/*
   New Perspectives on HTML5 and CSS3, 8th Edition
   Tutorial 9
   Tutorial Case

   Countdown Clock
   Author: Christy Hollis
   Date:   November 2023

*/

runClock();

function runClock() {

   var currentDay = new Date;
   var dateStr = currentDay.toLocaleDateString();
   var timeStr = currentDay.toLocaleTimeString();

   /*Display the Current Date and Time */
   document.getElementById("dateNow").innerHTML = dateStr + "<br>" + timeStr;

   /*window.alert("Welcome to Northern Colorado"); */

   /*Calculate the days until the wedding */
   var weddingDate = new Date("December 20, 2023 9:00:00");
   /*var nextYear = currentDay.getFullYear() + 1;
   weddingDate.setFullYear(nextYear); */
   var daysLeft = (weddingDate - currentDay)/(1000*60*60*24);
   var hrsLeft = (daysLeft - Math.floor(daysLeft)) * 24;
   var minLeft = (hrsLeft - Math.floor(hrsLeft)) * 60
   var secLeft = (minLeft - Math.floor(minLeft)) * 60;

   document.getElementById("days").textContent = Math.floor(daysLeft);
   document.getElementById("hrs").textContent = Math.floor(hrsLeft);
   document.getElementById("mins").textContent = Math.floor(minLeft);
   document.getElementById("secs").textContent = Math.floor(secLeft);
}