<?php
/**
 * Feature name:  CARL 500 people-add-template
 * Description:   Page d'ajout d'une personne
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<form method="post" action="/carl500/?page=check&action=add&check=people" enctype="multipart/form-data">
	<div style= "padding: 25px;">

		<?php if(isset($_GET['error']) && $_GET['error']=='error'){
				echo'<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
			}
		?>

		<div> 
			<legend><em>*</em> Type</legend>

			<select class="input-xlarge" name="type" size="1">
			            <option value=""></option>
			            <?php 
			            	foreach (get_people_types() as $people_type) {
			            		echo '<option value="'.$people_type[id].'">'.$people_type[type].'</option>';
			            	}
			            ?>
			          </select>
		</div>

		<div> 
			<legend><em>*</em> Sexe</legend>

			<select class="input-small" name="gender" size="1">
			            <!-- dropdown menu links -->
			            <option>Mr</option>
			            <option>Mme</option>
			            <option>Mlle</option>
			          </select>
		</div>

		<div> 
			<legend><em>*</em> Nom</legend>

			<input class="input-xlarge" name="last_name" type="text" placeholder="Exemple : Dupont">

		</div>

		<div> 
			<legend><em>*</em> Prénom</legend>

			<input class="input-xlarge" name="first_name" type="text" placeholder="Exemple : Pierre">
		</div>

		<div> 
			<legend>Tél</legend>

			<input class="input-xlarge" name="phone" type="text" placeholder="Exemple : 06 00 00 00 00">
		</div>

		<div> 
			<legend>E-mail</legend>

			<input class="input-xlarge" name="email" type="email" placeholder="test@exemple.com">

		</div>

		<div style= "margin-left: 1000px; margin-top: 10px;">
			
			<input type="submit" value="Valider" class ="btn"/>

			<a href = "/carl500/?page=people"><div class ="btn">

			Annuler
			
			</div></a>

		</div>

	</div>
</form>