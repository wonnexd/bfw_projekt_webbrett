<?php
	include("model/Rubrik.php");
	include("model/Inserent.php");
	include("model/Anzeige.php");
	
	$rubrik1 = new Rubrik(33, "Autos");
	$rubrik2 = new Rubrik(35, "Bücher");
	$rubrik3 = new Rubrik(36, "Computer");
	
	$anzeige1 = new Anzeige(5001, "Verkaufe ein Tablet mit Android 2", "02.02.2019");
	$anzeige2 = new Anzeige(5002, "Java-Buch zu verschenken", "14.01.2019");
	$anzeige3 = new Anzeige(5004, "Wer hat meine kabellose Maus gefunden?", "09.01.2019");
	$anzeige4 = new Anzeige(5006, "Suche einen Satz Sommerreifen für einen Golf V", "01.03.2019");
	$anzeige5 = new Anzeige(5009, "Verkaufe Pippi Langstrump im Taka-Tuka-Land", "02.03.2019");
	$anzeige9 = new Anzeige(5009, "Verkaufe Pippi Langstrump im Taka-Tuka-Land", "02.03.2019");
	
	$inserent1 = new Inserent(12, "Hugo", "darkness4711@web.de");
	$inserent2 = new Inserent(14, "Mickeymouse", "franz@gmail.com");
	$inserent3 = new Inserent(15, "Lisa", "lisa@gmx.de");
	
	$anzeige1->setInserent($inserent1);
	$anzeige2->setInserent($inserent2);
	$anzeige3->setInserent($inserent1);
	$anzeige4->setInserent(new Inserent(17, "Medusa", "medusa73@gmx.de"));
	$anzeige5->setInserent($inserent3);
	
	$rubrik3->addAnzeige($anzeige1);
	$rubrik2->addAnzeige($anzeige2);
	$rubrik3->addAnzeige($anzeige2);
	$rubrik3->addAnzeige($anzeige3);
	$rubrik1->addAnzeige($anzeige4);
	$rubrik2->addAnzeige($anzeige5);
	$rubrik1->addAnzeige(new Anzeige(5010, "718 Boxster günstig zu verkaufen", "22.02.2019", new Inserent(118, "Donald", "donaldduck@gmx.de")));
	
	echo "1. Aufruf " . $anzeige1->getNummer() ."<br>";
	$anzeige1->setNummer(899);
	echo  "2. Aufruf " . $anzeige1->getNummer();
	
	
	echo "<br><br><strong>" . $rubrik1->getNummer() . " " . $rubrik1->getBezeichnung() . "</strong><br><br>";
	
	foreach($rubrik1->getAnzeigenList() as $anzeige){
		echo "Nickname: " . $anzeige->getInserent()->getNickname() . "<br>";
		echo "E-Mail: " . $anzeige->getInserent()->getEmail() . "<br>";
		echo "vom " . $anzeige->getDatum() . "<br>";
		echo $anzeige->getText() . "<br><br>";
	}
	
	echo "<br><br><strong>" . $rubrik2->getNummer() . " " . $rubrik2->getBezeichnung() . "</strong><br><br>";
	
	foreach($rubrik2->getAnzeigenList() as $anzeige){
		echo "Nickname: " . $anzeige->getInserent()->getNickname() . "<br>";
		echo "E-Mail: " . $anzeige->getInserent()->getEmail() . "<br>";
		echo "vom " . $anzeige->getDatum() . "<br>";
		echo $anzeige->getText() . "<br><br>";
	}
	
	echo "<br><br><strong>" . $rubrik3->getNummer() . " " . $rubrik3->getBezeichnung() . "</strong><br><br>";
	
	foreach($rubrik3->getAnzeigenList() as $anzeige){
		echo "Nickname: " . $anzeige->getInserent()->getNickname() . "<br>";
		echo "E-Mail: " . $anzeige->getInserent()->getEmail() . "<br>";
		echo "vom " . $anzeige->getDatum() . "<br>";
		echo $anzeige->getText() . "<br><br>";
	}
?>
 