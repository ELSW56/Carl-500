<div style= "padding: 25px;">

	<div style= "margin-bottom: 10px;"> 
		<legend>Sexe</legend>

		<select name="Lien" size="1" onchange="window.location.href=this.value" style="width: 25%;">
				<option value=""></option>
				<?php
					$gender=array('Mr','Mme','Mlle');
						
					foreach($gender as $row) {
						if(get_people_gender_by_id($_GET['id'])==$row){
							echo '<option value="'.$row.'" selected="selected">'.$row.'</option>';
						}
						else{
							echo '<option value="'.$row.'">'.$row.'</option>';
						}
					} 
				?>
		          </select>
	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Nom</legend>

		<input class="input-xlarge" type="text" value="<?php people_last_name_by_id($_GET['id']); ?>">

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Prénom</legend>

		<input class="input-xlarge" type="text" value="<?php people_first_name_by_id($_GET['id']); ?>">
	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Tél</legend>

		<input class="input-xlarge" type="text" value="<?php people_phone_by_id($_GET['id']); ?>">
	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>E-mail</legend>

		<input class="input-xlarge" type="email" value="<?php people_email_by_id($_GET['id']); ?>">

	</div>

	<div style= "margin-left: 1000px; margin-top: 10px; margin-top: 10px;">
		
		<input type="submit" value="Valider" class ="btn"/>

		<div class ="btn">

		Annuler
		
		</div>

	</div>

</div>