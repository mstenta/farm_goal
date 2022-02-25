(function () {
  farmOS.map.behaviors.biodiversity_logs = {
    attach: function (instance) {

      const url = new URL('/biodiversity-logs/geojson', window.location.origin + drupalSettings.path.baseUrl);
      var opts = {
        title: 'Biodiversity logs',
        url,
        color: 'blue',
      };

      var newLayer = instance.addLayer('geojson', opts);

      // Zoom to the layer vectors.
      var source = newLayer.getSource();
      source.on('change', function () {
        instance.zoomToVectors();
      });

      // Load area details via AJAX when an area popup is displayed.
      instance.popup.on('farmOS-map.popup', function (event) {

      });
    }
  };
}());
