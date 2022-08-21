let returnBtn = document.getElementById('returnBtn');

let updateBtn = document.getElementById('updateBtn');

let billingIdHidden = document.getElementById('billingIdHidden');
let payrollTitle = document.getElementById('payrollTitle');
let statusHeader = document.getElementById('statusHeader');
let payrollStatusHidden = document.getElementById('payrollStatusHidden');
let invoiceNumberHidden = document.getElementById('invoiceNumberHidden');

const arrayLengthHidden = document.getElementById('arrayLengthHidden')


const ancestorTile = document.getElementById('ancestorTile');

const test_indicator = document.getElementById('test_indicator');

/*
function addBillingLog(logDescriptionVar, billingDescriptionVar) {
    $.post("./classes/add-billing-log-controller.class.php", {
        logDescription: logDescriptionVar,
        billingDescription: billingDescriptionVar
    }, function (data) {
        //alert(data);
    });
}
*/


function generatePayrollList1() {
    $.post("./classes/load-payslip.class.php", {
        billingId: billingIdHidden.innerHTML
    }, function (data) {

        var jsonArray = JSON.parse(data);
        alert("call success");

        //if (currentPageNumber <= arrayLengthHidden.innerHTML) {


            var newParentTile = document.createElement("div");
            newParentTile.classList.add('tile');
            newParentTile.classList.add('is-parent');
            newParentTile.classList.add('is-vertical');
            newParentTile.setAttribute("style", "align-items: center;");
            ancestorTile.appendChild(newParentTile);

            indicator.innerHTML = jsonArray.length;

            for (var i = 0; i < jsonArray.length; i++) {

                var newChildTile = document.createElement("div");
                newChildTile.classList.add('tile');
                newChildTile.classList.add('is-child');
                newChildTile.classList.add('p-2');
                newChildTile.classList.add('is-6');

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

                var newCardHeaderParagraphIcon = document.createElement("i");
                newCardHeaderParagraphIcon.classList.add('fa-solid');
                newCardHeaderParagraphIcon.classList.add('fa-circle');
                newCardHeaderParagraphIcon.classList.add('mr-3');

                //newCardHeaderParagraph.appendChild(newCardHeaderParagraphIcon);

                switch (jsonArray[i][1]) {
                    case "Settled":
                        newCardHeaderParagraph.classList.add('has-text-primary');
                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle-check mr-3 has-text-primary'></i>" + jsonArray[i][1];
                        newCardHeader.appendChild(newCardHeaderParagraph);
                        break;
                    case "Unsettled":
                        newCardHeaderParagraph.classList.add('has-text-warning');
                        newCardHeaderParagraph.innerHTML = "<i class='fa-solid fa-circle-exclamation mr-3 has-text-warning'></i>" + jsonArray[i][1];
                        newCardHeader.appendChild(newCardHeaderParagraph);
                        break;

                }

                //CARD HEADER BUTTON
                /*
                                var newCardHeaderButton = document.createElement("button");
                                newCardHeaderButton.setAttribute("onclick", "deleteAjax('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "')");
                                newCardHeaderButton.classList.add('card-header-icon');
                                newCardHeader.appendChild(newCardHeaderButton);
                
                                var newCardHeaderButtonSpan = document.createElement("span");
                                newCardHeaderButtonSpan.classList.add('icon');
                                newCardHeaderButtonSpan.classList.add('is-right');
                                newCardHeaderButton.appendChild(newCardHeaderButtonSpan);
                
                                var newCardHeaderButtonSpanI = document.createElement("i");
                                newCardHeaderButtonSpanI.classList.add('fa-solid');
                                newCardHeaderButtonSpanI.classList.add('fa-xmark');
                                newCardHeaderButtonSpan.appendChild(newCardHeaderButtonSpanI);
                */
                //newCardHeaderButton.innerHTML = jsonArray[i][4];
                //newCardHeader.appendChild(newCardHeaderParagraph);

                //CARD CONTENT
                var newCardContent = document.createElement("div");
                newCardContent.classList.add('card-content');
                newCard.appendChild(newCardContent);

                //CARD CONTENT MEDIA
                var newContent = document.createElement("div");
                newContent.classList.add('content');
                newCardContent.appendChild(newContent);

                //CONTENT PARAGRAPH
                var newContentParagraph = document.createElement("p");
                newContentParagraph.classList.add('title');
                newContentParagraph.classList.add('is-5');
                newContentParagraph.classList.add('mb-5');
                newContentParagraph.classList.add('has-text-centered');
                newContentParagraph.innerHTML = "Batch #" + jsonArray[i][0];
                newContent.appendChild(newContentParagraph);

                //CONTENT PARAGRAPH ICON
                /*
                var newContentParagraphIcon = document.createElement("i");
                newContentParagraphIcon.classList.add('fa-solid');
                newContentParagraphIcon.classList.add('fa-hashtag');
                newContentParagraphIcon.classList.add('fa-2x');
                newContentParagraph.appendChild(newContentParagraphIcon);*/

                //CONTENT TABLE
                var newContentTable = document.createElement("table");
                newContentTable.classList.add('table');
                newContentTable.classList.add('is-bordered');
                newContent.appendChild(newContentTable);

                //CONTENT TABLE TBODY
                var newContentTableTbody = document.createElement("tbody");
                newContentTable.appendChild(newContentTableTbody);

                //CONTENT TABLE TBODY TR 1
                var newContentTableTbodyTr1 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr1);

                var newContentTableTbodyTr1Td1 = document.createElement("td");
                newContentTableTbodyTr1Td1.innerHTML = "Invoice Number:";
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td1);

                var newContentTableTbodyTr1Td2 = document.createElement("td");
                newContentTableTbodyTr1Td2.innerHTML = jsonArray[i][3];
                newContentTableTbodyTr1.appendChild(newContentTableTbodyTr1Td2);

                //CONTENT TABLE TBODY TR 2
                var newContentTableTbodyTr2 = document.createElement("tr");
                newContentTableTbody.appendChild(newContentTableTbodyTr2);

                var newContentTableTbodyTr2Td1 = document.createElement("td");
                newContentTableTbodyTr2Td1.innerHTML = "Invoice Date:";
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td1);

                var newContentTableTbodyTr2Td2 = document.createElement("td");
                newContentTableTbodyTr2Td2.innerHTML = jsonArray[i][4];
                newContentTableTbodyTr2.appendChild(newContentTableTbodyTr2Td2);
                /*
                                //CONTENT TABLE TBODY TR 3
                                var newContentTableTbodyTr3 = document.createElement("tr");
                                newContentTableTbody.appendChild(newContentTableTbodyTr3);
                
                                var newContentTableTbodyTr3Td1 = document.createElement("td");
                                newContentTableTbodyTr3Td1.innerHTML = "End Date:";
                                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td1);
                
                                var newContentTableTbodyTr3Td2 = document.createElement("td");
                                newContentTableTbodyTr3Td2.innerHTML = jsonArray[i][11];
                                newContentTableTbodyTr3.appendChild(newContentTableTbodyTr3Td2);
                
                                //CONTENT TABLE TBODY TR 4
                                var newContentTableTbodyTr4 = document.createElement("tr");
                                newContentTableTbody.appendChild(newContentTableTbodyTr4);
                
                                var newContentTableTbodyTr4Td1 = document.createElement("td");
                                newContentTableTbodyTr4Td1.innerHTML = "Client:";
                                newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td1);
                
                                var newContentTableTbodyTr4Td2 = document.createElement("td");
                                newContentTableTbodyTr4Td2.innerHTML = jsonArray[i][4];
                                newContentTableTbodyTr4.appendChild(newContentTableTbodyTr4Td2);
                */
                //CARD CONTENT MEDIA-CONTENT SUBTITLE
                var newCardFooter = document.createElement("footer");
                newCardFooter.classList.add('card-footer');
                newCard.appendChild(newCardFooter);

                //CARD CONTENT MEDIA-CONTENT SUBTITLE ( NEEDS HREF )
                var newCardFooterLink = document.createElement("a");
                newCardFooterLink.setAttribute("onclick", "redirectToPayrollProfile('" + jsonArray[i][0] + "','" + jsonArray[i][1] + "','" + jsonArray[i][2] + "','" + jsonArray[i][3] + "','" + jsonArray[i][4] + "')");
                newCardFooterLink.classList.add('card-footer-item');
                newCardFooterLink.innerHTML = "View Details";
                newCardFooter.appendChild(newCardFooterLink);
                /*
                                var newCardFooterLink2 = document.createElement("a");
                                newCardFooterLink2.setAttribute("onclick", "openEdit('" + jsonArray[i][5] + "','" + jsonArray[i][6] + "')");
                                newCardFooterLink2.classList.add('card-footer-item');
                                newCardFooterLink2.innerHTML = "Edit Details";
                                newCardFooter.appendChild(newCardFooterLink2);
                */
                //newChildTile.innerHTML = "entry number: " + jsonArray[i - 1][0];
                newParentTile.appendChild(newChildTile);

            }
        //}

    });
}

function updateBillingStatus() {
    if (confirm("Mark this invoice as settled?")) {
        $.post("./classes/edit-billing-status-controller.class.php", {
            billingId: billingIdHidden.innerHTML
        }, function (data) {
            //$("#submitAddFormHelp").html(data);
            //$("#submitAddFormHelp").attr('class', 'help is-success');
            //clearAddFormHelp();
            //clearAddFormInput();
            //addModal.classList.remove('is-active');
            alert(data);
            //refreshList();
            addBillingLog("Updated", "Invoice #" + invoiceNumberHidden.innerHTML);
        });
    }
}


generatePayrollList1();
//generateShipmentListTable2(1);
//populateTable();

//var maxPageNumber = parseInt(arrayLengthHidden.innerHTML);

returnBtn.addEventListener('click', () => {
    window.location.href = "payroll.php";
});
