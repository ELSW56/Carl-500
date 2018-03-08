<?php
/**
 * Feature name:  CARL 500 car-add-template
 * Description:   Page d'ajout d'un véhicule
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<form method="post" class="cmxform" id="commentForm" action="/carl500/?page=check&action=add&check=car" enctype="multipart/form-data">
	<?php if(isset($_GET['error']) && $_GET['error']=='error'){
			echo'<div><center><p style="color:red;">Le formulaire n\'a pas &eacute;t&eacute; rempli correctement.</p></center></div>';
		}
		if(isset($_GET['error']) && $_GET['error']=='immat'){
			echo'<div><center><p style="color:red;">La plaque d\'immatriculation est d&eacute;j&agrave; attribu&eacute;e.</p></center></div>';
		}
	?>
	<div style= "padding: 25px;">

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Type du véhicule</legend>

			<table  width="60%"><tr>
			<td><input type="radio" name="type" value="Berline" checked> Berline</td>
			<td><input type="radio" name="type" value="Bus" > Bus</td>
			<td><input type="radio" name="type" value="Monospace" > Monospace</td>
			<td><input type="radio" name="type" value="Utilitaire" > Utilitaire</td>
			<td><input type="radio" name="type" value="Van" > Van</td>
			</tr></table>
			
		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Immatriculation</legend>

			<input class="input-xlarge required" name="immat" type="text" placeholder="Exemple : AB-123-CD">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Marque</legend>

			<input class="input-xlarge required" name="manufacturer" type="text" placeholder="Exemple : Pierre">
		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Modèle</legend>

			<input class="input-xlarge required" name="model" type="text" placeholder="Exemple : 307">
		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Capacité</legend>

			<input class="input-xlarge required number" name="capacity" type="text" placeholder="Exemple : 4">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Couleur</legend>

			<input class="input-xlarge required" name="color" type="text" placeholder="Exemple : Blanche">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend>Consommation essence en L/100</legend>

			<input class="input-xlarge number" name="conso_essence" type="text" placeholder="Exemple : 10">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend>Rejet de CO2 en g/Km</legend>

			<input class="input-xlarge number" name="CO2" type="text" placeholder="Exemple : 100">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend>Commentaires</legend>

			<textarea name="comments" style="width: 99%; margin-top: 5px; max-width: 1135px;" placeholder="Ecrivez votre commentaire ici...";></textarea>

		</div>



		<div style= "margin-left: 1000px; margin-top: 10px;">
			
			<input type="submit" value="Valider" class ="submit btn"/>

			<div class ="btn">

				<a href="/carl500/?page=car">Annuler</a>
			
			</div>

		</div>

	</div>
</form>