var section = document.querySelector('section');

var requestURL = 'https://byui-cit230.github.io/weather/data/towndata.json';
var request = new XMLHttpRequest();
request.open('GET', requestURL);
request.responseType = 'json';
request.send();

request.onload = function() {
    var townInfo = request.response;
    storeTownData(townInfo);
}

function storeTownData(jsonObj) {
    var city = jsonObj['towns'];

    for (var i = 0; i < city.length; i++)
    {
        if (city[i].name == 'Franklin')/*|| towns[i].name == 'Greenville' || towns[i].name == 'Springfield')*/
        {
            document.getElementById("franklinMotto").innerHTML = 'Motto: ' + city[i].motto;
            document.getElementById("franklinFounded").innerHTML = 'Year Founded: ' + city[i].yearFounded;
            document.getElementById("franklinPop").innerHTML = 'Current Population: ' + city[i].currentPopulation;
            document.getElementById("franklinRainfall").innerHTML = 'Average Rainfall: ' + city[i].averageRainfall;

        }
        else if (city[i].name == 'Greenville')
        {
            document.getElementById("greenvilleMotto").innerHTML = 'Motto: ' + city[i].motto;
            document.getElementById("greenvilleFounded").innerHTML = 'Year Founded: ' + city[i].yearFounded;
            document.getElementById("greenvillePop").innerHTML = 'Current Population: ' + city[i].currentPopulation;
            document.getElementById("greenvilleRainfall").innerHTML = 'Average Rainfall: ' + city[i].averageRainfall;

        }
        else if (city[i].name == 'Springfield')
        {
            document.getElementById("springfieldMotto").innerHTML = 'Motto: ' + city[i].motto;
            document.getElementById("springfieldFounded").innerHTML = 'Year Founded: ' + city[i].yearFounded;
            document.getElementById("springfieldPop").innerHTML = 'Current Population: ' + city[i].currentPopulation;
            document.getElementById("springfieldRainfall").innerHTML = 'Average Rainfall: ' + city[i].averageRainfall;

        }
    }
}


