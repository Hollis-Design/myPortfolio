function windChill()
{
var high = parseFloat(document.getElementById('high').textContent);
var low = parseFloat(document.getElementById('low').textContent);
var temp = (high-low)/2;

var windSpeed = parseFloat(document.getElementById('speed').textContent);

var wChillFactor = 35.74 + 0.6215*temp - 35.75*Math.pow(windSpeed, 0.16) + 0.4275*temp*Math.pow(windSpeed, 0.16);

var
document.getElementById("dateToday").innerHTML = completeDate;
}
