<?php 
// ajout d'une indisponibilité
if($_GET['action']=='add'){
	if((!empty($_GET['item']))&&(!empty($_GET['start']))&&(!empty($_GET['end']))){
		echo $id=add_indisponibility($_GET['type'],$_GET['item'],$_GET['start'], $_GET['end']);
		}
	}
// suppression d'une indisponibilité
if($_GET['action']=='delete'){
	if(!empty($_GET['id'])){
		delete_indisponibility($_GET['id']);
	}
}
// mise-à-jour d'une indisponibilité
if($_GET['action']=='update'){
	if((!empty($_GET['id']))&&(!empty($_GET['start']))&&(!empty($_GET['end']))){
		update_indisponibility($_GET['id'],$_GET['item'],$_GET['start'],$_GET['end']);
	}
}
// mise-à-jour d'un drive
if($_GET['action']=='update_drive'){
	if((!empty($_GET['id']))&&(!empty($_GET['group']))&&(!empty($_GET['start']))&&(!empty($_GET['end']))){
		echo update_drive($_GET['id'],$_GET['group'],$_GET['type'],$_GET['start'],$_GET['end']);
	}
}

// Suppression d'un drive
if($_GET['action']=='delete_drive'){
	if(!empty($_GET['id'])){
		echo delete_a_drive($_GET['id']);
	}
}


if ($_GET['action']=='statusT'){
	if(!empty($_GET['id'])) {
		$id_drive = explode("-",$_GET['id'])[1];
		drive_mark_finished($id_drive);
	}
}

if ($_GET['action']=='statusNT'){
	if(!empty($_GET['id'])) {
		$id_drive = explode("-",$_GET['id'])[1];
		echo drive_mark_not_finished($id_drive);
	}
}

// Affichage d'un drive
if($_GET['action']=='display') : 
//<button type="button" class="close" data-dismiss="alert">×</button>?>
	<div style="float:left; width:800px; font: 10pt arial;">
		<div>
		Run <?php echo $_GET['id_run']; ?> - 
		<?php run_band($_GET['id_run']); ?> - 
		<?php run_number_persons($_GET['id_run']); ?> personnes</div>

		<div><?php run_destination_timeline($_GET['id_run']); ?></div>

		<div><?php 
				run_hour_dep_timeline($_GET['id_run']); 
				echo " -> ";
				run_hour_arr_timeline($_GET['id_run']); 
				if ($_GET['type']==0) {
					echo ' - Véhicule : ';
					run_car($_GET['id']);
				} else {
					echo ' - Chauffeur : ';
					run_driver($_GET['id']);
				} ?></div>

	</div>

	<div>
        <div  class ="btn child" style =" float:none; margin-top: 5px; margin-bottom: 5px;"> <a class="child" href="/carl500/?page=run&action=display&id=<?php echo $_GET['id_run']; ?>">Afficher en détail</a></div> 
		<div  class ="btn child" style ="  float:none;"><a class="child" href="/carl500/?page=run&action=modify&id=<?php echo $_GET['id_run']; ?>"> Modifier </a></div> 
		<div  class="btn child mark markmark" id="mark<?php echo $_GET['id_run'].'-'.$_GET['id']; ?>" style="float:none<?php echo displayMode($_GET['id'],'t'); ?>">Terminé</div> 
		<div  class="btn child mark unmark" id="unmark<?php echo $_GET['id_run'].'-'.$_GET['id']; ?>" style="float:none<?php echo displayMode($_GET['id'],'nt'); ?>">Non terminé</div> 
	</div>
<script>
$(document).ready(function(){
	$('.markmark').live('click', function(){
		$(this).hide();
		$('.unmark').show();
	var id=$(this).attr('id').replace('mark','');

		$.ajax({
			type : 'GET',
			url : '/carl500/?page=ajax&&action=statusT&option=no_header_footer',
			data : 'id='+id,
			success : function(msg){
				var item = data.get(id);
				item.className = 'run_white';
				data.update(item);
			}
		});
	});
	$('.unmark').live('click', function(){
		$(this).hide();
		$('.markmark').show();
	var id=$(this).attr('id').replace('unmark','');

		$.ajax({
			type : 'GET',
			url : '/carl500/?page=ajax&&action=statusNT&option=no_header_footer',
			data : 'id='+id,
			success : function(msg){
				var item = data.get(id);
				var pos = msg.search("run");
				var classe = msg.slice(pos,msg.length);
				item.className = classe;
				data.update(item);
			}
		});
	});
});	
</script>
<?php endif; ?>