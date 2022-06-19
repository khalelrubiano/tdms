/*
var permissionTable = $('#permissionTable').DataTable({
  "ajax": {
    "url": "classes/load-user.class.php",
    "dataSrc": ""
  },
  "columns": [
    { "data": "role" },
    { "data": "accountType" },
    { "data": "shipmentAccess" },
    { "data": "accountAccess" },
    { "data": "createdAt" }
  ]
});



//let sample_array = [1, 2, 3];

let main_column = document.getElementById('main_column')

//CREATE CARD
let shipment_card = document.createElement('div');
//ADD CLASSES TO CARD
shipment_card.classList.add("card", "mb-6", "box");


main_column.appendChild(shipment_card);

//CREATE CARD HEADER
let card_header = document.createElement('header');
card_header.classList.add("card-header");
shipment_card.appendChild(card_header);




let shipment_card = document.createElement('div');
let shipment_card = document.createElement('div');
let shipment_card = document.createElement('div');

firstP.setAttribute("id", "firstPracPara");

sample_header_1.innerHTML = "THIS";
sample_header_2.innerHTML = "STATIC ELEMENTS";

main.appendChild(sample_header_2);
main.appendChild(sample_header_1);
main.removeChild(sample_header_2);
*/

let test_paragraph1 = document.getElementById('test_paragraph1')
let test_paragraph2 = document.getElementById('test_paragraph2')
let userTableBody = document.getElementById('userTableBody')
let paginationListBody = document.getElementById('paginationListBody')




//event function that takes the value inside pagination anchor tag (element.value) and passes it through the function that generates the table

function generatePaginationAjax() {
  //var numberOfPages = 'sample';
  $.post("./classes/load-user.class.php", {
    //shipmentNumber : shipmentNumberData
  }, function (data) {
    var jsonArray = JSON.parse(data);

    //Generate Pagination
    var numberOfResults = jsonArray.length;
    //test_paragraph1.innerHTML = numberOfResults;
    var resultsPerPage = 1;
    var numberOfPages = Math.ceil(numberOfResults / resultsPerPage);
    test_paragraph2.innerHTML = numberOfPages;

    /*
        for (let i2 = 1; i2 <= numberOfPages; i2++) {
          var newListItem = document.createElement("li");
          paginationListBody.appendChild(newListItem);
    
          var newAnchorTag = document.createElement("a");
    
          newAnchorTag.setAttribute("onclick", "loadUserTableAjax" + "(" + i2 + ")");
    
          newListItem.appendChild(newAnchorTag);
    
          if (i2 == 1) {
            newAnchorTag.classList.add("pagination-link");
            newAnchorTag.classList.add("is-current");
            newAnchorTag.innerHTML = i2;
          } else {
            newAnchorTag.classList.add("pagination-link");
            newAnchorTag.innerHTML = i2;
          }
    
        }
        //loadUserTableAjax(1);
        */
  });
  
}

generatePaginationAjax();
/*
function returnData(param) {
  //console.log(param);
  return param;
}

function myFunction(callback) {
  //var sample = "sampletest";

  $.post("./classes/load-user.class.php", function (data) {
    var jsonArray = JSON.parse(data);
    //sample = jsonArray.length;
    callback(jsonArray.length);
  });

  //return sample;get value
}

*/

//test_paragraph1.innerHTML = "current: " + myFunction(returnData);

function loadUserTableAjax(currentPageNumberVar) {

  $.post("./classes/load-user-pagination.class.php", {
    currentPageNumber: currentPageNumberVar
  }, function (data) {
    var jsonArray = JSON.parse(data);

    userTableBody.innerHTML = '';

    for (var i = 0; i < jsonArray.length; i++) {
      //Create table row
      var newTableRow = document.createElement("tr");
      //Append table row to table body
      userTableBody.appendChild(newTableRow);
      //Create table data
      var newTableData1 = document.createElement("td");
      //var newTableData2 = document.createElement("td");
      var newTableData3 = document.createElement("td");
      var newTableData4 = document.createElement("td");
      var newTableData5 = document.createElement("td");
      var newTableData6 = document.createElement("td");
      //Adding data-label
      newTableData1.setAttribute("data-label", "Username");
      //newTableData2.setAttribute("data-label","Password");
      newTableData3.setAttribute("data-label", "First Name");
      newTableData4.setAttribute("data-label", "Middle Name");
      newTableData5.setAttribute("data-label", "Last Name");
      newTableData6.setAttribute("data-label", "Role");
      //Insert data in table data
      newTableData1.innerHTML = jsonArray[i][0]
      //newTableData2.innerHTML = jsonArray[i][1]
      newTableData3.innerHTML = jsonArray[i][2]
      newTableData4.innerHTML = jsonArray[i][3]
      newTableData5.innerHTML = jsonArray[i][4]
      newTableData6.innerHTML = jsonArray[i][5]
      //Append table data to table row
      newTableRow.appendChild(newTableData1);
      //newTableRow.appendChild(newTableData2);
      newTableRow.appendChild(newTableData3);
      newTableRow.appendChild(newTableData4);
      newTableRow.appendChild(newTableData5);
      newTableRow.appendChild(newTableData6);
    }

  });
}



let paginationPrevious = document.getElementById('paginationPrevious')
let paginationNext = document.getElementById('paginationNext')

let currentPage = 1;

loadUserTableAjax(currentPage);
test_paragraph1.innerHTML = "current: " + currentPage;

function goPrevious() {
  if(currentPage > 1){
    currentPage = currentPage - 1;
    test_paragraph1.innerHTML = "current: " + currentPage;
  }
  loadUserTableAjax(currentPage);
  return currentPage;
};

function goNext() {
  if(currentPage < test_paragraph2.innerHTML){
    currentPage = currentPage + 1;
    test_paragraph1.innerHTML = "current: " + currentPage;
  }
  loadUserTableAjax(currentPage);
  return currentPage;
};

paginationPrevious.setAttribute("onclick", "goPrevious()");
paginationNext.setAttribute("onclick", "goNext()");

