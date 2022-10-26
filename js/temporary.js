

let nameVar = document.getElementById('name');





/*
<body>
    <div>
    <div/>
<body/>
*/


var newDiv = document.createElement("div");
newDiv.classList.add('primary');
newDiv.classList.add('secondary');

body.appendChild(newDiv);







newCardFooterLink.setAttribute("onclick", "myFunction(" + 10 + "," +  25 + ")");








newCardFooterLink.classList.add('card-footer-item');
newCardFooterLink.innerHTML = "View";
newCardFooter.appendChild(newCardFooterLink);











newChildTile.classList.add('tile');
newChildTile.classList.add('is-child');
newChildTile.classList.add('p-2');
newChildTile.classList.add('is-6');



function createNewShitsaHTML(){
    //validate if nameVar is Khalel
}

















function myFunction() {
    $.post("./classes/controller.php", {
        variable1: 'eldrin'

    }, function (data) {
        var jsonArray = JSON.parse(data);
        jsonArray[0][0];

        print(data);



    });
}

//btn.onclick(myFunction);

function myFunction() {
    //change text color to red
}
