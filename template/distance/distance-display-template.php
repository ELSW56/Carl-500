<?php
/**
 * Feature name:  CARL 500 distance-display-template
 * Description:   Page d'affichage d'une distance
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<div style= "padding: 25px;">

	<div style="margin-left: 1000px;">
		
		

		<div class ="btn">
			<a href="/carl500/?page=distance&action=modify&id=<?php echo $_GET['id']; ?>">
				Modifier la distance
			</a>
		</div>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Départ</legend>

		<label><?php distance_location1_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Arivée</legend>

		<label><?php distance_location2_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Nombre de kms</legend>

		<label><?php distance_distance_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Temps</legend>

		<label><?php distance_time_by_id($_GET['id']); ?></label>

	</div>


	<div style= "margin-left: 1023px; margin-top: 10px;">
		
		

		<a href="/carl500/?page=distance"><div class ="btn">

		Retour à la liste
		
		</div></a>

	</div>

</div>