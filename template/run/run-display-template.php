<?php
/**
 * Feature name:  CARL 500 run-display-template
 * Description:   Page d'affichage d'un run
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<div style="margin-left: 80%; margin-top: 10px; margin-bottom: 15px;">
		
		<div class ="btn non-printable"><a href="#" onclick="window.print(); return false;">Imprimer cette page</a></div>

		<div class ="btn non-printable" style="margin-left: 10px;">
			<a href="/carl500/?page=run&action=modify&id=<?php echo $_GET['id']; ?>">
				Modifier le RUN
			</a>
		</div>

	</div>

<div style="height: 70px;border:1px solid black;border-radius: 25px;">
		<div class="affichage_titre">
			Groupe

		</div>

		<div class="affichage_titre">
			Compagnie

		</div>

		<div class="affichage_titre">
			Nombre de personnes
		</div>

		<div class= "lead affichage_info" > <?php run_band($_GET['id']); ?> </div>
			
		<div class= "lead affichage_info" > <?php run_company($_GET['id']); ?> </div>

		<div class= "lead affichage_info" > <?php run_number_persons($_GET['id']); ?> </div>
</div>
<br>
	<?php $count_traject=1; foreach(get_ways_by_id_run($_GET['id']) as $a_way) : ?>

		<div class="trajet_display" style="border:1px solid black;border-radius: 25px;height: 200px;margin-bottom:5px">

			<h3 class="title_trajet"> Trajet <?php echo $count_traject; ?></h3>
	
			<div class="affichage_titre2">Lieu de d&eacute;part </div>
	
			<div class="affichage_titre2">Lieu d'arriv&eacute;e </div>
	
			<div class= "lead affichage_info2" ><?php way_location_dep_by_id_run($a_way['id']); ?><br><small><?php way_location_dep_address_by_id_run($a_way['id']); ?></small></div>
	
			<div class= "lead affichage_info2" ><?php way_location_arr_by_id_run($a_way['id']); ?><br><small><?php way_location_arr_address_by_id_run($a_way['id']); ?></small></div>
	
			<div class="affichage_titre3"> Date de d&eacute;part </div>
	
			<div class="affichage_titre3"> Heure de d&eacute;part </div>
	
			<div class="affichage_titre3">Date d'arriv&eacute;e </div>
	
			<div class="affichage_titre3"> Heure d'arriv&eacute;e </div>
	
			<div class= "lead affichage_info3" > <?php way_date_dep_by_id_run($a_way['id']); ?> </div>
	
			<div class= "lead affichage_info3" > <?php way_hour_dep_by_id_run($a_way['id']); ?> </div>
	
			<div class= "lead affichage_info3" > <?php way_date_arr_by_id_run($a_way['id']); ?> </div>
	
			<div class= "lead affichage_info3" > <?php way_hour_arr_by_id_run($a_way['id']); ?> </div>

		</div>

	<?php $count_traject++; endforeach; ?>
<br>
<div style="border:1px solid black;border-radius: 25px;">	

 	<?php 	$drives = get_drives_by_id_run($_GET['id']);
			if ($drives!=null) {
			$nb=0;
			foreach($drives as $a_drive) : 
			?>

		<div style="height: <?php if ($nb==0) {echo '50';} else {echo '40';} ?>px;">

			<?php if ($nb==0) : ?><div class="affichage_titre2"> Chauffeur(s)</div>

			<div class="affichage_titre2"> V&eacute;hicule(s) </div><?php endif ?>


				<div class= "affichage_info2" > <?php run_driver($a_drive); ?> </div>

				<div class= "affichage_info2" > <?php run_car($a_drive); ?> </div>

		</div>
	<?php $nb++; endforeach;} else { ?>
		<div class= "separation" style="width: 98%;" ></div>

		<div style="height: 20px;">

			<div class="affichage_titre2"> Chauffeur</div>

			<div class="affichage_titre2"> V&eacute;hicule </div>


				<div class= "affichage_info2" > Aucun </div>

				<div class= "affichage_info2" > Aucun </div>

		</div>
	<?php } ?>
</div>
<br>
<div style="border:1px solid black;border-radius: 25px;">	
	<div class="affichage_titre4" style="height:20px;">

		Commentaires
	
	</div>

	<div class="affichage_info4">

		<b><?php run_comments($_GET['id']); ?></b>

	</div>
</div>

<div class="non-printable" style="padding-left: 10px;"> <?php run_status($_GET['id']); ?> </div>

		<div class ="btn non-printable" style="margin-left: 750px; float:left;">

			<a href="/carl500/">Timeline chauffeurs</a>
		
		</div>

		<div class ="btn non-printable" style="margin-left: 10px; float:left;">

			<a href="/carl500/?timeline=car">Timeline véhicules</a>
		
		</div>


		<div class ="btn non-printable" style="margin-left: 10px;">

			<a href="/carl500/?page=run">Retour à la liste</a>
		
		</div>




