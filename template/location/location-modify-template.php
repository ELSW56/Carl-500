<?php
/**
 * Feature name:  CARL 500 location-modify-template
 * Description:   Page de modification d'un lieu
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<form method="post" action="/carl500/?page=check&action=modify&check=location" enctype="multipart/form-data">
	<?php if(isset($_GET['error']) && $_GET['error']=='error'){
			echo'<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
		}
	?>

<div style= "padding: 25px;">

	
	<input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
	<div > 
		<legend>Type de Lieu</legend>
		<select name="type" size="1" style="width: 25%;">
				<option value=""></option>
				<?php
					foreach (get_location_types() as $row) {
						if(get_location_type_by_id($_GET['id'])==$row['type']){
							echo'<option value="'.$row['id'].'" selected="selected">'.$row['type'].'</option>';
						}
						else{
							echo'<option value="'.$row['id'].'">'.$row['type'].'</option>';
						}
					} 
				?>
		          </select>
	</div>


	<div  name="name"> 
		<legend>Nom</legend>

		<input class="input-xlarge" type="text" name="name" value="<?php location_name_by_id($_GET['id']) ?>">

	</div>

	<div > 
		<legend>Adresse</legend>

		<input class="input-xlarge" type="text" name="adress" value="<?php location_address_by_id($_GET['id']) ?>">
	</div>

	<div > 
		<legend>Code Postal</legend>

		<input class="input-xlarge" type="text" name="zip" value="<?php location_zip_by_id($_GET['id']) ?>">
	</div>

	<div > 
		<legend>Ville</legend>

		<input class="input-xlarge" type="text" name="town" value="<?php location_town_by_id($_GET['id']) ?>">

	</div>

	<div > 
		<legend>Pays</legend>

		<input class="input-xlarge" type="text" name="country" value="<?php location_country_by_id($_GET['id']) ?>">

	</div>

	<div > 
		<legend>Tél</legend>

		<input class="input-xlarge" type="text" name="phone" value="<?php location_phone_by_id($_GET['id']) ?>">

	</div>

	<div > 
		<legend>Fax</legend>

		<input class="input-xlarge" type="text" name="fax" value="<?php location_fax_by_id($_GET['id']) ?>">

	</div>

	<div > 
		<legend>Site Web</legend>

		<input class="input-xlarge" type="text" name="web" value="<?php location_web_by_id($_GET['id']) ?>">

	</div>

	<div style= "margin-left: 1000px; margin-top: 10px;">
		
		<input type="submit" value="Valider" class ="btn"/>

		<a href = "/carl500/?page=location"><div class ="btn">

			Annuler
			
			</div></a>

	</div>

</div>