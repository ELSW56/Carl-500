<?php
/**
 * Feature name:  CARL 500 car-modify-template
 * Description:   Page de modification d'un véhicule
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<form method="post" action="/carl500/?page=check&action=modify&check=distance" enctype="multipart/form-data">
	<?php if(isset($_GET['error']) && $_GET['error']=='error'){
			echo'<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
		}
	?>
	<div style= "padding: 25px;">
		<input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
		<div style= "margin-bottom: 10px;"> 
			<legend>Départ</legend>

			<input class="input-xlarge" type="text" name="start" value="<?php get_location_name_by_id(distance_location1_by_id($_GET['id'])); ?>">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend>Arrivée</legend>

			<input class="input-xlarge" type="text" name="end" value="<?php get_location_name_by_id(distance_location2_by_id($_GET['id'])); ?>">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend>Nombre de kms</legend>

			<input class="input-xlarge" type="text" name="kms" value="<?php distance_distance_by_id($_GET['id']); ?>">
		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend>Temps</legend>

			<input class="input-xlarge" type="text" name="time" value="<?php distance_time_by_id($_GET['id']); ?>">
		</div>

		<div style= "margin-left: 1000px; margin-top: 10px;">
			
			<input type="submit" value="Valider" class ="btn"/>

			<a href = "/carl500/?page=distance"><div class ="btn">

			Annuler
			
			</div></a>

		</div>

	</div>
</form>