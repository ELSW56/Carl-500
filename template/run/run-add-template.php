<?php
/**
 * Feature name:  CARL 500 run-add-template
 * Description:   Page de création d'un run
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>

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
		date_propos(this);
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
					date_propos(this,ui.item.value);

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
</script>


<?php
	$optionaddr = "";
	foreach ($locations as $row) {
		$optionaddr .= '<option value="'.$row['id'].'">'.$row['name'].'</option>';
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

				$('#addTraject').before('<div class="trajet"><h3 class="title_trajet"> Trajet '+trajet+'</h3><div class="depart"><div><div><label>Lieu de départ</label></div><div><input type="text" class="tags ajax_propos input-xlarge" name="departure_location'+trajet+'" value="'+val_dep+'"/></div></div><div style="float:left; style="margin-right: 20px;"><div><label>Date de départ</label></div><div><input type="text" class="beginpicker ajax_propos update" name="departure_date'+trajet+'" style="margin-right: 20px;" value="'+val_date+'"/></div></div><div style="float:left;"><div><label>Heure de départ</label></div><div><input type="text" class="begintime ajax_propos update" name="departure_time'+trajet+'" /></div></div></div><div class="arrivee"><div><div><label>Lieu d\'arrivée</label></div><div><input type="text" class="tags keyup_arrival ajax_propos input-xlarge" name="arrival_location' +trajet+'" /></div></div><div style="float:left; "><div><label>Date d\'arrivée</label></div><div><input type="text" class="beginpicker keyup_date_arrival update" name="arrival_date'+trajet+'" style="margin-right: 20px;"/></div></div><div style="float:left;"><div><label>Heure d\'arrivée</label></div><div><input type="text" class="begintime update" name="arrival_time'+trajet+'" /></div></div></div></div>');
				trajet ++;
      		}
    	);
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
</script>


<!-- A ETE MODIFIE -->
<script type="text/javascript">
		$(document).ready( function() {
		var driver = 2;
		$('#addDriver').live("click",
    		function() {
    			$('#addDriver').before('<div class="trajet"><div class="chauffeur"><p><label>Chauffeur</label><select class="drivers" type="text" name="driver'+driver+'"><option value=""></option><?php echo $optiondriv; ?></select></p></div><div class="vehicule"><p><label>Véhicule</label><select class="cars" type="text" name="car'+driver+'"><option value=""></option><?php echo $optioncar; ?></select></p></div></div>');
				driver++;
				//update_drivers_cars();
      		}
    	);
    });

 </script>
<style>
.error{border-color: red !important;}
.valid{border-color: green !important;}


</style>

<form method="post" class="cmxform" id="commentForm" action="/carl500/?page=check&action=add&check=run" enctype="multipart/form-data">
	<div style="height:60px;">
		<?php if(isset($_GET['error']) && $_GET['error']=='error'){
				echo'<div><center><p style="color:red;">Le formulaire n\'a pas été rempli correctement.</p></center></div>';
			}
		 ?>
		<div class="groupe">
			<label>Groupe</label>
			<input type="text" class="required tags_band" name="band" />
		</div>

		<div class="compagnie">
				<label>Compagnie</label>
				<input type="text" class="required tags_compagny" name="company" />
		</div>

		<div class="nb">
			<label>Nombre de personnes</label>
			<input type="text" class="required number" name="nb_people" />
		</div>
	</div>

	<div class="trajet">
		<h3 class="title_trajet"> Trajet 1 </h3>
		<div class="depart">
			<div>
				<div><label>Lieu de départ</label></div>
				<div><input type="text" class="tags ajax_propos input-xlarge" name="departure_location1" /></div>
			</div>

			<div style="float:left;">
				<div><label>Date de départ</label></div> 
				<div><input type="text" class="beginpicker ajax_propos update" name="departure_date1" style="margin-right: 20px;"/></div>
			</div>

			<div style="float:left;">
				<div><label>Heure de départ</label>
				</div> <div><input type="text" class="begintime ajax_propos update" name="departure_time1" /></div>
			</div>
		</div>


		<div class="arrivee">
			<div>
				<div><label>Lieu d'arrivée</label></div>
				<div><input type="text" class="tags keyup_arrival ajax_propos input-xlarge" name="arrival_location1" /></div>
			</div>
			
		
			<div style="float:left;">
				<div><label>Date d'arrivée</label></div> 
				<div><input type="text" class="beginpicker keyup_date_arrival update" name="arrival_date1" style="margin-right: 20px;"/></div>
			</div>
			
			<div style="float:left;">
				<div><label>Heure d'arrivée</label></div> 
				<div><input type="text" class="begintime update" name="arrival_time1" /></div>
			</div>
			
		</div>

	</div>	

	<div class="trajet">
		<h3 class= "title_trajet"> Trajet 2 </h2>
		<div class="depart">
			<div>
				<div><label>Lieu de départ</label></div>
				<div><input type="text" class="tags ajax_propos input-xlarge" name="departure_location2" /></div>
			</div>

			<div style="float:left;">
				<div><label>Date de départ</label></div> 
				<div><input type="text" class="beginpicker ajax_propos update" name="departure_date2" style="margin-right: 20px;"/></div>
			</div>

			<div style="float:left;">
				<div><label>Heure de départ</label>
				</div> <div><input type="text" class="begintime ajax_propos update" name="departure_time2" /></div>
			</div>
		</div>


		<div class="arrivee">
			<div>
				<div><label>Lieu d'arrivée</label></div>
				<div><input type="text" class="tags keyup_arrival ajax_propos input-xlarge" name="arrival_location2" /></div>
			</div>
			
		
			<div style="float:left;">
				<div><label>Date d'arrivée</label></div> 
				<div><input type="text" class="beginpicker keyup_date_arrival update" name="arrival_date2" style="margin-right: 20px;"/></div>
			</div>
			
			<div style="float:left;">
				<div><label>Heure d'arrivée</label></div> 
				<div><input type="text" class="begintime update" name="arrival_time2" /></div>
			</div>
			
		</div>

	</div>	

	<div style="margin-right: 50px;margin-left: 50px;height:30; width:90%;clear:both;text-align:center" id="addTraject" class= "btn"> Ajouter un Trajet </div>
	
	<div class= "separation" style="width: 98%;" ></div>

	<div class="trajet">
			<div class= "chauffeur">
				<p><label>Chauffeur</label><select class="drivers drives" type="text" name="driver1" />
				<option value=""></option>
				<?php
					foreach ($drivers as $row) {
						echo'<option value="'.$row['id'].'">'.$row['first_name'].' '.$row['last_name'].'</option>';
					} 
				?>
			</select></p>
			</div>

			<div class= "vehicule">
				<p><label>Véhicule</label><select class="cars drives" type="text" name="car1" />
				<option value=""></option>
				<?php
					foreach ($cars as $row) {
						echo'<option value="'.$row['id'].'">'.$row['model'].'</option>';
					} 
				?>
			</select></p>
			</div>
			
	</div>

	
	<div style="margin-right: 50px;margin-left: 50px;height:30; width:90%;clear:both;text-align:center" id="addDriver" class ="btn"> Ajouter un Chauffeur / Véhicule </div>
	
	<div class= "separation" style="width: 98%;" ></div>

	<div class="trajet">

	  	<label>Commentaires</label>

		<center><textarea name="comments" style="width: 98%; margin-top: 5px; max-width: 1175px;"></textarea></center>
	  		
	</div>

	<div class= "separation" style="width: 98%;" ></div>

	<div class="trajet" style="display:inline-block">
		<label class="checkbox">
			<input type="checkbox" name="calle" value="1">
			Calé
		</label>

		
		<label class="checkbox">
	 		 <input type="checkbox" name="finished" value="1">
	  		Terminé
		</label>
	</div>
	

	<div class="trajet"style= "margin-top: 10px;">
		
		<input style="margin-right: 50px;margin-left: 50px;height:30; width:40%;text-align:center" type="submit" value="Valider" class="submit btn"/>

		<div style="margin-right: 50px;margin-left: 50px;height:30; width:40%;text-align:center" class ="btn">
			<a href="/carl500/?page=run">Annuler</a>
		</div>
	</div>

<script>
		var myDate = new Date(); 
		var year=myDate.getFullYear();


$(function(){
	$('input.keyup_date_arrival').live('click', function() {
		$(this).datepicker({
			minDate: new Date(year, 06, 1),
			dateFormat: 'dd/mm/yy',
			showOn:'focus',
			onSelect: function(value, date) {  update_drivers_cars(); var id=$(this).attr('name').replace('arrival_date','');id++;$("input[name=departure_date"+id+"]").val(value);}
		}).focus();
	});
});

$(function(){
	$('input.beginpicker').live('click', function() {
		$(this).datepicker({
			minDate: new Date(year, 06, 1),
			dateFormat: 'dd/mm/yy', showOn:'focus',
			onSelect: function(value, date) {  update_drivers_cars(); date_propos(this);}
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
		minDate: new Date(year, 06, 1),
		dateFormat: 'dd/mm/yy', 
		onSelect: function(value, date) { 
			update_drivers_cars(); 
			var id=$(this).attr('name').replace('arrival_date','');
			id++;
			$("input[name=departure_date"+id+"]").val(value);} 
	});
});


 </script>

</form>

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