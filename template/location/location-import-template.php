<div style="padding: 25px;">
			
			<legend> Import de fichiers .csv pour Lieux.</legend>		
			
			
			<div style="margin-bottom: 10px;"> Veuillez selectionner un fichier de type CSV ayant pour colonnes : </div>
			
			<ul class="inline">
  			<li>id_type_lieu*</li>
  			<li>name*</li>
  			<li>adresse*</li>
  			<li>code postal*</li>
  			<li>ville*</li>
  			<li>pays</li>
  			<li>téléphone</li>
  			<li>fax</li>
  			<li>site web</li>
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

	    $row = 1;
	    $handle = fopen($_FILES['file']['tmp_name'], "r");

	    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {

			$num = count($data);
			$type = $data[0];
			$name = $data[1];
			$address = $data[2];
			$zip = $data[3];
			$town = $data[4];
			$country = $data[5];
			$phone = $data[6];
			$fax = $data[7];
			$web = $data[8];

			$verif = verif_variables_location($type, $name, $address, $town);
			if($verif==true){
				$location = new Location();
				$location->init($name, $type, $address, $town, $zip, $country, $phone, $fax, $web);
				$location->save();
			}
			else{
				echo '<center><p style="color:red;">Certaines informations obligatoires sont manquantes sur la ligne '.$row.'</p></center>';
			}
		  
			$row++;
		}
		fclose($handle);
	}
}
?>