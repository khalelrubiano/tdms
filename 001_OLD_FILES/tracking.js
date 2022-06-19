//Generate Map/Markers

function initMap(locationData, displayNumber){
  var map = new google.maps.Map(document.getElementById("map"), {
    zoom: 11,
    center: {lat: 14.330560, lng: 121.064950}
  });

  function addMarker(lat, lng, timestamp){
    var marker = new google.maps.Marker({
      position: new google.maps.LatLng(lat, lng),
      map: map
    });
    var detailWindow = new google.maps.InfoWindow({
      content: '<h1 class="is-size-6 has-text-weight-bold"> <i class="fa-solid fa-clock mr-3"></i>'+ timestamp +'</h1>'
    });
    marker.addListener("click", () =>{
      detailWindow.open(map, marker);
    });
  }

  for(var i=0;i < displayNumber;i++){
    addMarker(parseFloat(locationData[i][2]), parseFloat(locationData[i][1]), locationData[i][3]);
    //$("#testParagraph").html("Last update was created on: " + locationData[i][3]);
  }
}
