<?php
	namespace classes\model;

	class AnzeigenVerwaltung{
		private $rubrikList;

		public function __construct ($rubrikList = null){
			$this->rubrikList = $rubrikList === null ? array() : $rubrikList;
		}

		public function anzeigenRubrik(){
			//Ausgabe der Rubriken als Link
			foreach($this->rubrikList as $rubrik){	
				echo "<a href=\"./index.php?rubriknummer=" .
					$rubrik->getNummer() . "\" >" . $rubrik->getBezeichnung() . "</a><br />";
			}
		}

		public function anzeigenAnzeigen($rubriknr){
			
			foreach($this->rubrikList as $rubrik){	
				if($rubrik->getNummer() == $rubriknr){
					echo "<h3>" . $rubrik->getBezeichnung() . "</h3>";

					//spart das wiederholte Aufrufen der Getter-Methode getAnzeigenList()
					$anzeigenList = $rubrik->getAnzeigenList();
					for($i = 0; $i < count($anzeigenList); $i++){
						$anzeige = $anzeigenList[$i];

						echo "<p>Anzeigendatum: " . $anzeige->getDatum() . "</p>";
						if($anzeige->getInserent() != null){
							echo "<p>Nickname: " . $anzeige->getInserent()->getNickname() . "</p>";
							echo "<p>E-Mail: " . $anzeige->getInserent()->getEmail() . "</p>";
						}
						echo "<p>" . $anzeige->getText() . "</p> ";
						echo "<br>";
					}
				}
			}
		}

		public function anzeigeEintragen(){
			$ok = 0;

			if( $this->checkEintraege()){
				$nickname = $_POST['nickname'];
				$email = $_POST['email'];
				$text = $_POST['anzeigentext'];
				$rubrikarray = $_POST['rubrik'];

				echo "in if checkeinträge<br>";
				if($this->checkNickname($nickname, $email)
					&& $this->checkEmail($nickname, $email)){
					$inserent = new Inserent(-1, $nickname, $email);
					$anzeige = new Anzeige(-1, $text, date("d.M.Y"), $inserent);
					var_dump($rubrikarray);	
							
					for($i = 0; $i < count($rubrikarray); $i++){
						for($k = 0; $k < count($this->rubrikList); $k++){
							if($rubrikarray[$i] == $this->rubrikList[$k]->getNummer()){
								$this->rubrikList[$k]->addAnzeige($anzeige);
								$ok++;
							}
						}
					}
				}
			}

			if($ok > 0 && $ok <= 3){
				echo "Ihre Anzeige wurde entgegengenommen.<br>";
			}
			else{
				echo "Leider hat es nicht geklappt...<br>";
			}
		}
	
		public function formularAufbauen(){
			?>
			<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
				<div id="input_feld">
					<label><strong>Nickname:</strong> 
					<input type="text" name="nickname">
					</label>
				</div>
				<div id="input_feld">
					<label><strong>Email:</strong> 
					<input type="text" name="email">
					</label>
				</div>
				<div id="input_feld">
					<label><strong>Azeigentext:</strong>
					<input type="text" name="anzeigentext" size="40" maxlength="255">
					</label>
				</div>
				<div id="input_feld">
					<br><strong>wählen Sie bis zu drei Rubriken:</strong><br>
				</div>
			<?php
				foreach($this->rubrikList as $rubrik){
					echo "<div id='input_feld'> \n";
					echo "<input type='checkbox' name='rubrik[]' value='" . $rubrik->getNummer()."' > ";
					echo $rubrik->getBezeichnung()." \n </div> \n";
			}
			?>
				
					<div id="input_feld">
						<input type="submit" name="ausfuehren" value="Registrieren">
					</div>
				</form>
			<?php
		}

		public function setRubrikList($rubrikList){
			$this->rubrikList = $rubrikList;
		}

		public function getRubrikList(){
			return $this->rubrikList;
		}

	/****************************************************************************************************/
	private function checkEintraege(){
		$ok = true; 

		if(empty($_POST['nickname'])){
			echo "Sie haben keinen Nicknamen angegeben!<br>";
			$ok = false; 
		}
		if(empty($_POST['email'])){
			echo "Sie haben keine Email angegeben!<br>";
			$ok = false;
		}
		if(empty($_POST['anzeigentext'])){
			echo "Sie haben keinen Anzeigentext eingegeben!<br>";
			$ok = false;
		}
		
		if( !isset($_POST['rubrik']) || count($_POST['rubrik']) > 3){
			echo "Sie sollten mindestens eine und maximal drei Rubriken angeben!<br>";
			$ok = false;
		}
		return $ok;
	}

	
	private function checkEmail($nickname, $email){
		$ok = true;

		// wird über die Datenbank gelöst
		return $ok;
	}
			
	private function checkNickname($nickname, $email){
		$ok = true;

		//wird über die Datenbank abgefragt
		return $ok;
	}
}