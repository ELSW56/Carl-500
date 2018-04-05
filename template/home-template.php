<?php 
/* Last Modified: 2015-07-02
 * Object : modification of the way data for the timeline is retrieved from the DB, using a new function runs_timeline from file timeline functions */
	$selected_driver=0;
	$selected_car=0;
	$indisp=0;
	if (!isset($_GET['timeline'])) {
		$vue='driver';
		$selected_driver='selected="selected"';
		$runs='non terminés';
	}
	else {
		if($_GET['timeline']=='car'){
			$vue='car';
			$selected_car='selected="selected"';
			$indisp = 1;
		}
		else {
			$vue='driver';
			$selected_driver='selected="selected"';
		}
	}	 
	$drivers = get_all_id_name_driver_with_run(1);
	$cars = get_all_id_name_car(1);


if (isset($_GET['filter'])) {
$part_date = explode("/", $_GET['filter']);
$day_filter=$part_date[0];}

?>   
	<div style="margin-top: 5px; margin-bottom: 5px;">
		
      	<select name="Lien" size="1" onchange="window.location.href=this.value">
            <option value="/carl500/?timeline=driver<?php if(isset($_GET['filter'])){ echo '&filter='.$_GET['filter']; } ?>" <?php echo $selected_driver; ?> >Chauffeurs</option>
        	<option value="/carl500/?timeline=car<?php if(isset($_GET['filter'])){ echo '&filter='.$_GET['filter']; } ?>"  <?php echo $selected_car; ?> >Véhicules</option> 
    	</select>

	</div>

    <style>
      body {
        color: #4D4D4D;
        font: 8pt arial;
      }
    </style>

<div id="info_action" class="alert alert-success" style="display:none; height:40px;" ></div>

<div id="display_info" class="alert alert-info" style="display:none; height:50px;"></div>

<div id="info" ></div>

<script type="text/javascript" src="style/js/jsapi"></script>
<script type="text/javascript" src="style/js/vis/dist/vis.js"></script>
<link href="style/js/vis/dist/vis.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="style/css/timeline.css">
<script type="text/javascript">

	//Définition des groupes (chauffeurs ou véhicules) pour la timeline
	var groups = new vis.DataSet([
	<?php
		$id=1;
		if ($vue == 'driver') {
			echo "{id: -1, content: \"<span style='color:red;'>Sans chauffeur</span>\", order: 'A'}\n\t";
			foreach($drivers as $chauffeur) :
				echo ",{id: '".$chauffeur['id']."', content : '".$chauffeur['first_name']." ".$chauffeur['last_name']."', order: '".$chauffeur['first_name']." ".$chauffeur['last_name']."'}";
				echo "\n\t";
				$id++;
			endforeach;
		} else {
			echo "{id: -1, content: \"<span style='color:red;'>Sans véhicule</span>\", order: '0'}\n\t";
			foreach($cars as $vehicule) :
				echo ",{id: '".$vehicule['id']."', content : '".$vehicule['manufacturer']." ".$vehicule['model']."', order: '".$vehicule['model']."'}";
				echo "\n\t";
				$id++;
			endforeach;
		}
	?>
	]);
	// Définition des items de la timeline en fonction des drives et des indisponibilités de la BD
	var items = [
	<?php 
		$sep=0 ;
		// Traitement des drives
			foreach(runs_timeline() as $a_drive) :
				if($a_drive['depart']!=0) :
					if ($vue == 'driver') {
						$group = $a_drive['driver'];
					} else {
						$group = $a_drive['car'];
					}
					if ($sep>0) 
						{echo ',';} 
					else 
						{$sep=1;}
					$item_id=$a_drive['id'];
					echo "{id: '".$a_drive['id_run']."-".$item_id."', start: new Date(".$a_drive['depart']."), end: new Date(".$a_drive['arrivee']."), content: '";
					echo $a_drive['band']."', group: \"".$group."\", editable : true, className: \"run_".$a_drive['statut']."\"}";
					//echo $a_drive['band']."', group: \"".$group."\", ".$a_drive['editable'].", className: \"run_".$a_drive['statut']."\"}";
					echo "\n\t";
				endif;
			endforeach; 
			
			//Traitement des indisponibilités
			$id_indispo=0;
			foreach(get_indisponibilities($indisp) as $a_driver_indisponibility) : 
				if ($sep>0) 
					{echo ',';} 
				else 
					{$sep=1;}
				echo "{id: ".$a_driver_indisponibility['id'].", start: new Date(".get_date_dep_indisponibility_timeline($a_driver_indisponibility)."), end: new Date(".get_date_arr_indisponibility_timeline($a_driver_indisponibility);
				echo "), content: 'Indisponible', group: \"";
				echo $a_driver_indisponibility['id_item']."\", editable: true , className: \"run_grey\"}";
				echo "\n\t";
				if ($id_indispo < $a_driver_indisponibility['id']) {$id_indispo = $a_driver_indisponibility['id'];}
			endforeach;
	?>
	];
	//Transformation des données en DataSet avant inclusion sur la timeline
	var data = new vis.DataSet(items);

	// Spécification des options pour la timeline
	var options = {
		//Affichage
		min: new Date(<?php start_timeline() ?>),                 
		max: new Date(<?php end_timeline() ?>), 
		width:  "100%",
		orientation: 'both',
		showMajorLabels: true,
		stack: false,
		//Comportement
		editable: true, 
		//Fonction déclenchée en cas d'ajout d'un item (une indisponibilité)
		onAdd: function (item, callback) {
			item.content = 'Indisponible';
			item.end = new Date(item.start.toDateString());
			item.end.setHours(item.start.getHours()+8);
			item.type='range';
			item.className='run_grey';
			item.title = 'Indisponible '+item.id;
			<?php if($vue=='driver'){ echo 'var type=0;'; }
			if($vue=='car'){ echo 'var type=1;'; }?>
			
			var start_ajax = item.start.getFullYear()+'-'+(item.start.getMonth()+1)+'-'+item.start.getDate()+' '+item.start.getHours();
			var end_ajax = item.end.getFullYear()+'-'+(item.end.getMonth()+1)+'-'+item.end.getDate()+' '+item.end.getHours();
			var oldItem = data.get(item.id);
			$.ajax({
					type : 'GET',
					url : '/carl500/?page=ajax&action=add&option=no_header_footer' ,
					data : 'type='+type+'&item='+item.group+'&start='+start_ajax+'&end='+end_ajax ,
					dataType : "json",
					beforeSend : function() {
						$('#info_action').html('');
						$('#info_action').css({opacity:'1'});
						$('#info_action').show();
					},
					success : function(msg){ 
					item.id=msg[0];
					data.add(item);
					$('#info_action').html('<b>Indisponibilité ajoutée : '+msg[0]+'</b> Vous pouvez la modifier ou la déplacer');
					$('#info_action').delay(5000).animate({height: 'hide', opacity :'0'}, 520);
					}
				});
			callback(null);
		},
		//Fonction déclenchée en cas de modification d'un item (une indisponibilité)
		onMove: function(item, callback) {
			if (item.className == 'run_grey') {
				var start_ajax = item.start.getFullYear()+'-'+(item.start.getMonth()+1)+'-'+item.start.getDate()+' '+item.start.getHours();
				var end_ajax = item.end.getFullYear()+'-'+(item.end.getMonth()+1)+'-'+item.end.getDate()+' '+item.end.getHours();
				$.ajax({
						type : 'GET',
						url : '/carl500/?page=ajax&action=update&option=no_header_footer' ,
						data : 'id='+item.id+'&item='+item.group+'&start='+start_ajax+'&end='+end_ajax,
						beforeSend : function() {
							$('#info_action').html('');
							$('#info_action').css({opacity:'1'});
							$('#info_action').show();
						},
						success : function(data){ 					
							$('#info_action').html(item.className+'<b>Modification : '+item.id+' '+item.group+' '+start_ajax+' '+end_ajax+'!');
							$('#info_action').delay(5000).animate({height: 'hide', opacity :'0'}, 520);							}
					});
					
				callback(item);
			}
			else {
				<?php if($vue=='driver'){ echo 'var type=0;'; }
				if($vue=='car'){ echo 'var type=1;'; }?>
				var start_ajax = item.start.getFullYear()+'-'+(item.start.getMonth()+1)+'-'+item.start.getDate()+' '+item.start.getHours();
				var end_ajax = item.end.getFullYear()+'-'+(item.end.getMonth()+1)+'-'+item.end.getDate()+' '+item.end.getHours();
				
					$.ajax({
							type : 'GET',
							url : '/carl500/?page=ajax&action=update_drive&option=no_header_footer' ,
							data : 'id='+item.id.split('-')[1].trim()+'&group='+item.group+'&type='+type+'&start='+start_ajax+'&end='+end_ajax,
							success : function(msg){
							if (parseInt(msg) == 0) {						
								item.className = 'run_red';
							}
							if (parseInt(msg) == 1) {						
								item.className = 'run_green';
							}
							if (parseInt(msg) == 2) {						
								item.className = 'run_white';
							}
							data.update(item);
							}						
						});
						
					callback(item);				
			}
		},
		onRemove: function(item, callback) {
					if (item.className == 'run_grey') {
						$.ajax({
							type : 'GET',
							url : '/carl500/?page=ajax&action=delete&option=no_header_footer' ,
							data : 'id='+item.id,
							beforeSend : function() {
								$('#info_action').html('');
								$('#info_action').css({opacity:'1'});
								$('#info_action').show();
							},
							success : function(data){ 
								$('#info_action').html('<b>Suppression :</b> Indisponibilité supprimée avec succès !');
								$('#info_action').delay(5000).animate({height: 'hide', opacity :'0'}, 520);					
							}
						});
							
						callback(item);
					}
					else {
						var oldItem = item
						$.ajax({
							type : 'GET',
							url : '/carl500/?page=ajax&action=delete_drive&option=no_header_footer' ,
							data : 'id='+item.id.split('-')[1].trim(),
							success : function(msg){ 
								if (parseInt(msg) == 1) {
									alert('Impossible : supprimer le run si besoin !');
									data.add(oldItem);
								}
							}
						});
							
						callback(item);
						
					}
		}
	};
 
 			// Make a callback function for the select event
    function onTLSelection (properties) {
		var item = data.get(properties.items[0]);
	    var id_run = parseInt(item.id);
		var id_drive = item.id.split('-')[1];
				<?php if($vue=='driver'){ echo 'var type=0;'; }
				if($vue=='car'){ echo 'var type=1;'; }?>
		
		// Affichage des informations basiques sur le run sélectionné et accès à sa modification
		//Aucune action si c'est une indisponibilité qui est sélectionnée
		if(item.className != 'run_grey'){
			//$('#display_info').hide();

			$.ajax({
				type : 'GET',
				url : '/carl500/?page=ajax&action=display&option=no_header_footer' ,
				data : 'id_run='+id_run+'&id='+id_drive+'&type='+type,
				beforeSend : function() {
					$('#display_info').show();
					$('#display_info').css({opacity:'1'});
					$('#display_info').html('<img class="loader_date" src="/carl500/style/images/loading.gif" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');

				},
				success : function(data){ 

					$('#display_info').html(data);
				}
			});

		}
		

	};
	var timeline = new vis.Timeline(container);
	timeline.setOptions(options);
	timeline.setGroups(groups);
	timeline.setItems(data);
	timeline.on('select', onTLSelection);
	
 </script>	
 