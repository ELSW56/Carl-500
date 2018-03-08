<?php
/**
 * Feature name:  CARL 500 people-display-template
 * Description:   Page d'affichage d'une personne
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<div style= "padding: 25px;">

	
	<div style="margin-left: 992px;">
		
		

		<div class ="btn">

		<a href="/carl500/?page=people&action=modify&id=<?php echo $_GET['id']; ?>">
			Modifier la personne
		</a>
		
		</div>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Sexe</legend>

		<label><?php people_gender_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Rôle</legend>

		<label><?php people_type_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Nom</legend>

		<label><?php people_last_name_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Prénom</legend>

		<label><?php people_first_name_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Tél</legend>

		<label><?php people_phone_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>E-mail</legend>

		<label><?php people_email_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-left: 860px; margin-top: 10px;">

		<div class ="btn" style="margin-right:10px;">

		<a href="/carl500/">Retour à la timeline</a>
		
		</div>

		<div class ="btn">

		<a href="/carl500/?page=people">Retour à la liste</a>
		
		</div>

	</div>

</div>