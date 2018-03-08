<?php 
   	$status=0;
    $calles=0;
	$selected_driver=0;
	$selected_car=0;
	if (!isset($_GET['timeline'])) {
		$vue='driver';
		$selected_driver='selected="selected"';
		$runs='non terminés';
	}
	else {
		if($_GET['timeline']=='car'){
			$vue='car';
			$selected_car='selected="selected"';
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
if(empty($day_filter)){
// PAS TERMINE !!!


}
?>   
	<div style="margin-top: 5px; margin-bottom: 5px;">
 		<select type="text" id="indisponibilty" name="car1" onchange="addIndisponibilty()" style="margin-right: 520px;"/>
        	<option value="no_indisp">Ajouter une indisponibilité</option>
				<?php
      			if($vue=='car'){
					foreach ($cars as $row) {
						echo'<option id="'.$row['id'].'" value="'.$row['manufacturer'].' '.$row['model'].'">'.$row['manufacturer'].' '.$row['model'].'</option>';
					} 
     			}
      			if($vue=='driver'){
					foreach ($drivers as $row) {
						echo'<option id="'.$row['id'].'" value="'.$row['first_name'].' '.$row['last_name'].'">'.$row['first_name'].' '.$row['last_name'].'</option>';
					}  
      			}
				?>
		</select>   

	 	<select name="Lien" size="1" onchange="window.location.href=this.value" style=" margin-right: 10px;">
            <option value="/carl500/?timeline=<?php echo $vue; ?>">Tous les jours</a></option>
           	<?php foreach(get_days() as $a_day) : ?>
            	<option value="/carl500/?<?php echo 'timeline='.$vue.'&'; ?>filter=<?php echo $a_day; ?>" <?php if(isset($_GET['filter'])&& ($a_day==$_GET['filter'])){ echo 'selected="selected"'; } ?> ><?php echo $a_day; ?></a></option>
			<?php endforeach; ?>
        </select>

      	<select name="Lien" size="1" onchange="window.location.href=this.value">
            <option value="/carl500/?timeline=driver<?php if(isset($_GET['filter'])){ echo '&filter='.$_GET['filter']; } ?>" <?php echo $selected_driver; ?> >Chauffeurs</option>
        	<option value="/carl500/?timeline=car<?php if(isset($_GET['filter'])){ echo '&filter='.$_GET['filter']; } ?>"  <?php echo $selected_car; ?> >Véhicules</option> 
    	</select>

	</div>

    <style>
      body {
        color: #4D4D4D;
        font: 10pt arial;
      }
    </style>


<script type="text/javascript" src="style/js/jsapi"></script>
<script type="text/javascript" src="style/js/timeline.js"></script>
<link rel="stylesheet" type="text/css" href="style/css/timeline.css">
<script type="text/javascript">
var myDate = new Date(); 
var year=myDate.getFullYear();
var timeline;
var data;
google.load("visualization", "1");
google.setOnLoadCallback(drawChart);
function drawChart() {
  var container = document.getElementById('mytimeline');
  timeline = new links.Timeline(container);
  data = new google.visualization.DataTable();
  data.addColumn({ type: 'date', id: 'start' });
  data.addColumn({ type: 'date', id: 'end' });
  data.addColumn({ type: 'string', id: 'content' });
  data.addColumn({ type: 'string', id: 'group' });
  data.addColumn({ type: 'boolean', id: 'editable' });
  data.addColumn({ type: 'string', id: 'className' });
  data.addRows([	
	<?php 
		$sep=0 ;
			foreach(get_all_drives() as $a_drive) :
				if(get_date_dep_run_timeline($a_drive)!=0) :
					$color=get_timeline_background($a_drive['id_run']);
					if ($vue == 'driver') {
						$item = get_driver_run_timeline($a_drive);
						if($item == " ")
							{$item="<span style='color:red;'>Sans chauffeur</span>"; }
						$indisp = 0;
					} else {
						$item=get_car_run_timeline($a_drive); 
						if($item==" "){ 
							$item="<span style='color:red;'>Sans Véhicule</span>"; }
						$indisp = 1;
					}
					if ($sep>0) 
						{echo ',';} 
					else 
						{$sep=1;}
					echo "[new Date(".get_date_dep_run_timeline($a_drive)."),new Date(".get_date_arr_run_timeline($a_drive)."), '<div style=\"background:".$color;
					echo "; color:black; height: 20px; padding-top: 7px; text-align: center; cursor: pointer;\" class=\"timeline_run\" id=\"timeline_run_".$a_drive['id_run']."\">";
					echo get_name_run_timeline($a_drive)."</div>',\"".$item."\",false,\"".$a_drive['id_run']."\"]";
					echo "\n\t";
				endif;
			endforeach; 
			foreach(get_indisponibilities($indisp) as $a_driver_indisponibility) : 
				if ($sep>0) 
					{echo ',';} 
				else 
					{$sep=1;}
				echo "[new Date(".get_date_dep_indisponibility_timeline($a_driver_indisponibility)."),new Date(".get_date_arr_indisponibility_timeline($a_driver_indisponibility);
				echo "), '<div style=\"background:#EEE; color:black; height: 20px; padding-top: 7px; text-align: center;\" class=\"timeline_run\" >Indisponible</div>',\"";
				echo get_item_indisponibility_timeline($a_driver_indisponibility)."\",true ,\"".$a_driver_indisponibility['id']."\"]";
			endforeach;
	?>
]);

            // specify options
            var options = {
	          "min": new Date(<?php start_timeline() ?>),                 
	          "max": new Date(<?php end_timeline() ?>), 
	          'width':  "100%",
	          'editable': true, 
	          'layout': "box",
				<?php if(!empty($day_filter)): ?>
	          		'start': new Date(<?php echo $part_date[2].", ".($part_date[1]-1).", ".$part_date[0]; ?>,00,01), 
	          		'end': new Date(<?php echo $part_date[2].", ".($part_date[1]-1).", ".$part_date[0]; ?>,23,59),
				<?php else : ?>
	          		'start': new Date(<?php start_timeline() ?>),                 
	          		'end': new Date(<?php end_timeline() ?>), 
				<?php endif; ?>
			  'axisOnTop': true,
	          'eventMargin': 6,  
	          'eventMarginAxis':0, 
	          'showMajorLabels': true,
	          'showCustomTime': true,
	          'showNavigation': true,
	          'snapEvents': true,
	          'dragAreaWidth': 20,
	          'groupsWidth' : "200px",
	          'groupsOnRight': false,
            };
 
			// Make a callback function for the select event
            var onselect = function (event) {
	          	var selection = timeline.getSelection();
	          	var row = selection[0].row;
	          	var col = selection[0].column;
	          	var editable = data.getValue(row, 4);
	          	var id_run = data.getValue(row, 5);


				if(editable==false){
					//$('#display_info').hide();

					$.ajax({
					  	type : 'GET',
						url : '/carl500/?page=ajax&action=display&option=no_header_footer' ,
						data : 'id_run='+id_run,
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

                var row = undefined;
                var sel = timeline.getSelection();
                if (sel.length) {
                    if (sel[0].row != undefined) {
                        var row = sel[0].row;
                    }
                }

                if (row != undefined) {
                    var content = data.getValue(row, 2);
                    document.getElementById("txtContent").value = content;
                    document.getElementById("info").innerHTML += "event " + row + " selected<br>";

                }
            };

           // callback function for the change event
           	var onchange = function () {
                var sel = timeline.getSelection();
         		var selection = timeline.getSelection();
          		var row = selection[0].row;
          		var col = selection[0].column;
          		var year = data.getValue(row, 5);
                if (sel.length) {
                    if (sel[0].row != undefined) {
                        var row = sel[0].row;
                        document.getElementById("info").innerHTML += "event " + row + " changed<br>";
                    }
                }

	          	var selection = timeline.getSelection();
	          	var row = selection[0].row;
	          	var col = selection[0].column;
	          	var id = data.getValue(row, 5);
	
	          	var start_date = data.getValue(row, 0);
	          	var end_date = data.getValue(row, 1);
	
			  	var the_date_dep=new Date(start_date);
			  	var the_date_fin=new Date(end_date);


				var the_year_start=the_date_dep.getFullYear() ;
				var the_month_start=the_date_dep.getMonth()+1 ;
				var the_day_start=the_date_dep.getDate() ;
				var the_hour_start=the_date_dep.getHours() ;
				var the_minute_start=the_date_dep.getMinutes() ;
	
				var the_year_end=the_date_fin.getFullYear() ;
				var the_month_end=the_date_fin.getMonth()+1 ;
				var the_day_end=the_date_fin.getDate() ;
				var the_hour_end=the_date_fin.getHours() ;
				var the_minute_end=the_date_fin.getMinutes() ;
	
	      		var start_ajax = the_year_start+'-'+the_month_start+'-'+the_day_start+' '+the_hour_start+':'+the_minute_start;
	            var end_ajax = the_year_end+'-'+the_month_end+'-'+the_day_end+' '+the_hour_end+':'+the_minute_end;

				$.ajax({
				  	type : 'GET',
					url : '/carl500/?page=ajax&action=update&option=no_header_footer' ,
					data : 'id='+id+'&start='+start_ajax+'&end='+end_ajax,
					beforeSend : function() {
						$('#info_action').html('');
						$('#info_action').css({opacity:'1'});
						$('#info_action').show();
					},
					success : function(data){ 
						$('#info_action').html('<b>Modification :</b> Indisponibilité modifiée avec succès !');
						$('#info_action').delay(5000).animate({height: 'hide', opacity :'0'}, 520);							}
				});
            };

            // callback function for the delete event
			var ondelete = function () {
            	var sel = timeline.getSelection();
                if (sel.length) {
                    if (sel[0].row != undefined) {
                        var row = sel[0].row;
                        document.getElementById("info").innerHTML += "event " + row + " deleted<br>";
                    }
                }

          		var selection = timeline.getSelection();
          		var row = selection[0].row;
          		var col = selection[0].column;
          		var id = data.getValue(row, 5);

				$.ajax({
				  	type : 'GET',
					url : '/carl500/?page=ajax&action=delete&option=no_header_footer' ,
					data : 'id='+id,
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
            };

           var onadd = function () {
                var count = data.getNumberOfRows();
                document.getElementById("info").innerHTML += "event " + (count-1) + " added<br>";
            };

            // Add event listeners
            google.visualization.events.addListener(timeline, 'select', onselect);
            google.visualization.events.addListener(timeline, 'change', onchange);
            google.visualization.events.addListener(timeline, 'delete', ondelete);
            google.visualization.events.addListener(timeline, 'add', onadd);


    google.visualization.events.addListener(timeline, 'select', onselect);
	timeline.draw(data, options);
}
        /**
         * Add a new event
         */
        function add() {
            var range = timeline.getVisibleChartRange();
			var the_date=new Date((range.start.valueOf() + range.end.valueOf()) / 2);

			var the_year=the_date.getFullYear() ;
			var the_month=the_date.getMonth() ;
			var the_day_start=the_date.getDate() ;
			var the_day_end=the_date.getDate() ;

			var the_hour_start=the_date.getHours()-2 ;
			var the_hour_end=the_date.getHours()+2 ;

			if(the_hour_start=='-2'){
				the_hour_start='22';
			the_day_start=the_day_start-1;
			}
			
			if(the_hour_end=='-2'){
				the_hour_end='22';
			the_day_end=the_day_end-1;
			
			}

            var start = new Date(the_year,the_month,the_day_start,the_hour_start);
            var end = new Date(the_year,the_month,the_day_end,the_hour_end);

			var the_month_ajax=the_month+1;
      		var start_ajax = the_year+'-'+the_month_ajax+'-'+the_day_start+' '+the_hour_start;
            var end_ajax = the_year+'-'+the_month_ajax+'-'+the_day_end+' '+the_hour_end;

			var indisp=$('#indisponibilty').val();
			var id_item=$("#indisponibilty option:selected").attr("id");

			<?php if($vue=='driver'){ echo 'var type=0;'; }?>
			
			<?php if($vue=='car'){ echo 'var type=1;'; }?>

			$.ajax({
				  	type : 'GET',
					url : '/carl500/?page=ajax&action=add&option=no_header_footer' ,
					data : 'type='+type+'&item='+id_item+'&start='+start_ajax+'&end='+end_ajax ,
					beforeSend : function() {
						$('#info_action').html('');
						$('#info_action').css({opacity:'1'});
						$('#info_action').show();
					},
					success : function(data){ 
	
			            timeline.addItem({
			                'start': start,
			                'end': end,
			                'content': '<div style="background:#EEE; color:black; height: 20px; padding-top: 7px; text-align: center;" class="timeline_run" >Indisponible</div>',
							'group': indisp,
							'editable': 'editable',
							'id': data
			            });
					$('#info_action').html('<b>Indisponibilité ajoutée :</b> Vous pouvez la modifier ou la déplacer');
					$('#info_action').delay(5000).animate({height: 'hide', opacity :'0'}, 520);
	
					}
				});


            //var count = data.getNumberOfRows();
            //timeline.setSelection([{
            //    'row': count-1
            //}]);
        }

        /**
         * Change the content of the currently selected event
         */
        function change(){
            // retrieve the selected row
            var sel = timeline.getSelection();
            if (sel.length) {
                if (sel[0].row != undefined) {
                    var row = sel[0].row;
                }
            }

            if (row != undefined) {
                var content = document.getElementById("txtContent").value;
                timeline.changeItem(row, {
                    'content': content
                    // Note: start, end, and group can be added here too.
                });
            } else {
                alert("First select an event, then press remove again");
            }
        }

        /**
         * Delete the currently selected event
         */
        function doDelete() {
            // retrieve the selected row
            var sel = timeline.getSelection();
            if (sel.length) {
                if (sel[0].row != undefined) {
                    var row = sel[0].row;
                }
            }

            if (row != undefined) {
                timeline.deleteItem(row);
            } else {
                alert("First select an event, then press remove again");
            }
        }
</script>
<script language="javascript">
function addIndisponibilty() {
	if($('#indisponibilty').val()!="no_indisp") {
		add();
	}
}
</script>
<script>
	$('.close').live('click', function() {
		$('#display_info').animate({height: 'hide', opacity :'0'}, 520);
	});
</script>
<div style="height:40px; margin-top: -10px;">
	<div id="info_action" class="alert alert-success" style="display:none;" >
	  ...
	</div>
</div>
<div id="display_info" class="alert alert-info" style="display:none; height:100px;">

</div>

<div id="mytimeline" ></div>

<div id="info" ></div>