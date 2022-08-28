let calendarVar;
let jsonHidden = document.getElementById('jsonHidden');


document.addEventListener('DOMContentLoaded', function () {
    
    calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',

        eventClick: function (info) {
            //calendarVar = info.event.created_at;
            //alert(calendarVar);
            //alert('Event: ' + info.event.id);
        }

    });

    //calendar.addEventSource(jsonObj); //accepts json, no need to parse

    calendar.render();
    
    
});

    
let jsonObj; //= [{"title":"123","0":"123","start":"2022-08-18","1":"2022-08-18"},{"title":"456","0":"456","start":"2022-08-16","1":"2022-08-16"}]

function generateEventList() {
    $.post("./classes/load-event.class.php", {

    }, function (data) {
        var jsonArray = JSON.parse(data);
        calendar.addEventSource(jsonArray);
        //alert(jsonHidden.innerHTML);
    });
}

generateEventList();

//alert(jsonHidden.innerHTML);
//c

//alert(jsonObj);
