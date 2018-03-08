<?php
/**
 * Feature name:  CARL 500 people-modify-template
 * Description:   Page de modification d'une personne
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<form method="post" action="/carl500/?page=check&action=modify&check=people" enctype="multipart/form-data">
	<?php if(isset($_GET['error']) && $_GET['error']=='error'){
			echo'<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
		}
	?>
	<div style= "padding: 25px;">
		<input type="hidden" name="id" value=<?php echo $_GET['id']; ?>>
		<div> 
			<legend>Type</legend>

			<select class="input-xlarge" name="type" size="1">
			            <!-- dropdown menu links -->
						<option value=""></option>

						<?php
						foreach (get_people_types() as $people_type) {
							if(get_people_type_by_id($_GET['id'])==$people_type[type]){
								echo '<option value="'.$people_type[id].'" selected="selected">'.$people_type[type].'</option>';
							}
							else{
								echo '<option value="'.$people_type[id].'">'.$people_type[type].'</option>';
							}
						} ?>
			          </select>
		</div>

		<div> 
			<legend>Sexe</legend>

			<select class="input-small" name="gender" size="1">
			            <!-- dropdown menu links -->
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

		<div> 
			<legend>Nom</legend>

			<input class="input-xlarge" name="last_name" type="text" value="<?php people_last_name_by_id($_GET['id']); ?>">

		</div>

		<div> 
			<legend>Prénom</legend>

			<input class="input-xlarge" name="first_name" type="text" value="<?php people_first_name_by_id($_GET['id']); ?>">
		</div>

		<div> 
			<legend>Tél</legend>

			<input class="input-xlarge" name="phone" type="tel" value="<?php people_phone_by_id($_GET['id']); ?>">
		</div>

		<div> 
			<legend>E-mail</legend>

			<input class="input-xlarge" name="email" type="email" value="<?php people_email_by_id($_GET['id']); ?>">

		</div>

		<div style= "margin-left: 1000px; margin-top: 10px;">
			
			<input type="submit" value="Valider" class ="btn"/>

			<a href = "/carl500/?page=people"><div class ="btn">

			Annuler
			
			</div></a>

		</div>

	</div>
</form>