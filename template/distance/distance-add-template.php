<?php
/**
 * Feature name:  CARL 500 distance-add-template
 * Description:   Page d'ajout d'une distance
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<script>

  $(function() {
    var availableTags = [
		<?php $connexion = new ConnexionPDO();

$locations = $connexion->execute('SELECT id, name FROM location');
foreach ($locations as $row){ echo '"'.$row->name.'",'; } ?>
    ];
	$(".tags").keyup(function(){

    $( ".tags" ).autocomplete({
      source: availableTags
    });
});
  });


</script>

<form method="post" class="cmxform" id="commentForm" action="/carl500/?page=check&action=add&check=distance" enctype="multipart/form-data">
	<div style= "padding: 25px;">
		<?php if(isset($_GET['error']) && $_GET['error']=='error'){
				echo'<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
			}
		?>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Départ</legend>

			<input class="tags input-xlarge required" name="start" type="text" placeholder="Exemple : Hôtel Ibis">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Arrivée</legend>

			<input class="tags input-xlarge required" name="end" type="text" placeholder="Exemple : Gare SNCF">

		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Nombre de kms</legend>

			<input class="input-xlarge number required" name="kms" type="text" placeholder="Exemple : 50">
		</div>

		<div style= "margin-bottom: 10px;"> 
			<legend><em>*</em> Temps</legend>

			<input class="input-xlarge required" name="time" type="text" placeholder="Exemple : 00:30">
		</div>

		<div style= "margin-left: 1000px; margin-top: 10px;">
			
			<input type="submit" value="Valider" class ="btn"/>

			<a href = "/carl500/?page=distance"><div class ="btn">

			Annuler
			
			</div></a>

		</div>

	</div>
</form>