<?php
/**
 * Feature name:  CARL 500 car-display-template
 * Description:   Page d'affichage d'un véhicule
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<div style= "padding: 25px;">

	<div style="margin-left: 1000px;">
		
		

		<div class ="btn">
			<a href="/carl500/?page=car&action=modify&id=<?php echo $_GET['id']; ?>">Modifier le Véhicule</a>		
		</div>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Type du Véhicule</legend>

		<label><?php people_car_type_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Immatriculation</legend>

		<label><?php people_car_immat_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Marque</legend>

		<label><?php people_car_manufacturer_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Modèle</legend>

		<label><?php people_car_model_by_id($_GET['id']); ?></label>
	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Capacité</legend>

		<label><?php people_car_capacity_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Couleur</legend>

		<label><?php people_car_color_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Consommation essence en L/100</legend>

		<label><?php people_car_conso_essence_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Rejet de CO2 en g/Km</legend>

		<label><?php people_car_CO2_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Commentaires</legend>

		<label><?php people_car_comments_by_id($_GET['id']); ?></label>

	</div>


	<div style= "margin-left: 860px; margin-top: 10px;">
		
		<div class ="btn" style="margin-right:10px;">

		<a href="/carl500/?timeline=car">Retour à la timeline</a>
		
		</div>
		
		<div class ="btn">

		<a href="/carl500/?page=car">Retour à la liste</a>
		
		</div>

	</div>

</div>