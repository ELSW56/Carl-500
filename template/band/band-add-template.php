<?php
/**
 * Feature name:  CARL 500 band-add-template
 * Description:   Page d'ajout d'un groupe
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<link rel="stylesheet" href="/carl500/style/css/datepicker.css">
<?php if ( !defined( 'IMG_INCLUDES_PATH' ) )
	define( 'IMG_INCLUDES_PATH', '/public_html/imagina/img-includes/' ); ?>

<!-- Import Javascript codes -->
<script src="/carl500/style/js/jquery-1.8.3.js"></script>
<script src="/carl500/style/js/ui/1.10.0/jquery-ui.js"></script>
<script type="text/javascript" src="/carl500/style/js/jquery.ui.timepicker.js?v=0.3.1"></script>
<!--Datepicker and timepicker -->
<script>
  $(function() {
    $( ".beginpicker" ).datepicker({dateFormat: 'dd/mm/yy'});
    $( ".begintime" ).timepicker();
    $( ".endpicker" ).datepicker();
    $( ".endtime" ).timepicker()
  });
</script>

<script type="text/javascript">
 $(document).ready(function(){
  $('#taget_social').click(function(){
   $('#insideForm').slideToggle();
  });
 });
</script>


<form method="post" class="cmxform" id="commentForm" action="/carl500/?page=check&action=add&check=band" enctype="multipart/form-data">
	<div style= "padding: 25px;">
		<?php if(isset($_GET['error']) && $_GET['error']=='error'){
			echo'<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
		}
		?>
		<div style= "margin-bottom: 5px;"> 
			<legend><em>*</em> Nom du groupe</legend>

			<input class="input-xlarge required" name="group_name" type="text" placeholder="Exemple : C2C">

		</div>

		<div style= "margin-bottom: 5px;"> 
			<legend><em>*</em> Nombre de personne</legend>

			<input class="input-xlarge required" name="number_persons" type="text" placeholder="Exemple : 4">

		</div>

		<div style= "margin-bottom: 5px;"> 
				<legend> Hébergement</legend>

				<select name="hebergement" size="1" style="width: 25%;">
				            
				            <option value=""></option>
			            <?php 
			            
			            	foreach (get_locations() as $location) {
			            		if($location[id_location_type]==2 || $location[id_location_type]==3){
			            			echo '<option value="'.$location[id].'">'.$location[name].'</option>';
			            		}
			            	}
			            ?>
				          </select>

		</div>

		<div style= "margin-bottom: 5px;"> 
			<legend>Scénario d'arrivée</legend>

			<textarea name="start_scenario" style="width: 99%; margin: 5px;" placeholder="Ecrivez votre scénario ici...";></textarea>

		</div>

		<div style= "margin-bottom: 5px;"> 
			<legend>Scénario de départ</legend>

			<textarea name="end_scenario" style="width: 99%; margin: 5px;" placeholder="Ecrivez votre scénario ici...";></textarea>

		</div>

		<div style= "margin-bottom: 5px;"> 
			<legend>Scénarios validés</legend>

				  <input type="checkbox" name="validation" id="optionsRadios5" value="1">

		</div>

		<div style= "margin-bottom: 5px;"> 
			<legend>Concert</legend>

			<div>Date : <input type="text" name="day_passage" class="beginpicker" name="show_date" style="margin-right: 20px;"/></div>
			<div>Heure : <input type="text" name="hour_passage" class="begintime" name="show_time" /></div>

		</div>

		<!--<div style= "margin-bottom: 15px;"> 
			<legend>Check-Sound</legend>

			<label class="radio">
				  <input type="radio" name="check" id="optionsRadios1" value="1">
				  Oui
			</label>

			
			<label class="radio">
			  	<input type="radio" name="check" id="optionsRadios2" value="0" checked>
			 	Non
			</label>


		</div>-->

		<div style= "margin-bottom: 5px;"> 
			<legend>Nécessite d'être rappelé</legend>

				  <input type="checkbox" name="rappel" id="optionsRadios3" value="1" checked>

		</div>

		<div style= "margin-bottom: 5px;"> 
			<legend>Commentaires</legend>

			<textarea name="comments" style="width: 99%; margin: 5px;" placeholder="Ecrivez votre commentaire ici...";></textarea>

		</div>

		<div style= "margin-top: 10px;">
			
			<input type="submit" value="Valider" class ="submit btn"/>

			<a href = "/carl500/?page=band"><div class ="btn">

			Annuler
			
			</div></a>

		</div>

	</div>
</form>