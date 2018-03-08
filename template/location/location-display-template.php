<?php
/**
 * Feature name:  CARL 500 location-display-template
 * Description:   Page d'affichage d'un lieu
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<div style= "padding: 25px;">

	<div style="margin-left: 1020px;">
		
		

		<div class ="btn">
			<a href="/carl500/?page=location&action=modify&id=<?php echo $_GET['id']; ?>">
					Modifier le Lieu
			</a>
		</div>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Type de Lieu</legend>

		<label><?php location_type_by_id($_GET['id']) ?></label>

	</div>


	<div style= "margin-bottom: 10px;"> 
		<legend>Nom</legend>

		<label><?php location_name_by_id($_GET['id']) ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Adresse</legend>

		<label><?php location_address_by_id($_GET['id']) ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Code Postal</legend>

		<label><?php location_zip_by_id($_GET['id']) ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Ville</legend>

		<label><?php location_town_by_id($_GET['id']) ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Pays</legend>

		<label><?php location_country_by_id($_GET['id']) ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Tél</legend>

		<label><?php location_phone_by_id($_GET['id']) ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Fax</legend>

		<label><?php location_fax_by_id($_GET['id']) ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Site Web</legend>

		<label><?php location_web_by_id($_GET['id']) ?></label>

	</div>

	<div style= "margin-left: 1023px; margin-top: 10px;">

		<div class ="btn">

		<a href="/carl500/?page=location">Retour à la liste</a>
		
		</div>

	</div>

</div>