const arrayLengthHidden = document.getElementById('arrayLengthHidden');
const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');
let indicator = document.getElementById('indicator')
let searchBarInput = document.getElementById('searchBarInput')

const addModal = document.getElementById('addModal');

let currentPageNumber = 1;

//MODALS
function openAdd() {
    addModal.classList.add('is-active');
    //populateUsernameAdd();
}

function closeAdd() {
    clearAddFormHelp();
    clearAddFormInput();

    submitAddFormHelp.className = "help"
    submitAddFormHelp.innerText = ""

    addModal.classList.remove('is-active');

    //removeSelectAdd(document.getElementById('usernameAdd'));
}

//DELETE AJAX CALL
function deleteAjax(deleteVar) {
    if (confirm("Are you sure?")) {
        $.post("./classes/delete-client-controller.class.php", {
            clientIdDelete: deleteVar
        }, function (data) {
            //$("#submitAddFormHelp").html(data);
            //$("#submitAddFormHelp").attr('class', 'help is-success');
            //clearAddFormHelp();
            //clearAddFormInput();
            //addModal.classList.remove('is-active');
            alert(data);
            refreshList();
        });
    }
}


function testAjax() {
    prompt("deleteVar");
}

//ADD AJAX CALLS WITH VALIDATION
let submitAddForm = document.getElementById('submitAddForm'); //save changes button
let submitAddFormHelp = document.getElementById('submitAddFormHelp'); //save changes button

let clientNameAdd = document.getElementById('clientNameAdd');

let clientNameAddHelp = document.getElementById('clientNameAddHelp');


function addAjax() {
    $.post("./classes/add-client-controller.class.php", {
        clientNameAdd: clientNameAdd.value

    }, function (data) {
        $("#submitAddFormHelp").html(data);
        //$("#submitAddFormHelp").attr('class', 'help is-success');
        clearAddFormHelp();
        clearAddFormInput();
        //addModal.classList.remove('is-active');
        refreshList();
    });
}

var pattern1 = /^[a-zA-Z0-9_]+$/
var pattern2 = /^[a-zA-Z0-9\s]+$/
var pattern3 = /^[a-zA-Z\s]+$/
var pattern4 = /^[0-9]+$/

submitAddForm.addEventListener('click', (e) => {
    clearAddFormHelp();
    //clearAddFormInput();

    let clientNameAddMessages = []


    //Username Validation

    if (pattern1.test(clientNameAdd.value) == false) {
        clientNameAdd.className = "input is-danger is-rounded"
        clientNameAddHelp.className = "help is-danger"
        clientNameAddMessages.push('Client name should only consist of numbers, letters!')
    }

    if (clientNameAdd.value === "" || clientNameAdd.value == null) {
        clientNameAdd.className = "input is-danger is-rounded"
        clientNameAddHelp.className = "help is-danger"
        clientNameAddMessages.push('Client name is required!')
    }

    if (clientNameAdd.value.length >= 255) {
        clientNameAdd.className = "input is-danger is-rounded"
        clientNameAddHelp.className = "help is-danger"
        clientNameAddMessages.push('Client name must be less than 255 characters!')
    }

    //Messages
    if (clientNameAddMessages.length > 0) {
        e.preventDefault()
        clientNameAddHelp.innerText = clientNameAddMessages.join(', ');
    }

    if (
        clientNameAddMessages.length <= 0
    ) {
        addAjax();
    }

})

function clearAddFormHelp() {
    //RESETTING FORM ELEMENTS
    clientNameAdd.className = "input is-rounded"
    clientNameAddHelp.className = "help"
    clientNameAddHelp.innerText = ""
}

function clearAddFormInput() {
    clientNameAdd.value = null;

}
/*
function populateSelect() {
    $.post("./classes/load-company-role-select.class.php", {
    }, function (data) {

        var jsonArray = JSON.parse(data);

        for (var i = 0; i < jsonArray.length; i++) {
            var newOption = document.createElement("option");
            newOption.value = jsonArray[i][0];
            newOption.innerHTML = jsonArray[i][1];
            roleNameAdd.options.add(newOption);
        }

        //closeSelect();
    });
}

populateSelect();
*/

//EMPLOYEE LIST
function generateUserList1() {
    $.post("./classes/load-client-all.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        var finalLength = Math.ceil(jsonArray.length / 4)
        arrayLengthHidden.innerHTML = finalLength;
    });
}

function generateUserList2(currentPageNumberVar, orderByVar) {
    $.post("./classes/load-client.class.php", {
        currentPageNumber: currentPageNumberVar,
        orderBy: orderByVar
    }, function (data) {

        var jsonArray = JSON.parse(data);


        if (currentPageNumber <= arrayLengthHidden.innerHTML) {
            indicator.innerHTML = "success";

            var newParentTile = document.createElement("div");
            newParentTile.classList.add('tile');
            newParentTile.classList.add('is-parent');
            ancestorTile.appendChild(newParentTile);

            for (var i = 0; i < jsonArray.length; i++) {

                var newChildTile = document.createElement("div");
                newChildTile.classList.add('tile');
                newChildTile.classList.add('is-child');
                newChildTile.classList.add('p-2');
                newChildTile.classList.add('is-3');

                //CARD
                var newCard = document.createElement("div");
                newCard.classList.add('card');
                newChildTile.appendChild(newCard);

                //CARD HEADER
                var newCardHeader = document.createElement("header");
                newCardHeader.classList.add('card-header');
                newCard.appendChild(newCardHeader);

                //CARD HEADER PARAGRAPH
                var newCardHeaderParagraph = document.createElement("p");
                newCardHeaderParagraph.classList.add('card-header-title');
                //newCardHeaderParagraph.innerHTML = jsonArray[i][4];
                newCardHeader.appendChild(newCardHeaderParagraph);

                //CARD HEADER BUTTON
                var newCardHeaderButton = document.createElement("button");
                newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + jsonArray[i][0] + "')");
                newCardHeaderButton.classList.add('card-header-icon');
                newCardHeader.appendChild(newCardHeaderButton);

                var newCardHeaderButtonSpan = document.createElement("span");
                newCardHeaderButtonSpan.classList.add('icon');
                newCardHeaderButton.appendChild(newCardHeaderButtonSpan);

                var newCardHeaderButtonSpanI = document.createElement("i");
                newCardHeaderButtonSpanI.classList.add('fa-solid');
                newCardHeaderButtonSpanI.classList.add('fa-xmark');
                newCardHeaderButtonSpan.appendChild(newCardHeaderButtonSpanI);

                //newCardHeaderButton.innerHTML = jsonArray[i][4];
                //newCardHeader.appendChild(newCardHeaderParagraph);

                //CARD CONTENT
                var newCardContent = document.createElement("div");
                newCardContent.classList.add('card-content');
                newCard.appendChild(newCardContent);

                //CARD CONTENT MEDIA
                var newCardContentMedia = document.createElement("div");
                newCardContentMedia.classList.add('media');
                newCardContent.appendChild(newCardContentMedia);

                //CARD CONTENT MEDIA-CONTENT
                var newCardContentMediaContent = document.createElement("div");
                newCardContentMediaContent.classList.add('media-content');
                newCardContentMediaContent.classList.add('has-text-centered');
                newCardContentMedia.appendChild(newCardContentMediaContent);

                //CARD CONTENT MEDIA-CONTENT FIGURE
                var newCardContentMediaContentFigure = document.createElement("figure");
                newCardContentMediaContentFigure.classList.add('image');
                newCardContentMediaContentFigure.classList.add('is-96x96');
                newCardContentMediaContentFigure.classList.add('is-inline-block');
                newCardContentMediaContent.appendChild(newCardContentMediaContentFigure);

                //CARD CONTENT MEDIA-CONTENT FIGURE IMAGE
                var newCardContentMediaContentFigureImage = document.createElement("img");
                newCardContentMediaContentFigureImage.classList.add('is-rounded');
                newCardContentMediaContentFigureImage.setAttribute("src", "https://bulma.io/images/placeholders/96x96.png");
                newCardContentMediaContentFigure.appendChild(newCardContentMediaContentFigureImage);

                //CARD CONTENT MEDIA-CONTENT TITLE
                var newCardContentMediaContentTitle = document.createElement("p");
                newCardContentMediaContentTitle.classList.add('title');
                newCardContentMediaContentTitle.classList.add('is-4');
                newCardContentMediaContentTitle.innerHTML = jsonArray[i][1];
                newCardContentMediaContent.appendChild(newCardContentMediaContentTitle);

                /*CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardContentMediaContentSubtitle = document.createElement("p");
                newCardContentMediaContentSubtitle.classList.add('subtitle');
                newCardContentMediaContentSubtitle.classList.add('is-6');
                newCardContentMediaContentSubtitle.innerHTML = "@" + jsonArray[i][0];
                newCardContentMediaContent.appendChild(newCardContentMediaContentSubtitle);*/

                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardFooter = document.createElement("footer");
                newCardFooter.classList.add('card-footer');
                newCard.appendChild(newCardFooter);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
                var newCardFooterLink = document.createElement("a");
                newCardFooterLink.setAttribute("onclick", "redirectToClientProfile('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "')");
                newCardFooterLink.classList.add('card-footer-item');
                newCardFooterLink.innerHTML = "Manage";
                newCardFooter.appendChild(newCardFooterLink);

                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }

    });
}


function generateUserList3(searchTerm) {
    $.post("./classes/load-client-all.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        //indicator.innerHTML = "live:" + jsonArray.length;

        for (var i = 0; i < jsonArray.length; i++) {

            switch (searchTerm) {

                case jsonArray[i][1]:
                    console.clear();
                    console.log("Client Name")
                    indicator.innerHTML = "Client Name";
                    generateUserList4(jsonArray[i][0], jsonArray[i][1]);
                    break;

            }

        }

    });

}

function generateUserList4(idVar, nameVar) {
    ancestorTile.innerHTML = "";
    var newParentTile = document.createElement("div");
    newParentTile.classList.add('tile');
    newParentTile.classList.add('is-parent');
    ancestorTile.appendChild(newParentTile);
    var newChildTile = document.createElement("div");
    newChildTile.classList.add('tile');
    newChildTile.classList.add('is-child');
    newChildTile.classList.add('p-2');
    newChildTile.classList.add('is-3');

    //CARD
    var newCard = document.createElement("div");
    newCard.classList.add('card');
    newChildTile.appendChild(newCard);

    //CARD HEADER
    var newCardHeader = document.createElement("header");
    newCardHeader.classList.add('card-header');
    newCard.appendChild(newCardHeader);

    //CARD HEADER PARAGRAPH
    var newCardHeaderParagraph = document.createElement("p");
    newCardHeaderParagraph.classList.add('card-header-title');
    //newCardHeaderParagraph.innerHTML = jsonArray[i][4];
    newCardHeader.appendChild(newCardHeaderParagraph);

    //CARD HEADER BUTTON
    var newCardHeaderButton = document.createElement("button");
    newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + idVar + "')");
    newCardHeaderButton.classList.add('card-header-icon');
    newCardHeader.appendChild(newCardHeaderButton);

    var newCardHeaderButtonSpan = document.createElement("span");
    newCardHeaderButtonSpan.classList.add('icon');
    newCardHeaderButton.appendChild(newCardHeaderButtonSpan);

    var newCardHeaderButtonSpanI = document.createElement("i");
    newCardHeaderButtonSpanI.classList.add('fa-solid');
    newCardHeaderButtonSpanI.classList.add('fa-xmark');
    newCardHeaderButtonSpan.appendChild(newCardHeaderButtonSpanI);

    //newCardHeaderButton.innerHTML = jsonArray[i][4];
    //newCardHeader.appendChild(newCardHeaderParagraph);

    //CARD CONTENT
    var newCardContent = document.createElement("div");
    newCardContent.classList.add('card-content');
    newCard.appendChild(newCardContent);

    //CARD CONTENT MEDIA
    var newCardContentMedia = document.createElement("div");
    newCardContentMedia.classList.add('media');
    newCardContent.appendChild(newCardContentMedia);

    //CARD CONTENT MEDIA-CONTENT
    var newCardContentMediaContent = document.createElement("div");
    newCardContentMediaContent.classList.add('media-content');
    newCardContentMediaContent.classList.add('has-text-centered');
    newCardContentMedia.appendChild(newCardContentMediaContent);

    //CARD CONTENT MEDIA-CONTENT FIGURE
    var newCardContentMediaContentFigure = document.createElement("figure");
    newCardContentMediaContentFigure.classList.add('image');
    newCardContentMediaContentFigure.classList.add('is-96x96');
    newCardContentMediaContentFigure.classList.add('is-inline-block');
    newCardContentMediaContent.appendChild(newCardContentMediaContentFigure);

    //CARD CONTENT MEDIA-CONTENT FIGURE IMAGE
    var newCardContentMediaContentFigureImage = document.createElement("img");
    newCardContentMediaContentFigureImage.classList.add('is-rounded');
    newCardContentMediaContentFigureImage.setAttribute("src", "https://bulma.io/images/placeholders/96x96.png");
    newCardContentMediaContentFigure.appendChild(newCardContentMediaContentFigureImage);

    //CARD CONTENT MEDIA-CONTENT TITLE
    var newCardContentMediaContentTitle = document.createElement("p");
    newCardContentMediaContentTitle.classList.add('title');
    newCardContentMediaContentTitle.classList.add('is-4');
    newCardContentMediaContentTitle.innerHTML = nameVar;
    newCardContentMediaContent.appendChild(newCardContentMediaContentTitle);

    /*CARD CONTENT MEDIA-CONTENT SUBTITLE
    var newCardContentMediaContentSubtitle = document.createElement("p");
    newCardContentMediaContentSubtitle.classList.add('subtitle');
    newCardContentMediaContentSubtitle.classList.add('is-6');
    newCardContentMediaContentSubtitle.innerHTML = "@" + jsonArray[i][0];
    newCardContentMediaContent.appendChild(newCardContentMediaContentSubtitle);*/

    //CARD CONTENT MEDIA-CONTENT SUBTITLE
    var newCardFooter = document.createElement("footer");
    newCardFooter.classList.add('card-footer');
    newCard.appendChild(newCardFooter);

    //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
    var newCardFooterLink = document.createElement("a");
    newCardFooterLink.setAttribute("onclick", "redirectToClientProfile('" + idVar + "','" + nameVar + "')");
    newCardFooterLink.classList.add('card-footer-item');
    newCardFooterLink.innerHTML = "Manage";
    newCardFooter.appendChild(newCardFooterLink);

    //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
    newParentTile.appendChild(newChildTile);
}

function refreshList() {
    generateUserList1();
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateUserList2(1, selectSort.value);
}

function redirectToClientProfile(clientIdVar, clientNameVar) {
    $.post("./classes/set-client-session-variable.class.php", {
        clientId: clientIdVar,
        clientName: clientNameVar
    }, function (data) {
        //var jsonArray = JSON.parse(data);
        //alert("success call");
        window.location.href = "client-profile.php";
    });
}

window.addEventListener('scroll', () => {
    let scrollable = document.documentElement.scrollHeight - window.innerHeight;
    let scrollable2 = scrollable * 0.80;
    let scrolled = window.scrollY;

    if (Math.ceil(scrolled) > scrollable2) {
        currentPageNumber = currentPageNumber + 1;
        generateUserList2(currentPageNumber, selectSort.value);
    }

});
/*
selectSort.addEventListener('change', () => {

    test_indicator.innerHTML = selectSort.value;
    ancestorTile.innerHTML = "";
    currentPageNumber = 1;
    generateUserList2(1, selectSort.value);


});
*/

searchBarInput.addEventListener('input', () => {
    generateUserList3(searchBarInput.value);
    if (searchBarInput.value == "") {
        ancestorTile.innerHTML = "";
        currentPageNumber = 1;
        generateUserList2(1, selectSort.value);

    }
});

generateUserList1();

generateUserList2(1, selectSort.value);
