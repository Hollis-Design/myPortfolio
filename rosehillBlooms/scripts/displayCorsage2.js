var currentDivision = document.getElementById("column1");

var requestURL = 'data/corsagePics.json';
console.log(requestURL);
var request = new XMLHttpRequest();
request.open('GET', requestURL);
request.responseType = 'json';
request.send();

request.onload = function() {
    var pictureInfo = request.response;
    console.log(pictureInfo);
    storePictureInfo(pictureInfo);
}


function createHtmlPics(index, length, jsonObj)
{   var namePic = jsonObj['pictures'];

    for (var x = index; x < length; x++)
    {
        var myAnchor = document.createElement("A");
        myAnchor.target= "_blank";
        myAnchor.href = namePic[x].fileName;

        var myImg = document.createElement('img');
        myImg.src = namePic[x].fileName;
        myImg.alt = "Floral Picture";

        myAnchor.appendChild(myImg);
        currentDivision.appendChild(myAnchor);
    }
    return x;
}



function storePictureInfo(jsonObj) {
    var picName = jsonObj['pictures'];
    var numInColumn = Math.trunc(picName.length/3);

    var newIndex = createHtmlPics(0, numInColumn, jsonObj);
    currentDivision = document.getElementById("column2");
    newIndex = createHtmlPics(newIndex, numInColumn+newIndex+1, jsonObj);
    currentDivision = document.getElementById("column3");
    newIndex = createHtmlPics(newIndex, picName.length, jsonObj);
}



/*<script>
function myFunction() {
  var x = document.createElement("A");
  var t = document.createTextNode("Tutorials");
  x.setAttribute("href", "https://www.w3schools.com");
  x.appendChild(t);
  document.body.appendChild(x);
}
</script>
*/
