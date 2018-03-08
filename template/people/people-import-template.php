

<div style="padding: 25px;">
			
			<legend> Import de fichiers .csv pour Personnes.</legend>		
			
			
			<div style="margin-bottom: 10px;"> Veuillez selectionner un fichier de type CSV ayant pour colonnes : </div>
			
			<ul class="inline">
  			<li>id_type*</li>
  			<li>sexe*</li>
  			<li>nom*</li>
  			<li>prénom*</li>
  			<li>téléphone</li>
  			<li>e-mail<li>
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
			$gender = $data[1];
			$last_name = $data[2];
			$first_name = $data[3];
			$phone = $data[4];
			$mail = $data[5];

			$verif = verif_variables_people($type, $gender, $last_name, $first_name);
			if($verif == true){
				$people = new People();
				$people->init($type, $gender, $last_name, $first_name, $phone, $mail);
				$people->save();
			}

			else{
				$echo = $echo.'<center><p style="color:red;">Certaines informations obligatoires sont manquantes sur la ligne '.$row.'</p></center><br/>';
				//echo '<center><p style="color:red;">Certaines informations obligatoires sont manquantes sur la ligne '.$row.'</p></center>';
			}

			$row++;	  
		}
		echo $echo;
		fclose($handle);
	}
}
?>