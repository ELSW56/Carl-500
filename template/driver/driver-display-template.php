<div style= "padding: 25px;">


	<div style="margin-left: 990px;">
		
		

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

	<div style= "margin-left: 1023px; margin-top: 10px;">
		
		

		<div class ="btn">

		Retour à la liste
		
		</div>

	</div>

</div>