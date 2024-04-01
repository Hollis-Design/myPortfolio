var myArticle = document.querySelector('article');

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

function storePictureInfo(jsonObj) {
    var picName = jsonObj['pictures'];

    for (var i = 0; i < picName.length; i++)
    {
        var myAnchor = document.createElement("A");
        myAnchor.target = "_blank";
        myAnchor.href = picName[i].fileName;

        var myImg = document.createElement('img');
        myImg.src = picName[i].reference;
        myImg.alt = "Floral Picture";

        myAnchor.appendChild(myImg);
        myArticle.appendChild(myAnchor);
    }
}

