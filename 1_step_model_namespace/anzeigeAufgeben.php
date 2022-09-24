<?php
	use classes\model\Inserent;
	use classes\model\Anzeige;
	use classes\model\Rubrik;
	use classes\model\AnzeigenVerwaltung;

	include_once("./autoload.php");
	spl_autoload_register('autoloader');
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <title>Das Webbrett</title>
    <meta name="description" content="Dies ist eine Testseite">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="css/bildschirm.css" rel="stylesheet" media="all">
</head>
<body>
    <header role="banner">
		<h1>Das Webbrett</h1>
    </header>
	
	<nav> 
		<ul> 
			<li>
				<a href="index.php" title="zurück"> zurück </a>
			</li>
			<li>
				<a href="anzeigeAufgeben.php" title="Anzeigen aufgeben"> Anzeigen aufgeben </a>
			</li> 
		</ul> 
	</nav>
    
   <div class="wrapper">
	
	<?php
		// Daten anlegen:
		$inserent1 = new Inserent(101, "mickey", "mickeymouse@entenhausen.com");
		$inserent2 = new Inserent(102, "obelix", "obelix@gallien.fr");

		$anzeige1 = new Anzeige(201, "Verkaufe ein Kinderfahrrad", "20.02.2018", $inserent1);
		$anzeige2 = new Anzeige(202, "Guterhaltenes Java-Buch umständehalber abzugeben. Billig!", "01.03.2018", $inserent1);
		$anzeige3 = new Anzeige(203, "Suche einen günstigen Tintenstrahldrucker", "01.03.2018", $inserent2);
		$anzeige4 = new Anzeige(204, "Übernehme Gartenarbeit vom Rasen mähen bis zu Baumfällarbeiten", "03.03.2018", $inserent1);
		$anzeige5 = new Anzeige(205, "Alter Fiat 500, kein Tüv mehr, zum Ausschlachten zu verkaufen", "08.03.2018", $inserent2);

		$rubrik1 = new Rubrik(302, "Autos, Fahrräder");
		$rubrik2 = new Rubrik(303, "Bücher");
		$rubrik3 = new Rubrik(304, "Computer");
		$rubrik4 = new Rubrik(305, "sonstiges");

		$rubrik1->addAnzeige($anzeige1);
		$rubrik1->addAnzeige($anzeige5);
		$rubrik2->addAnzeige($anzeige2);
		$rubrik3->addAnzeige($anzeige2);
		$rubrik3->addAnzeige($anzeige3);
		$rubrik4->addAnzeige($anzeige4);

		$rubrikList = array($rubrik1, $rubrik2, $rubrik3, $rubrik4);
		
		$anzeigenVerwaltung = new AnzeigenVerwaltung($rubrikList);
		echo "<br>";	
		
		if(isset($_POST['ausfuehren'])){
			$anzeigenVerwaltung->anzeigeEintragen();
		}
		else{
			$anzeigenVerwaltung->formularAufbauen();
		}
	
		echo "<br>";	
	?>
		
	</div> <!-- end of wrapper -->
	
	<footer role="contentinfo">
		 <small>Copyright &copy; Petra Treubel <time datetime="2017">2017</time></small>
	</footer>
</body>
</html>