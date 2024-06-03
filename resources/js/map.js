var map = L.map('map', {
  center: [-8.168159298353864, 113.70884665532891],
  zoom: 16
  }).setView([-8.168159298353864, 113.70884665532891], 16);

  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
      maxZoom: 18,
      id: 'mapbox/streets-v11',
      tileSize: 512,
      zoomOffset: -1,
      accessToken: 'pk.eyJ1IjoiZnJxbW5mIiwiYSI6ImNsdmVjMnFmMzA3YmYyaW85a3piM3BjbzYifQ.4x3Q-Ik61nDwm6RreXphXQ'
  }).addTo(map);

  var markerCoordinates = [-8.168159298353864, 113.70884665532891];
  var marker = L.marker(markerCoordinates).addTo(map);
  marker.bindPopup("<b>Hey we're here</b>").openPopup();