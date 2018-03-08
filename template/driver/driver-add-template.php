<form method="post" action="/carl500/?page=check&action=add&check=driver" enctype="multipart/form-data">
	<?php if(isset($_GET['error']) && $_GET['error']=='error'){
			echo'<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
		}
	?>
	<div style= "padding: 25px;">


		<div style= "margin-bottom: 10px;"> 
			<legend>Sexe</legend>

			<select name="gender" size="1" style="width: 25%;">
			            <!-- dropdown menu links -->
			            <option>Mr</option>
			            <option>Mme</option>
			            <option>Mlle</option>
			          </select>
		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Nom</legend>

			<input class="input-xlarge" name="last_name" type="text" placeholder="Exemple : Dupont">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Prénom</legend>

			<input class="input-xlarge" name="first_name" type="text" placeholder="Exemple : Pierre">
		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Tél</legend>

			<input class="input-xlarge" name="phone" type="text" placeholder="Exemple : 06 00 00 00 00">
		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend>E-mail</legend>

			<input class="input-xlarge" name="email" type="email" placeholder="test@exemple.com">

		</div>

		<div style= "margin-left: 1000px; margin-top: 10px;">
			
			<input type="submit" value="Valider" class ="btn"/>

			<div class ="btn">

			Annuler
			
			</div>

		</div>

	</div>
</form>