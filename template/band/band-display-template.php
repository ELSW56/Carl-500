<?php
/**
 * Feature name:  CARL 500 band-display-template
 * Description:   Page d'affichage d'un groupes
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<div style= "padding: 25px;">


	<div style="margin-left: 85%;">
		
		

		<div class ="btn">
			<a href="/carl500/?page=band&action=modify&id=<?php echo $_GET['id']; ?>">
				Modifier le Groupe
			</a>
		</div>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Nom du groupe</legend>

		<label><?php band_name_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Nombre de personnes</legend>

		<label><?php band_number_persons_by_id($_GET['id']); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
			<legend>Hébergement</legend>

			<label><?php location_name_by_id(get_band_hebergement_by_id($_GET['id'])); ?></label>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Scénario d'arrivée</legend>

		<?php band_start_scenario_by_id($_GET['id']); ?>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Scénario de départ</legend>

		<?php band_end_scenario_by_id($_GET['id']); ?>

	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Scénario validé </legend>
		<input type="checkbox"  disabled <?php band_validation_by_id($_GET['id']); ?>>
	</div>


	<div style= "margin-bottom: 10px;"> 
		<legend>Concert</legend>

		<label><?php band_date_show_by_id($_GET['id']); echo ' ';band_hour_show_by_id($_GET['id']);?></label>

	</div>

	<!--<div style= "margin-bottom: 15px;"> 
		<legend>Check-Sound</legend>

		<label><?php band_check_by_id($_GET['id']); ?></label>


	</div>-->

	<div style= "margin-bottom: 15px;"> 
		<legend>Nécessite d'être rappelé</legend>

		<label><?php band_rappel_by_id($_GET['id']); ?></label>
	</div>

	<div style= "margin-bottom: 10px;"> 
		<legend>Commentaires</legend>

		<?php band_comments_by_id($_GET['id']); ?>

	</div>
	<div style= "margin-bottom: 10px;"> 
		<legend>Runs existants</legend>
    <table id="tableau" border="1" width="100%">

        <thead>
            <tr>
                <th>N°</th>
				<th>Action</th>
                <th>Date de départ</th>
                <th colspan=3>Trajet</th>
                <th>Nombre de personnes</th>
                <th>Chauffeur</th>
                <th>Véhicule</th>
            </tr>
        </thead>
      
            <tbody>

		<?php foreach(band_runs_by_id($_GET['id']) as $a_run) : ?>
                <tr id="container_run_<?php echo $a_run[0]; ?>" class="<?php run_class_css($a_run); ?>">
                    <td style="text-align: center;"><?php echo $a_run[0]; ?></td>
					<td class="action child">
						<div  class ="btn child" style ="opacity:0.3; float:none; margin-top: 5px; margin-bottom: 5px;"> <a class="child" href="/carl500/?page=run&action=display&id=<?php echo $a_run['id']; ?>"><img width="20px" src="/carl500/style/images/voir.png"/> </a></div> 
						<div  class ="btn child" style =" opacity:0.3; float:none;"><a class="child" href="/carl500/?page=run&action=modify&id=<?php echo $a_run['id']; ?>"> <img width="20px" src="/carl500/style/images/modifier.png"/> </a></div> 
						<div  class ="btn child" style =" opacity:0.3; float:none;"> <a class="child" href="/carl500/?page=run&action=delete&id=<?php echo $a_run['id']; ?>"><img width="20px" src="/carl500/style/images/supprimer.png"/> </a></div></td>
                    <td style="text-align: center;"><?php echo $a_run['jdep']; ?></td>
                    <td style="text-align: center;"><?php echo $a_run['hdep']; ?></td>
                    <td style="text-align: center;"><?php echo $a_run['harr']; ?></td>
                    <td style="text-align: center;"><?php run_destination_timeline($a_run[0]); ?></td>
                    <td style="text-align: center;"><?php echo $a_run['nb']; ?></td>
					<td style="text-align: center;">
						<?php foreach (get_drives_by_id_run($a_run[0]) as $a_drive) : ?>
							<?php run_driver($a_drive);?><br>
						<?php endforeach; ?>
					</td>
					<td style="text-align: center;">
						<?php foreach (get_drives_by_id_run($a_run[0]) as $a_drive) : ?>
							<?php run_car($a_drive);?><br>
						<?php endforeach; ?>
					</td>	
                </tr>

			<?php endforeach; ?>

             </tbody>
        
    </table>

	</div>

	<div style= "margin-left: 85%; margin-top: 10px;">

		<div class ="btn">

		<a href="/carl500/?page=band">Retour à la liste</a>
		
		</div>

	</div>

</div>