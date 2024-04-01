//javascript for weather

var weatherObject = new XMLHttpRequest();

weatherObject.open('GET', 'http://api.wunderground.com/api/dc149e24bae90b86/conditions/q/MN/Franklin.json', true);

weatherObject.send();

weatherObject.onload = function() {

    var weatherInfo = JSON.parse(weatherObject.responseText);

    console.log(weatherInfo);

    document.getElementById("currentWeather").innerHTML = weatherInfo.current_observation.weather;
    document.getElementById("currentTemp").innerHTML = weatherInfo.current_observation.temp_f;
    document.getElementById("speed").innerHTML = weatherInfo.current_observation.wind_mph;
    document.getElementById("direction").innerHTML = weatherInfo.current_observation.wind_dir;
    document.getElementById("weatherIcon").src = weatherInfo.current_observation.icon_url;
    document.getElementById("chill").innerHTML = weatherInfo.current_observation.windchill_f;

} //end of onload

var forecastObject = new XMLHttpRequest();

forecastObject.open('POST', 'http://api.wunderground.com/api/dc149e24bae90b86/forecast/q/MN/Franklin.json', true);

forecastObject.send();

forecastObject.onload = function(){

    var forecastInfo = JSON.parse(forecastObject.responseText);

    console.log(forecastInfo);

    document.getElementById("high").innerHTML = forecastInfo.forecast.simpleforecast.forecastday["0"].high.fahrenheit;
    document.getElementById("low").innerHTML = forecastInfo.forecast.simpleforecast.forecastday["0"].low.fahrenheit;
    document.getElementById("forecastText").innerHTML = forecastInfo.forecast.txt_forecast.forecastday["0"].fcttext;

} //end of onload
