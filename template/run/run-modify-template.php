<?php
/**
 * Feature name:  CARL 500 run-modify-template
 * Description:   Page de modification d'un run
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

<link rel="stylesheet" href="/carl500/style/css/datepicker.css">
<!-- Import Javascript codes -->
<script src="/carl500/style/js/jquery-1.8.3.js"></script>
<script src="/carl500/style/js/jquery-ui.js"></script>
<script type="text/javascript" src="/carl500/style/js/jquery.ui.timepicker.js?v=0.3.1"></script>
<!--Datepicker and timepicker -->

<?php
		$bands = get_all_id_name_band();
		$locations = get_all_id_name_location();
		$cars = get_all_id_name_car(1);
		$drivers = get_all_id_name_driver(1);
		$companies = get_all_id_name_company();
?>

  <script>
	function date_propos(element,value_autocomplete){

		var id1=$(element).attr('name').replace('arrival_location','');
		var id2=$(element).attr('name').replace('departure_location','');
		var id3=$(element).attr('name').replace('departure_date','');
		var id4=$(element).attr('name').replace('departure_time','');
		
		if(id1.length<3){var id=id1;}
		if(id2.length<3){var id=id2;}
		if(id3.length<3){var id=id3;}
		if(id4.length<3){var id=id4;}

		var input_departure=$("input[name=departure_location"+id+"]").val();
		var input_arrival=$("input[name=arrival_location"+id+"]").val();
		var input_date=$("input[name=departure_date"+id+"]").val();
		var input_time=$("input[name=departure_time"+id+"]").val();

		if((input_departure.length>1)&&(value_autocomplete!=undefined)){ input_departure=value_autocomplete;}
		if((input_arrival.length>1)&&(value_autocomplete!=undefined)){ input_arrival=value_autocomplete;}

		if((jQuery.inArray(input_departure, verif_tags)!=-1)&&(jQuery.inArray(input_arrival, verif_tags)!=-1)&&(input_date!="")&&(input_time!="")){
			$(".loader_date").remove();
			$(".loader_time").remove();

			$.ajax({
		  		type : 'GET',
				url : '/carl500/?page=distance&action=calculate&option=no_header_footer&type=date' ,
				data : 'location1='+input_departure+'&location2='+input_arrival+'&date='+input_date+'&time='+input_time ,
				beforeSend : function() {
					$("input[name=arrival_date"+id+"]").before('<img class="loader_date" src="/carl500/style/images/loading.gif" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');
				},
				success : function(data){ 
					id_after=parseInt(id)+1;
					$(".loader_date").remove();
					$("input[name=arrival_date"+id+"]").val(data);
					$("input[name=departure_date"+id_after+"]").val(data);
				}
			});

			$.ajax({
		  		type : 'GET',
				url : '/carl500/?page=distance&action=calculate&option=no_header_footer&type=time' ,
				data : 'location1='+input_departure+'&location2='+input_arrival+'&date='+input_date+'&time='+input_time ,
				beforeSend : function() {
					$("input[name=arrival_time"+id+"]").before('<img class="loader_time" src="/carl500/style/images/loading.gif" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');
				},
				success : function(data){ 
					id_after=parseInt(id)+1;
					$(".loader_time").remove();
					$("input[name=arrival_time"+id+"]").val(data);
					$("input[name=departure_time"+id_after+"]").val(data);
					
				}
			});

			$.ajax({
		  		type : 'GET',
				url : '/carl500/?page=distance&action=calculate&option=no_header_footer&type=location2' ,
				data : 'location1='+input_departure+'&location2='+input_arrival+'&date='+input_date+'&time='+input_time ,
				beforeSend : function() {
					$("input[name=arrival_time"+id+"]").before('<img class="loader_time" src="/carl500/style/images/loading.gif" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');
				},
				success : function(data){ 
					id_after=parseInt(id)+1;
					$(".loader_time").remove();
					$("input[name=arrival_time"+id+"]").val(data);
					$("input[name=departure_time"+id_after+"]").val(data);

				}
			});
		}
	}


	    var verif_tags = [
		<?php foreach ($locations as $row){ echo '"'.$row['name'].'" , '; }?>
	    ];

	    var availableTags = [
		<?php foreach ($locations as $row){ echo '{ value: "'.$row['name'].'"},'; } ?>
	    ];

	    var band = [
		<?php foreach ($bands as $row){ echo '{ value: "'.$row['name'].'"},'; } ?>
	    ];

	    var compagny = [
		<?php foreach ($companies as $row){ echo '{ value: "'.$row['name'].'"},'; } ?>
	    ];

$(document).ready( function() {
	$('.ajax_propos').live('click, keyup', function(){
		//date_propos(this);
	});
});

	//Fonction JS qui remplit automatiquement le lieu de départ du trajet suivant avec le lieu de départ du trajet courant
	$(document).ready(function(){
	  $(".keyup_arrival").bind('keyup', function(){
	 		var id=$(this).attr('name').replace('arrival_location','');
			id++;
			$("input[name=departure_location"+id+"]").val($(this).val());
	  });  
	});

	//Fonction JS qui remplit automatiquement la date de départ du trajet suivant avec la date de départ du trajet courant
	$(document).ready(function(){
	  $(".keyup_date_arrival").bind('keyup', function(){
	 		var id=$(this).attr('name').replace('arrival_date','');
			id++;
			$("input[name=departure_date"+id+"]").val($(this).val());
	  });  
	});

  $(function() {

  		$(".tags").live('keyup.autocomplete', function(){ 
   		 	$( ".tags" ).autocomplete({
      			source: availableTags,
                select: function(event, ui) {
 					var id=$(this).attr('name').replace('arrival_location','');
					id++;
					$("input[name=departure_location"+id+"]").val(ui.item.value);
					//date_propos(this,ui.item.value);

               }
    		});  
		});
	});


  $(function() {

  		$(".tags_band").live('keyup.autocomplete', function(){ 
   		 	$(".tags_band").autocomplete({
      			source: band,
       		});  
		});
	});

  $(function() {

  		$(".tags_compagny").live('keyup.autocomplete', function(){ 
   		 	$(".tags_compagny").autocomplete({
      			source: compagny,
       		});  
		});
	});
  </script>







<script type="text/javascript">
 $(document).ready(function(){
  $('#taget_social').click(function(){
   $('#insideForm').slideToggle();
  });
 });




	function verif_date(){
		$('.error_').remove();
		var verif=true;
		var the_update_element = $('.update') ;
		var nb_ways=the_update_element.size()/4;

		for(i=1; i<nb_ways+1; i++){
			var dep_date=$("input[name=departure_date"+i+"]").val();
			var dep_time=$("input[name=departure_time"+i+"]").val();

			var arr_date=$("input[name=arrival_date"+i+"]").val();
			var arr_time=$("input[name=arrival_time"+i+"]").val();

			dep=get_time_date(dep_date,dep_time);
			arr=get_time_date(arr_date,arr_time);
		

			$("input[name=departure_date"+i+"]").removeClass('error').addClass('valid');
			$("input[name=departure_time"+i+"]").removeClass('error').addClass('valid');

			if(dep>arr){
				$("input[name=arrival_date"+i+"]").removeClass('valid').addClass('error');
				$("input[name=arrival_time"+i+"]").removeClass('valid').addClass('error');
				$("input[name=arrival_date"+i+"]").after('<label for="arrival_date'+i+'" generated="true" class="error_" style="">Date/Heure incohérente.</label>')

				verif=false
			}
			else{
				$("input[name=arrival_date"+i+"]").removeClass('error').addClass('valid');
				$("input[name=arrival_time"+i+"]").removeClass('error').addClass('valid');
			}

			if(i>1){
				i_=i-1;
				var arr_date_before=$("input[name=arrival_date"+i_+"]").val();
				var arr_time_before=$("input[name=arrival_time"+i_+"]").val();

				arr_before=get_time_date(arr_date_before,arr_time_before);

				if(arr_before>dep){
					var arr_date_before=$("input[name=departure_date"+i+"]").removeClass('valid').addClass('error');
					var arr_time_before=$("input[name=departure_time"+i+"]").removeClass('valid').addClass('error');
					$("input[name=departure_date"+i+"]").after('<label for="arrival_date'+i+'" generated="true" class="error_" style="width: 230px;">Date/Heure incohérente avec la précédente date d\'arrivée.</label>')

					verif=false
				}
				else{
					var arr_date_before=$("input[name=departure_date"+i+"]").removeClass('error').addClass('valid');
					var arr_time_before=$("input[name=departure_time"+i+"]").removeClass('error').addClass('valid');
				}
			}
		}
		return verif;
	}


	function update_drivers_cars(){
		var the_update_element = $('.update') ;
		var nb_ways=the_update_element.size()/4;

		var min_date='30/12/9999';
		var max_date='00/00/0000';
		var min_hour='23:59';
		var max_hour='00:00';


		var min_date=$("input[name=departure_date1]").val();
		var max_date=$("input[name=arrival_date"+nb_ways+"]").val();
		var min_hour=$("input[name=departure_time1]").val();
		var max_hour=$("input[name=arrival_time"+nb_ways+"]").val();


			$.ajax({
		  		type : 'GET',
				url : '/carl500/?page=run&action=ajax&type=display_driver&option=no_header_footer' ,
				data : 'min_date='+min_date+'&max_date='+max_date+'&min_hour='+min_hour+'&max_hour='+max_hour,
				beforeSend : function() {					
					$(".loader_drivers").remove();
					$(".valid_drivers").remove();
					$(".drivers").after('<img class="loader_drivers" src="/carl500/style/images/loading.gif" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');
				},
				success : function(data){ 
					$('.drivers').html(data);  
					$(".loader_drivers").remove();
					$(".drivers").after('<img class="valid_drivers" src="/carl500/style/images/validate.png" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');

				}
			});

			$.ajax({
		  		type : 'GET',
				url : '/carl500/?page=run&action=ajax&type=display_car&option=no_header_footer' ,
				data : 'min_date='+min_date+'&max_date='+max_date+'&min_hour='+min_hour+'&max_hour='+max_hour,
				beforeSend : function() {
					$(".loader_cars").remove();
					$(".valid_cars").remove();
					$(".cars").after('<img class="loader_cars" src="/carl500/style/images/loading.gif" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');				},
				success : function(data){ 
					$('.cars').html(data);
					$(".loader_cars").remove();
					$(".cars").after('<img class="valid_cars" src="/carl500/style/images/validate.png" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');
				}
			});
}

function update_drivers_ajax(id_dc){
		id_dc=id_dc-1;
		var the_update_element = $('.update') ;
		var nb_ways=the_update_element.size()/4;

		var min_date='30/12/9999';
		var max_date='00/00/0000';
		var min_hour='23:59';
		var max_hour='00:00';


		var min_date=$("input[name=departure_date1]").val();
		var max_date=$("input[name=arrival_date"+nb_ways+"]").val();
		var min_hour=$("input[name=departure_time1]").val();
		var max_hour=$("input[name=arrival_time"+nb_ways+"]").val();


			$.ajax({
		  		type : 'GET',
				url : '/carl500/?page=run&action=ajax&type=display_driver&option=no_header_footer' ,
				data : 'min_date='+min_date+'&max_date='+max_date+'&min_hour='+min_hour+'&max_hour='+max_hour,
				beforeSend : function() {					
					$(".loader_drivers").remove();
					$(".valid_drivers").remove();
					$("#driver"+id_dc).after('<img class="loader_drivers" src="/carl500/style/images/loading.gif" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');
				},
				success : function(data){
					$("#driver"+id_dc).html(data);  
					$(".loader_drivers").remove();
					$("#driver"+id_dc).after('<img class="valid_drivers" src="/carl500/style/images/validate.png" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');

				}
			});

			$.ajax({
		  		type : 'GET',
				url : '/carl500/?page=run&action=ajax&type=display_car&option=no_header_footer' ,
				data : 'min_date='+min_date+'&max_date='+max_date+'&min_hour='+min_hour+'&max_hour='+max_hour,
				beforeSend : function() {
					$(".loader_cars").remove();
					$(".valid_cars").remove();
					$("#car"+id_dc).after('<img class="loader_cars" src="/carl500/style/images/loading.gif" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');				},
				success : function(data){ 
					$("#car"+id_dc).html(data);
					$(".loader_cars").remove();
					$("#car"+id_dc).after('<img class="valid_cars" src="/carl500/style/images/validate.png" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');
				}
			});
}
</script>


<!-- A ETE AJOUTE -->
<?php
	$optionaddr = "";
	foreach ($locations as $loc) {
		$optionaddr .= '<option value="'.$loc['id'].'">'.$loc['name'].'</option>';
	} 

	$optiondriv = "";
	foreach ($drivers as $driver) {
		$optiondriv .= '<option value="'.$driver['id'].'">'.$driver['first_name'].' '.$driver['last_name'].'</option>';
	} 

	$optioncar = "";
	foreach ($cars as $car) {
		$optioncar .= '<option value="'.$car['id'].'">'.$car['model'].'</option>';
	} 
?>

<script type="text/javascript">
	$(document).ready( function() {
		var trajet = 3;
   		$('#addTraject').live("click",
    		function() {
id=trajet-1;

val_dep=$("input[name=arrival_location"+id+"]").val();
val_date=$("input[name=arrival_date"+id+"]").val();
if(val_date== undefined){
val_date=" ";
}

				$('#addTraject').before('<div class="trajet" ><h3 class="title_trajet"> Trajet '+trajet+'</h3><div class="depart"><p><label>Lieu de départ</label><input type="text" class="tags ajax_propos input-xlarge" name="departure_location'+trajet+'" value="'+val_dep+'"/></p><div style="float:left; style="margin-right: 20px;"><div><label>Date de départ</label></div><div><input type="text" class="beginpicker ajax_propos update" name="departure_date'+trajet+'" style="margin-right: 20px;" value="'+val_date+'"/></div></div><div style="float:left;"><div><label>Heure de départ</label></div><div><input type="text" class="begintime ajax_propos update" name="departure_time'+trajet+'" /></div></div></div><div class="arrivee"><p><label>Lieu d\'arrivée</label><input type="text" class="tags keyup_arrival ajax_propos input-xlarge" name="arrival_location' +trajet+'" /></p><div style="float:left; "><div><label>Date d\'arrivée</label></div><div><input type="text" class="beginpicker keyup_date_arrival update" name="arrival_date'+trajet+'" style="margin-right: 20px;"/></div></div><div style="float:left;"><div><label>Heure d\'arrivée</label></div><div><input type="text" class="begintime update" name="arrival_time'+trajet+'" /></div></div></div></div>');
				trajet ++;
      		}
    	);
	});

</script>


<!-- A ETE MODIFIE -->
<script type="text/javascript">
		$(document).ready( function() {
		var driver = 2;
		$('#addDriver').live("click",
    		function() {
    			$('#addDriver').before('<div class="trajet"><div class="chauffeur"><p><label>Chauffeur</label><select class="drivers" type="text"  id="driver'+driver+'" name="driver'+driver+'"><option value=""></option><?php echo $optiondriv; ?></select></p></div><div class="vehicule"><p><label>V&eacute;hicule</label><select class="cars" type="text" id="car'+driver+'" name="car'+driver+'"><option value=""></option><?php echo $optioncar; ?></select></p></div></div>');
				driver++;
				//update_drivers_ajax(driver);

				//alert(driver);		
			}
    	);
    });
 </script>


<style>
.error{border-color: red !important;}
.valid{border-color: green !important;}


</style>

<form method="post" class="cmxform" id="commentForm" action="/carl500/?page=check&action=modify&check=run" enctype="multipart/form-data">
	<div style="height:100px">
		<?php if(isset($_GET['error']) && $_GET['error']=='error'){
				echo '<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
			}
		 ?>
		<?php echo '<center><p style="color:blue;">Run n°'.$_GET['id'].'</p></center>'; ?>
		<input type="hidden" name="id_run" value=<?php echo $_GET['id']; ?>>
		<div class="groupe">
			<p>
				<div><label>Groupe</label></div>
				<input type="text" class="required tags_band" name="band" value="<?php run_band($_GET['id']); ?>" />
			</p>
		</div>

		<div class="compagnie">
			<p>
				<div><label>Compagnie</label></div> 
				<input type="text" class="required tags_compagny" name="company" value="<?php run_company($_GET['id']) ?>" />
			</p>
		</div>

		<div class="nb">
			<p>
				<div><label>Nombre de personnes</label></div>
				<input type="text" class="required" name="nb_people" value="<?php run_number_persons($_GET['id']) ?>"/>
			</p>
		</div>
	</div>

	<?php $count_traject=1; foreach(get_ways_by_id_run($_GET['id']) as $a_way) : ?>

	<div class="trajet">
		<h3 class="title_trajet"> Trajet <?php echo $count_traject; ?> </h3>
		<div class="depart">
			<div>
				<div><label>Lieu de départ</label></div>
				<div><input type="text" class="tags ajax_propos input-xlarge" name="departure_location<?php echo $count_traject; ?>" value="<?php way_location_dep_by_id_run($a_way['id']) ?> "/></div>
			</div>

			<div style="float:left;">
				<div><label>Date de départ</label></div> 
				<div><input type="text" class="beginpicker ajax_propos update" name=<?php echo "departure_date".$count_traject ?> value="<?php way_date_dep_by_id_run($a_way['id']); ?>" style="margin-right: 20px;"/></div>
			</div>

			<div style="float:left;">
				<div><label>Heure de départ</label></div> <div><input type="text" class="begintime ajax_propos update" value="<?php way_hour_dep_by_id_run($a_way['id']); ?>" name=<?php echo "departure_time".$count_traject ?> /></div>
			</div>
		</div>


		<div class="arrivee">
			<div>
				<div><label>Lieu d'arrivée</label></div>
				<div><input type="text" class="tags keyup_arrival ajax_propos input-xlarge" name="arrival_location<?php echo $count_traject ?>" value="<?php way_location_arr_by_id_run($a_way['id']) ?> "/></div>
			</div>
			
		
			<div style="float:left;">
				<div><label>Date d'arrivée</label></div> 
				<div><input type="text" class="beginpicker  keyup_date_arrival update" name=<?php echo "arrival_date".$count_traject ?> value="<?php way_date_arr_by_id_run($a_way['id']); ?>" style="margin-right: 20px;"/></div>
			</div>
			
			<div style="float:left;">
				<div><label>Heure d'arrivée</label></div> 
				<div><input type="text" class="begintime update" name=<?php echo "arrival_time".$count_traject ?> value="<?php way_hour_arr_by_id_run($a_way['id']); ?>"/></div>
			</div>
			
		</div>

	</div>	

	<?php $count_traject++; endforeach; ?>
	
	<div style="margin-right: 50px;margin-left: 50px;height:30; width:90%;clear:both;text-align:center" id="addTraject" class= "btn"> Ajouter un Trajet </div>

	<div class= "separation" style="width: 98%;" ></div>
	
 	<?php 	$count_drive=1; 
			$drives = get_drives_by_id_run($_GET['id']);
			if ($drives!=null) {
			foreach($drives as $a_drive) : ?>


	<div  class="trajet">
			<div class= "chauffeur">
				<p><label>Chauffeur</label><select class="drivers drives" type="text" name=<?php echo "driver".$count_drive; ?> />
				<option value=""></option>
				<?php
					foreach ($drivers as $row) {
						if(get_run_driver_by_id($a_drive)==$row['first_name'].' '.$row['last_name']){
							echo '<option value="'.$row['id'].'" selected>'.$row['first_name'].' '.$row['last_name'].'</option>';
						}
						else{
							echo'<option value="'.$row['id'].'">'.$row['first_name'].' '.$row['last_name'].'</option>';
						}
					} 
				?>
			</select></p>
			</div>

			<div class= "vehicule">
				<p><label>V&eacute;hicule</label><select class="cars drives" type="text" name=<?php echo "car".$count_drive; ?> />
				<option value=""></option>
				<?php
					foreach ($cars as $row) {
						if(get_run_car_by_id($a_drive)==$row['manufacturer'].' '.$row['model']){
							echo'<option value="'.$row['id'].'" selected>'.$row['model'].'</option>';
						}
						else{
							echo'<option value="'.$row['id'].'">'.$row['model'].'</option>';
						}
					} 
				?>
			</select></p>
			</div>
			
	</div>

	<?php $count_drive++; endforeach; }
		else {?>
	<div class="trajet">
			<div class= "chauffeur">
				<p><label>Chauffeur</label><select class="drivers" type="text" name=<?php echo "driver".$count_drive; ?> />
				<option value=""></option>
				<?php
					foreach ($drivers as $row) {
							echo'<option value="'.$row['id'].'">'.$row['first_name'].' '.$row['last_name'].'</option>';
					} 
				?>
			</select></p>
			</div>

			<div class= "vehicule">
				<p><label>V&eacute;hicule</label><select class="cars" type="text" name=<?php echo "car".$count_drive; ?> />
				<option value=""></option>
				<?php
					foreach ($cars as $row) {

							echo'<option value="'.$row['id'].'">'.$row['manufacturer'].' '.$row['model'].'</option>';
					} 
				?>
			</select></p>
			</div>
			
	</div>
	<?php } ?>
	
	<div style="margin-right: 50px;margin-left: 50px;height:30; width:90%;clear:both;text-align:center" id="addDriver" class ="btn"> Ajouter un Chauffeur / Véhicule </div>
	
	<div class= "separation" style="width: 98%;" ></div>

	<div class="trajet">

	  	<label>Commentaires</label>

		<center><?php run_comments_modify($_GET['id']); ?></center>
	  		
	</div>

	<div class= "separation" style="width: 98%;" ></div>

<?php get_checked_run_calle($_GET['id']); ?>

	<div class="trajet" style="display:inline-block">
		<label class="checkbox">
		  <input type="checkbox" name="calle" value="1" <?php checked_run_calle($_GET['id']); ?>>
		  Calé
		</label>

		<label class="checkbox">
	 		 <input type="checkbox" name="finished" value="1" <?php run_checked_status($_GET['id']); ?>>
	  			Terminé
		</label>
	</div>

	<div style= "margin-top: 10px;">
	
		<input style="margin-right: 50px;margin-left: 50px;height:30; width:40%;text-align:center" type="submit" value="Valider" class ="btn"/>

		<div style="margin-right: 50px;margin-left: 50px;height:30; width:40%;text-align:center" class ="btn">
			<a href="/carl500/?page=run">Annuler</a>
		</div>
	</div>

</form>



<script>




$(function(){
	$('input.keyup_date_arrival').live('click', function() {
		$(this).datepicker({
			dateFormat: 'dd/mm/yy',
			showOn:'focus',
			onSelect: function(value, date) {  update_drivers_cars(); var id=$(this).attr('name').replace('arrival_date','');id++;$("input[name=departure_date"+id+"]").val(value);}
		}).focus();
	});
});


$(function(){
	$('input.beginpicker').live('click', function() {
		$(this).datepicker({
			dateFormat: 'dd/mm/yy', showOn:'focus',
			onSelect: function(value, date) { update_drivers_cars(); date_propos(this);}
		}).focus();
	});
});


$(function(){
	$('input.begintime').live('click', function() {
		$( this).timepicker({showOn:'focus',
			onSelect: function(value, date) {  update_drivers_cars(); date_propos(this);}
		}).focus();
	});
});

$(function() {
	$(".keyup_date_arrival").datepicker({ 
		dateFormat: 'dd/mm/yy', 
		onSelect: function(value, date) { 
			update_drivers_cars(); 
			var id=$(this).attr('name').replace('arrival_date','');
			id++;
			$("input[name=departure_date"+id+"]").val(value);
		} 
	});
});


 </script>

</form>

  <script type="text/javascript" src="/carl500/style/js/jquery.validate.js"></script>
<style type="text/css">
//* { font-family: Verdana; font-size: 96%; }
//label { width: 10em; float: left; }
//label.error { float: none; color: red; padding-left: .5em; vertical-align: top; }
//p { clear: both; }
//.submit { margin-left: 12em; }
em { font-weight: bold; padding-right: 1em; vertical-align: top; }
</style>

<script>
$(document).ready(function(){
	$("#commentForm").validate({ 
		errorClass: "error",
  		validClass: "valid",
  		highlight: function( element, errorClass, validClass ) {
    		$(element).addClass(errorClass).removeClass(validClass);
  		},
  		unhighlight: function( element, errorClass, validClass ) {
    		$(element).removeClass(errorClass).addClass(validClass);
  		}
	});
});
</script>
<script>
function get_time_date(date,hour){
	var dd_min = date.substring(0,2); 
	var mm_min = date.substring(3,5); 
	var yy_min = date.substring(6,10); 
	var hh_min = hour.substring(0,2); 
	var mn_min = hour.substring(3,5); 
	var min_date_save = new Date(yy_min, mm_min, dd_min, hh_min, mn_min);
	var d1=min_date_save.getTime();

	return d1;
}

	function verif_date(){
		$('.error_').remove();
		var verif=true;
		var the_update_element = $('.update') ;
		var nb_ways=the_update_element.size()/4;

		for(i=1; i<nb_ways+1; i++){
			var dep_date=$("input[name=departure_date"+i+"]").val();
			var dep_time=$("input[name=departure_time"+i+"]").val();

			var arr_date=$("input[name=arrival_date"+i+"]").val();
			var arr_time=$("input[name=arrival_time"+i+"]").val();

			dep=get_time_date(dep_date,dep_time);
			arr=get_time_date(arr_date,arr_time);
		

			$("input[name=departure_date"+i+"]").removeClass('error').addClass('valid');
			$("input[name=departure_time"+i+"]").removeClass('error').addClass('valid');

			if(dep>arr){
				$("input[name=arrival_date"+i+"]").removeClass('valid').addClass('error');
				$("input[name=arrival_time"+i+"]").removeClass('valid').addClass('error');
				$("input[name=arrival_date"+i+"]").after('<label for="arrival_date'+i+'" generated="true" class="error_" style="">Date/Heure incohérente.</label>')

				verif=false
			}
			else{
				$("input[name=arrival_date"+i+"]").removeClass('error').addClass('valid');
				$("input[name=arrival_time"+i+"]").removeClass('error').addClass('valid');
			}

			if(i>1){
				i_=i-1;
				var arr_date_before=$("input[name=arrival_date"+i_+"]").val();
				var arr_time_before=$("input[name=arrival_time"+i_+"]").val();

				arr_before=get_time_date(arr_date_before,arr_time_before);

				if(arr_before>dep){
					var arr_date_before=$("input[name=departure_date"+i+"]").removeClass('valid').addClass('error');
					var arr_time_before=$("input[name=departure_time"+i+"]").removeClass('valid').addClass('error');
					$("input[name=departure_date"+i+"]").after('<label for="arrival_date'+i+'" generated="true" class="error_" style="width: 230px;">Date/Heure incohérente avec la précédente date d\'arrivée.</label>')

					verif=false
				}
				else{
					var arr_date_before=$("input[name=departure_date"+i+"]").removeClass('error').addClass('valid');
					var arr_time_before=$("input[name=departure_time"+i+"]").removeClass('error').addClass('valid');
				}
			}
		}

		return verif;
	}
</script>


<script>
$("#commentForm").submit(function() {
	if(!verif_date()){ 
			$('body,html').animate({
				scrollTop: 0
			}, 800);
	}
	if(!verif_date()){ 
		return false; 
	}
});
</script>
