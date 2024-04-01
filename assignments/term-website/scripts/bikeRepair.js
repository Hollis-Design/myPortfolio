var myTable = document.querySelector('table');

var requestURL = 'data/bikeRepair.json';
var request = new XMLHttpRequest();
request.open('GET', requestURL);
request.responseType = 'json';
request.send();

request.onload = function() {
    var serviceInfo = request.response;
    console.log(serviceInfo);
    storeServiceInfo(serviceInfo);
}

function storeServiceInfo(jsonObj) {
    var service = jsonObj['repairs'];
    var myTbody = document.createElement('tbody');

    for (var i = 0; i < service.length; i++)
    {
        var myTr = document.createElement('tr');
        myTable.appendChild(myTr);

        var myTd1 = document.createElement('td');
        var myTd2 = document.createElement('td');

        myTd1.textContent = service[i].type;
        myTd2.textContent = '$' + service[i].price;

        myTable.appendChild(myTd1);
        myTable.appendChild(myTd2);
    }
}
