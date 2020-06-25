<script src="<?= base_url('assets/plugins/jquery/jquery3.min.js')?>"></script>
<script src="<?= base_url('assets/plugins/jquery/jquery-migrate-3.0.1.min.js')?>"></script>
<script src="http://www.openlayers.org/api/OpenLayers.js"></script> 
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Maps</div>
                <div class="panel-body">
                    <div id="Map" style="width:100%;height: 600px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
    showPosition(<?= $lat?>, <?= $long?>);
   });

 function showPosition(lat, lon) {
     
     if(lat=='-2.5489'&&lon=='118.0149'){
        var zoom = 5;
     }else{
        var zoom = 18;
     }

   var fromProjection = new OpenLayers.Projection("EPSG:4326");   // Transform from WGS 1984
   var toProjection = new OpenLayers.Projection("EPSG:900913"); // to Spherical Mercator Projection
            var position = new OpenLayers.LonLat(lon, lat).transform(fromProjection, toProjection);

            map = new OpenLayers.Map("Map");

            var mapnik = new OpenLayers.Layer.OSM();
            map.addLayer(mapnik);

            var markers = new OpenLayers.Layer.Markers("Markers");
            map.addLayer(markers);
            markers.addMarker(new OpenLayers.Marker(position));

            map.setCenter(position, zoom);

            $("#longtitude").val(lon);
            $("#latitude").val(lat);
        }
</script>