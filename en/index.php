<!DOCTYPE html>
<html>
  <head>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>My Tree</title>
    <link rel=stylesheet href="../style.css">
  </head>
  <body>
    <div id="top">
      <img src="../MyTreeLogo.png" style="width:200px;"></img>
      <div id="language"><a href="..">Français</a></div>
    </div>
    <div id="main">
      <form method="POST" action="cible.php">
	<h1>Birth date</h1>
	
	<select name="jour">
          <?php for ($jour = 1 ; $jour <= 31 ; $jour++){ ?>
                <option value="<?php echo $jour ?>"><?php echo $jour; ?></option>
		<?php } ?>  
	</select>
	<select name="mois">
          <option value="1">January</option>
	  <option value="2">February</option>
	  <option value="3">March</option>
	  <option value="4">April</option>
	  <option value="5">May</option>
	  <option value="6">June</option>
	  <option value="7">July</option>
	  <option value="8">August</option>
	  <option value="9">September</option>
	  <option value="10">October</option>
	  <option value="11">November</option>
	  <option value="12">December</option>
	</select>
	
	<select name="annee">
	  <?php for ($annee = 2015 ; $annee >= 1900 ; $annee--){ ?>
          <option value="<?php echo $annee ?>"><?php echo $annee; ?></option>
	  <?php } ?>  
	</select>
	<div><input type="submit" value="Send"></input></div>
      </form>
      <div id="line"></div>
      <h1>How does it work ?</h1>
      <p>
      MyTree uses the <a href="http://opendata.paris.fr">opendata Paris</a> database to retrieve planting dates of trees in the capital city, a list of trees planted near your birth date is then generated.
      </p>
    </div>
  </body>
</html>
