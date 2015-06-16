<html>
  <head>
    <meta charset="utf-8"></meta>
    <title>My Tree</title>
    <link rel=stylesheet href="../style.css">
      <script type="text/javascript"
	    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3FzjaP3F-piuwV0mRdawQhX7R5ogJdx8">
    </script>
    <script type="text/javascript">
      function initialize() {
	  var mapOptions = {
	      center: { lng: 2.33, lat: 48.87},
	      zoom: 12
	  };
	  g_map = new google.maps.Map(document.getElementById('map-canvas'),
				      mapOptions);
	  addMarkers();
      }
      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
  </head>
  <body>
    <div id="top">
      <img src="../MyTreeLogo.png" style="width:200px;"></img>
    </div>
    <div id="main"> 
    
    <?php 
       for($shift=0;$shift<=11;$shift=$shift+1){
          $max = min(12, $_POST["mois"] + $shift);
	  $min = max(1, $_POST["mois"] - $shift); 
       
          $base_url = "http://opendata.paris.fr/api/records/1.0/search?dataset=les-arbres&q=dateplanta+:+";
          $date = "[".$_POST["annee"]."/".$min."/".$_POST["jour"]."+TO+".$_POST["annee"]."/".$max."/".$_POST["jour"]."]";
          $options = "&rows=10000&sort=-dateplanta&facet=dateplanta";
          $json = file_get_contents($base_url.$date.$options);
          $data = json_decode($json);
	  if ($data == null){
	     echo "<h3>Error with opendata.paris API</h3>";
	     break;
	  }
          if ($data->{'nhits'} == 0 ){
             if ($shift == 11)
                echo "<h1>No trees were planted in ".$_POST["annee"]." :( </h1>";
             continue;
          }
          echo "<h1>Trees planted around the ".$_POST["jour"]."/".$_POST["mois"]."/".$_POST["annee"]." : </h1>";
          echo "<h3>Number of results:";
          echo $data->{'nhits'};
          echo "</h3>";
    
          $i=0;
          foreach($data->{'records'} as $arbre){
             if ($i > 10) {
                break;
             }
             $fields = $arbre->{'fields'};
             echo $fields->{'espece'}.", ".$fields->{'adresse'}.", ".$fields->{'dateplanta'}."<br/>";
             $i = $i + 1;
          }
       break;       
       }
    
    ?>
    
    <div id="map-canvas"></div>
    
    <script type="text/javascript">
      function addMarker(lat, lng){
	  var marker = new google.maps.Marker({
	      position: new google.maps.LatLng(lat,lng),
	      map: g_map,
	      title:"Hello World!"
	  });
      }
      function addMarkers(){
      <?php
	 foreach($data->{'records'} as $arbre){
            $geometry = $arbre->{'geometry'};
            $lng = $geometry->{'coordinates'}[0];
            $lat = $geometry->{'coordinates'}[1];
      ?>
         addMarker(<?php echo $lat; ?>,<?php echo $lng; ?>)
      <?php
	 }
	 ?>
      }
    </script>
    </div>
  </body>
</html> 
