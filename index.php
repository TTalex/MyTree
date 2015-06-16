<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Mon Arbre</title>
    <link rel=stylesheet href="style.css">
  </head>
  <body>
    <div id="top">
      <img src="MyTreeLogo.png" style="width:200px;"></img>
      <div id="language"><a href="en/">English</a></div>
    </div>
    <div id="main">
      <form method="POST" action="cible.php">
	<h1>Date de naissance</h1>
	
	<select name="jour">
          <?php for ($jour = 1 ; $jour <= 31 ; $jour++){ ?>
                <option value="<?php echo $jour ?>"><?php echo $jour; ?></option>
		<?php } ?>  
	</select>
	<select name="mois">
          <option value="1">Janvier</option>
	  <option value="2">Fevrier</option>
	  <option value="3">Mars</option>
	  <option value="4">Avril</option>
	  <option value="5">Mai</option>
	  <option value="6">Juin</option>
	  <option value="7">Juillet</option>
	  <option value="8">Aout</option>
	  <option value="9">Septembre</option>
	  <option value="10">Octobre</option>
	  <option value="11">Novembre</option>
	  <option value="12">Decembre</option>
	</select>
	
	<select name="annee">
	  <?php for ($annee = 2015 ; $annee >= 1900 ; $annee--){ ?>
          <option value="<?php echo $annee ?>"><?php echo $annee; ?></option>
	  <?php } ?>  
	</select>
	<div><input type="submit" value="Envoyer"></input></div>
      </form>
      <div id="line"></div>
      <h1>Comment ça marche ?</h1>
      <p>
      MyTree utilise la base de données <a href="http://opendata.paris.fr">opendata Paris</a> pour récupérer les dates de plantation des arbres dans la capitale, une liste des arbres plantés le plus près de votre date de naissance est ensuite générée.
      </p>
    </div>
  </body>
</html>
