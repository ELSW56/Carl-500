

<div style="padding: 25px;">
			
			<legend> Import de fichiers .csv pour Personnes.</legend>		
			
			
			<div style="margin-bottom: 10px;"> Veuillez selectionner un fichier de type CSV ayant pour colonnes : </div>
			
			<ul class="inline">
  			<li>id_lieu 1</li>
  			<li>id_lieu 2</li>
  			<li>distance</li>
  			<li>temps</li>
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
			$location1 = $data[0];
			$location2 = $data[1];
			$the_distance = $data[2];
			$time = $data[3];

			$verif = verif_variables_distance($location1, $location2, $distance, $time);
			if($verif == true){
				$distance = new Distance();
				$distance->init($location1, $location2, $the_distance, $time);
				$distance->save();
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
