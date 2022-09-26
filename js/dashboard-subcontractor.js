let calendarVar;


let eventHeader = document.getElementById('eventHeader');
document.addEventListener('DOMContentLoaded', function () {

    calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        height: 'auto',
        eventMouseEnter: function (info) {
            //calendarVar = info.event.desc;
            eventHeader.innerHTML = info.event.extendedProps.description;
            //alert('Event: ' + info.event.id);
        },
        eventMouseLeave: function (info) {
            //calendarVar = info.event.created_at;
            //alert("Leave");
            //alert('Event: ' + info.event.id);
            eventHeader.innerHTML = '';
        }

    });

    //calendar.addEventSource(jsonObj); //accepts json, no need to parse

    calendar.render();


});

/*
let jsonObj; //= [{"title":"123","0":"123","start":"2022-08-18","1":"2022-08-18"},{"title":"456","0":"456","start":"2022-08-16","1":"2022-08-16"}]

let array1 = [{"title":"123","0":"123","start":"2022-08-18","1":"2022-08-18"},{"title":"456","0":"456","start":"2022-08-16","1":"2022-08-16"}];
let array2 = [{"title":"123","start":"2022-08-18"},{"title":"456","start":"2022-08-16"}]
*/

function generateEventList1() {
    $.post("./classes/load-shipment-event-in-progress-subcontractor.class.php", {
    }, function (data) {
        var jsonArray = JSON.parse(data);
        calendar.addEventSource(jsonArray);
        //alert(data);
    });
}

function generateEventList2() {
    $.post("./classes/load-shipment-event-completed-subcontractor.class.php", {

    }, function (data) {
        var jsonArray = JSON.parse(data);
        calendar.addEventSource(jsonArray);
        //alert(data);
    });
}

function generateEventList3() {
    $.post("./classes/load-payroll-event-completed-subcontractor.class.php", {

    }, function (data) {
        var jsonArray = JSON.parse(data);
        calendar.addEventSource(jsonArray);
        //alert(data);
    });
}

/*
function generateEventList3() {
    $.post("./classes/load-billing-event-unsettled.class.php", {

    }, function (data) {
        var jsonArray = JSON.parse(data);
        calendar.addEventSource(jsonArray);
        //alert(data);
    });
}

function generateEventList3() {
    $.post("./classes/load-billing-event-settled.class.php", {

    }, function (data) {
        var jsonArray = JSON.parse(data);
        calendar.addEventSource(jsonArray);
        //alert(data);
    });
}
*/
generateEventList1();
generateEventList2();
generateEventList3();

/*
generateEventList4();
//alert("data");
//alert(jsonHidden.innerHTML);
//c

//alert(jsonObj);*/