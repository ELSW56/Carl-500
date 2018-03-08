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
	$drivers = get_all_id_name_driver(1);
	$cars = get_all_id_name_car(1);


if (isset($_GET['filter'])) {
$part_date = explode("/", $_GET['filter']);
$day_filter=$part_date[0];}

?>   
    <style>
      body {
        color: #4D4D4D;
        font: 8pt arial;
      }
    </style>

<div style="height:40px; margin-top: -10px;">
	<div id="info_action" class="alert alert-success" style="display:none;" >
	  ...
	</div>
</div>
<div id="display_info" class="alert alert-info" style="display:none; height:100px;">

</div>

<div id="mytimeline" ></div>

<div id="info" ></div>
<script type="text/javascript" src="style/js/jsapi"></script>
<script type="text/javascript" src="style/js/vis/dist/vis.js"></script>
  <link href="style/js/vis/dist/vis.css" rel="stylesheet" type="text/css" />
  <script type="text/javascript">
	var groups = new vis.DataSet([
	<?php
		echo "{id: 0, content: \"<span style='color:red;'>Sans chauffeur</span>\", value: 0}\n\t";
		$id=1;
		foreach($drivers as $chauffeur) :
			echo ",{id: '".$chauffeur['first_name']." ".$chauffeur['last_name']."', content : '".$chauffeur['first_name']." ".$chauffeur['last_name']."', value: ".$id."}";
			echo "\n\t";
			$id++;
		endforeach; 
	?>
	]);
	var data = new vis.DataSet([
	<?php 
		$sep=0 ;
		$id=0;
			// affichage des runs sur la timeline
			foreach(runs_timeline() as $a_drive) :
				if($a_drive['depart']!=0) :
					// Ajout d'une ligne pour les runs sans chauffeur et/ou sans véhicule
					if ($vue == 'driver') {
						$item = $a_drive['driver'];
						if($item == '0')
							{$item=0; }
					} else {
						$item = $a_drive['car'];
						if($a_drive['car']=='0'){ 
							$item="<span style='color:red;'>Sans Véhicule</span>"; }
					}
					if ($sep>0) 
						{echo ',';} 
					else 
						{$sep=1;}
					echo "{id: ".$id.", start: new Date(".$a_drive['depart']."), end: new Date(".$a_drive['arrivee']."), content: '<div style=\"background:".$a_drive['statut'];
					echo "; color:black; height: 20px; padding-top: 7px; text-align: center; cursor: pointer;\" class=\"timeline_run\" id=\"timeline_run_".$a_drive['id']."\">";
					echo $a_drive['band']."</div>', group: \"".$item."\", editable: false, className: \"".$a_drive['id']."\"}";
					echo "\n\t";
					$id++;
				endif;
			endforeach; 
			
			//affichage des indisponibilités sur la timeline
			foreach(get_indisponibilities($indisp) as $a_driver_indisponibility) : 
				if ($sep>0) 
					{echo ',';} 
				else 
					{$sep=1;}
				echo "{id: ".$id.", start: new Date(".get_date_dep_indisponibility_timeline($a_driver_indisponibility)."), end: new Date(".get_date_arr_indisponibility_timeline($a_driver_indisponibility);
				echo "), content: '<div style=\"background:#EEE; color:black; height: 20px; padding-top: 7px; text-align: center;\" class=\"timeline_run\" >Indisponible</div>', group: \"";
				echo get_item_indisponibility_timeline($a_driver_indisponibility)."\", editable: true , className: \"".$a_driver_indisponibility['id']."\"}";
				echo "\n\t";
				$id++;
			endforeach;
	?>
]);

            // specify options
	// var options = {
	  // min: new Date(<?php start_timeline() ?>),                 
	  // max: new Date(<?php end_timeline() ?>), 
	  // editable: true, 
	  // margin.axis: 10
	// };
	var container = document.getElementById('mytimeline');
    var timeline = new vis.Timeline(container);
	//timeline.setOptions(options);
	timeline.setGroups(groups);
	timeline.setItems(data);
</script>
