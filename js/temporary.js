const arrayLengthHidden = document.getElementById('arrayLengthHidden');
const ancestorTile = document.getElementById('ancestorTile');
const selectSort = document.getElementById('selectSort');
const test_indicator = document.getElementById('test_indicator');

let currentPageNumber = 2;

function generateUserList1() {
    $.post("./classes/load-user-all.class.php", {}, function (data) {
        var jsonArray = JSON.parse(data);
        var finalLength = Math.ceil(jsonArray.length / 1)
        arrayLengthHidden.innerHTML = finalLength;
    });
}

function generateUserListOrderByName(currentPageNumberVar) {
    $.post("./classes/load-user-order-by-name.class.php", {
        currentPageNumber: currentPageNumberVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        if (currentPageNumber <= arrayLengthHidden.innerHTML) {
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
                newCardHeaderParagraph.innerHTML = jsonArray[i][4];
                newCardHeader.appendChild(newCardHeaderParagraph);

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
                newCardContentMediaContentTitle.innerHTML = jsonArray[i][1] + " " + jsonArray[i][3];
                newCardContentMediaContent.appendChild(newCardContentMediaContentTitle);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardContentMediaContentSubtitle = document.createElement("p");
                newCardContentMediaContentSubtitle.classList.add('subtitle');
                newCardContentMediaContentSubtitle.classList.add('is-6');
                newCardContentMediaContentSubtitle.innerHTML = "@" + jsonArray[i][0];
                newCardContentMediaContent.appendChild(newCardContentMediaContentSubtitle);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardFooter = document.createElement("footer");
                newCardFooter.classList.add('card-footer');
                newCard.appendChild(newCardFooter);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
                var newCardFooterLink = document.createElement("a");
                newCardFooterLink.classList.add('card-footer-item');
                newCardFooterLink.innerHTML = "View Profile";
                newCardFooter.appendChild(newCardFooterLink);

                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }
    });
}

function generateUserListOrderByRole(currentPageNumberVar) {
    $.post("./classes/load-user-order-by-role.class.php", {
        currentPageNumber: currentPageNumberVar
    }, function (data) {

        var jsonArray = JSON.parse(data);

        if (currentPageNumber <= arrayLengthHidden.innerHTML) {
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
                newCardHeaderParagraph.innerHTML = jsonArray[i][4];
                newCardHeader.appendChild(newCardHeaderParagraph);

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
                newCardContentMediaContentTitle.innerHTML = jsonArray[i][1] + " " + jsonArray[i][3];
                newCardContentMediaContent.appendChild(newCardContentMediaContentTitle);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardContentMediaContentSubtitle = document.createElement("p");
                newCardContentMediaContentSubtitle.classList.add('subtitle');
                newCardContentMediaContentSubtitle.classList.add('is-6');
                newCardContentMediaContentSubtitle.innerHTML = "@" + jsonArray[i][0];
                newCardContentMediaContent.appendChild(newCardContentMediaContentSubtitle);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardFooter = document.createElement("footer");
                newCardFooter.classList.add('card-footer');
                newCard.appendChild(newCardFooter);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
                var newCardFooterLink = document.createElement("a");
                newCardFooterLink.classList.add('card-footer-item');
                newCardFooterLink.innerHTML = "View Profile";
                newCardFooter.appendChild(newCardFooterLink);

                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        }
    });
}

window.addEventListener('scroll', () => {
    let scrollable = document.documentElement.scrollHeight - window.innerHeight;
    let scrolled = window.scrollY;

    if (Math.ceil(scrolled) === scrollable) {
        currentPageNumber = currentPageNumber + 1;
        if (selectSort.value == "Role") {
            generateUserListOrderByRole(currentPageNumber);
        }
    
        if (selectSort.value == "Name") {
            generateUserListOrderByName(currentPageNumber);
        }
    }

});

selectSort.addEventListener('change', () => {
    if (selectSort.value == "Role") {
        test_indicator.innerHTML = selectSort.value;
        ancestorTile.innerHTML = "";
        currentPageNumber = 2;
        generateUserListOrderByRole(1);
        generateUserListOrderByRole(2);
    }

    if (selectSort.value == "Name") {
        test_indicator.innerHTML = selectSort.value;
        ancestorTile.innerHTML = "";
        currentPageNumber = 2;
        generateUserListOrderByName(1);
        generateUserListOrderByName(2);
    }

});

generateUserList1();

generateUserListOrderByName(1)
generateUserListOrderByName(2)