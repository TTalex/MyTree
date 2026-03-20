<html>
  <head>
    <meta charset="utf-8"></meta>
    <title>Mon Arbre</title>
    <link rel=stylesheet href="style.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY="
      crossorigin=""
    />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
      integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo="
      crossorigin="">
    </script>
  </head>
  <body>
    <div id="top">
      <img src="MyTreeLogo.png" style="width:200px;"></img>
    </div>
    <div id="main">
      <?php
        $db = new SQLite3('trees.db');
        $query = 'SELECT * FROM nodes left join node_tags on nodes.node_id = node_tags.node_id where node_tags.key = "start_date" and value like "'.$_POST["annee"]."-".str_pad($_POST["mois"], 2, "0", STR_PAD_LEFT).'%"';
        $result = $db->query($query);
        $nrows = 0;
        while ($row = $result->fetchArray()) {
          $nrows++;
        }
        $result->reset();
        $monthmatch=1;
        if ($nrows == 0) {
          $monthmatch=0;
          // no results for month, search year
          $query = 'SELECT * FROM nodes left join node_tags on nodes.node_id = node_tags.node_id where node_tags.key = "start_date" and value like "%'.$_POST["annee"].'%"';
          $result = $db->query($query);
          $nrows = 0;
          while ($row = $result->fetchArray()) {
            $nrows++;
          }
          $result->reset();
        }
        echo "<h1>Arbres plantés autour du ".$_POST["jour"]."/".$_POST["mois"]."/".$_POST["annee"]." : </h1>";    
        if ($monthmatch == 0){
          echo "<p>Aucun résultat pour le mois donné, affichage de l'ensemble des arbres plantés en ".$_POST["annee"].".</p>";
        }
        echo "<h3>Nombre de résultats:".$nrows."</h3>";

        $i=0;
        while($arbre = $result->fetchArray()){
          if ($i > 10) {
            break;
          }
          echo $arbre['node_id'].", ".$arbre['value']."<br/>";
          $i = $i + 1;
        }
        $result->reset();
    ?>

    <div id="map"></div>

    <script type="text/javascript">
      var map = L.map('map').setView([48.87, 2.33], 11);
      L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
      }).addTo(map);

      function addMarker(lat, lng, node_id, dateplanta){
        const marker = L.marker([lat, lng]).addTo(map);
        var date_text = `planté le ${dateplanta}`
        if (dateplanta.indexOf("-") == -1) {
          date_text = `planté en ${dateplanta}`
        }
        marker.bindPopup(`<a href="https://www.openstreetmap.org/node/${node_id}" target="_blank">${node_id}</a>, ${date_text}.`)
      }
      <?php
         while($arbre = $result->fetchArray()){
            $lng = $arbre["lon"];
            $lat = $arbre["lat"];
            $node_id = $arbre["node_id"];
            $dateplanta = $arbre["value"];
      ?>
      addMarker(<?php echo $lat; ?>,<?php echo $lng; ?>,<?php echo $node_id; ?>,<?php echo '"'.$dateplanta.'"'; ?>);
      <?php
        }
      ?>

    </script>
  </body>
</html>