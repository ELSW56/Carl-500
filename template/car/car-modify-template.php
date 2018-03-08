<?php
/**
 * Feature name:  CARL 500 car-modify-template
 * Description:   Page de modification d'un véhicule
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<form method="post" class="cmxform" id="commentForm" action="/carl500/?page=check&action=modify&check=car" enctype="multipart/form-data">
	<?php if(isset($_GET['error']) && $_GET['error']=='error'){
			echo'<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
		}
		if(isset($_GET['error']) && $_GET['error']=='immat'){
			echo'<div><center><p style="color:red;">La plaque d\'immatriculation est déjà attribuée.</p></center></div>';
		}
	?>
	<div style= "padding: 25px;">
		<input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Type du véhicule</legend>

			<table  width="60%"><tr>
			<td><input type="radio" name="type" value="Berline" <?php if (get_car_type_by_id($_GET['id']) == "Berline") {echo " checked";}?>> Berline</td>
			<td><input type="radio" name="type" value="Bus" <?php if (get_car_type_by_id($_GET['id']) == "Bus") {echo " checked";}?>> Bus</td>
			<td><input type="radio" name="type" value="Monospace" <?php if (get_car_type_by_id($_GET['id']) == "Monospace") {echo " checked";}?>> Monospace</td>
			<td><input type="radio" name="type" value="Utilitaire" <?php if (get_car_type_by_id($_GET['id']) == "Utilitaire") {echo " checked";}?>> Utilitaire</td>
			<td><input type="radio" name="type" value="Van" <?php if (get_car_type_by_id($_GET['id']) == "Van") {echo " checked";}?>> Van</td>
			</tr></table>

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Immatriculation</legend>

			<input class="input-xlarge required" type="text" name="immat" value="<?php people_car_immat_by_id($_GET['id']); ?>">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Marque</legend>

			<input class="input-xlarge required" type="text" name="manufacturer" value="<?php people_car_manufacturer_by_id($_GET['id']); ?>">
		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Modèle</legend>

			<input class="input-xlarge required" type="text" name="model" value="<?php people_car_model_by_id($_GET['id']); ?>">
		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Capacité</legend>

			<input class="input-xlarge required" type="text" name="capacity" value="<?php people_car_capacity_by_id($_GET['id']); ?>">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Couleur</legend>

			<input class="input-xlarge required" type="text" name="color" value="<?php people_car_color_by_id($_GET['id']); ?>">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend>Consommation essence en L/100</legend>

			<input class="input-xlarge number" type="text" name="conso_essence" value="<?php people_car_conso_essence_by_id($_GET['id']); ?>">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend>Rejet de CO2 en g/Km</legend>

			<input class="input-xlarge number" type="text" name="CO2" value="<?php people_car_CO2_by_id($_GET['id']); ?>">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend>Commentaires</legend>

			<textarea name="comments" name="comments" style="width: 99%; margin-top: 5px; max-width: 1135px;" ><?php people_car_comments_by_id($_GET['id']); ?></textarea>

		</div>



		<div style= "margin-left: 1000px; margin-top: 10px;">
			
			<input type="submit" value="Valider" class ="submit btn"/>

			<div class ="btn">

			<a href="/carl500/?page=car">Annuler</a>
			
			</div>

		</div>

	</div>
</form>