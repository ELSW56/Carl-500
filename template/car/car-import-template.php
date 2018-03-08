
<div style="padding: 25px;">
			
			<legend> Import de fichiers .csv pour Véhicules.</legend>		
			
			
			<div style="margin-bottom: 10px;"> Veuillez selectionner un fichier de type CSV ayant pour colonnes : </div>
			
			<ul class="inline">
  			<li>type*</li>
  			<li>immatriculation*</li>
  			<li>id_hebergement*</li>
  			<li>marque*</li>
  			<li>modèle*</li>
  			<li>capacité*<li>
  			<li>couleur*</li>
  			<li>consommation d'essence</li>
  			<li>rejet de CO2</li>
  			<li>commentaires</li>
			</ul>

			<form action='/carl500/?page=location&action=import' method='POST' enctype="multipart/form-data">
				<div>
					<input type="hidden" name="MAX_FILE_SIZE" value="100000"/>
				
					<div style="position:relative;">
			        <a class='btn' href='javascript:;'>
			            Choisissez un fichier .csv
			            <input type="file" style='position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)";opacity:0;background-color:transparent;color:transparent;' name="file" size="40"  onchange='$("#upload-file-info").html($(this).val());'>
			        </a>
       				
        			<span class='label label-info' id="upload-file-info"></span>
					</div>
				
					<div>
							<input type="submit" value="Envoyez le fichier" class="btn" style="margin-top : 10px;"/>
					</div>

				</div>

				
			</form>
</div>

<?php

// UPLOAD DU FICHIER CSV, vérification et insertion en BASE
if(!empty($_FILES["file"]["type"])){
	if($_FILES["file"]["type"] != "application/vnd.ms-excel"){
		die('<center><p style="color:red;">Ce n\'est pas un fichier de type .csv</p></center>');
	}
	else{
		$echo = "";
	    $row = 1;
	    $handle = fopen($_FILES['file']['tmp_name'], "r");

	    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

			$num = count($data);
			$type = $data[0];
			$immat = $data[1];
			$manufacturer = $data[2];
			$model = $data[3];
			$capacity = $data[4];
			$color = $data[5];
			$conso_essence = $data[6];
			$CO2 = $data[7];
			$comments = $data[8];

			$verif = verif_variables_car($type, $immat, $manufacturer, $model, $capacity, $color);

			if($verif == true){
				$car = new Car();
				$car->init($type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments);
				$car->save();
			}
			else{
				$echo .= '<center><p style="color:red;">Certaines informations obligatoires sont manquantes sur la ligne '.$row.'</p></center><br/>';
			}
			 $row++;
		}
		echo $echo;
		fclose($handle);
	}
}
?>