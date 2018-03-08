<?php
/**
 * Feature name:  CARL 500 location-add-template
 * Description:   Page d'ajout d'un lieu
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<form method="post" class="cmxform" id="commentForm" action="/carl500/?page=check&action=add&check=location" enctype="multipart/form-data">
	<div style= "padding: 25px;">

		<?php if(isset($_GET['error']) && $_GET['error']=='error'){
				echo'<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
			}
			elseif(isset($_GET['error']) && $_GET['error']=='loc'){
				echo'<div><center><p style="color:red;">Le lieu n\'existe pas. Veuillez l\'ajouter.</p></center></div>';
			}
		?>
		<div > 
			<legend><em>*</em> Type de Lieu</legend>

			<select class="input-xlarge required"name="type" size="1">
					<option value=""></option>
			           <?php 
			            foreach (get_location_types() as $location_type) {
			            	echo '<option value="'.$location_type['id'].'">'.$location_type['type'].'</option>';
			            }
			           ?>
			         </select>
		</div>


		<div > 
			<legend><em>*</em> Nom</legend>

			<input class="input-xlarge required" name="name" type="text" placeholder="Exemple : Hôtel Ibis">

		</div>

		<div > 
			<legend><em>*</em> Adresse</legend>

			<input class="input-xxlarge required" name="adress" type="text" placeholder="Exemple : 3 Rue de la Madeleine">
		</div>

		<div > 
			<legend><em>*</em> Code Postal</legend>

			<input class="input-xlarge required" name="zip" type="text" placeholder="Exemple : 29000">
		</div>

		<div > 
			<legend><em>*</em> Ville</legend>

			<input class="input-xlarge required" name="town" type="text" placeholder="Exemple : Carhaix">

		</div>

		<div > 
			<legend>Pays</legend>

			<input class="input-xlarge notNumber" name="country" type="text" placeholder="Exemple : France">

		</div>

		<div > 
			<legend>Tél</legend>

			<input class="input-xlarge" name="phone" type="text" placeholder="Exemple : 02 00 00 00 00">

		</div>

		<div > 
			<legend>Fax</legend>

			<input class="input-xlarge" name="fax" type="text" placeholder="Exemple : 02 00 00 00 00">

		</div>

		<div > 
			<legend>Site Web</legend>

			<input class="input-xlarge" name="web" type="text" placeholder="www.test-exemple.com">

		</div>

		<div style= "margin-top: 10px;">
			
			<input type="submit" value="Valider" class ="submit btn"/>

			<a href = "/carl500/?page=location"><div class ="btn">

			Annuler
			
			</div></a>

		</div>

	</div>
</form>