<?php
/**
 * Feature name:  CARL 500 run-template
 * Description:   Page de liste des runs
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>
  <?php
    if(isset($_GET['action']) && $_GET['action']=='delete'){
      echo '<center><p style="color:green;">Le run a été supprimé</p></center>';
            delete_run_by_id($_GET['id']);
          }
    ?>

<script>
$(document).ready(function(){
	$('#search_run').bind('keyup', function(){
   		if( $(this).val().length > 1 ){
			$.ajax({
			  	type : 'GET',
				url : '/carl500/?page=run&action=search&option=no_header_footer' ,
				data : 'q='+$(this).val() ,
				beforeSend : function() {
					$("#tableau__").hide();
					$("#tableau_").show();
					$("#tableau_").html('<img class="loader_time" src="/carl500/style/images/loading.gif" style="margin-top: 5px;position: absolute;width: 21px;margin-left: 4px;"/>');
				},
				success : function(data){ 
					$(".loader_time").remove();
					$("#tableau_").html(data);
				}
			});
		}
		else{
			$("#tableau__").show();
			$("#tableau_").hide();
		}
	});
});	
</script>


<script>
$(document).ready(function(){
	$('.check_calle').live('click', function(){
	id=$(this).attr('id').replace('check_calle_','');
	calle=$(this).attr('checked');

	if(calle=='checked'){val_calle=1;}else{val_calle=0;}
	
	color_class=$('#container_run_'+id).attr('class');

		$.ajax({
			type : 'GET',
			url : '/carl500/?page=run&action=ajax&&type=calle&option=no_header_footer' ,
			data : 'id='+id+'&&calle='+val_calle ,
			beforeSend : function() {
			},
			success : function(data){ 
				if(color_class!='termine'){
					if(val_calle==1){
						$('#container_run_'+id).removeClass('non_calles').addClass('calles');
					}
					if(val_calle==0){
						$('#container_run_'+id).removeClass('calles').addClass('non_calles');
					}
				}
			}
		});
	});
});	
</script>

    <?php 
      $status=0;
      $calles=0;
	  $selected_termine= "";
	  $selected_tous= "";
	  $selected_cale = "";
	  $selected_non_cale = "";	  
	  if (isset($_GET['filter'])) {
		  if($_GET['filter']=='termine'){
			$status=1;
			$selected_termine='selected="selected"';
		  }
		  if($_GET['filter']=='tous'){
			$selected_tous='selected="selected"';
			$status=2;

		  }
		  if($_GET['filter']=='cales'){
			// on ne garde alors que les non terminés
			$calles='oui';
			$status=0;
			$selected_cale='selected="selected"';
		  }
		  if($_GET['filter']=='non_cales'){
			$calles='non';
			$selected_non_cale='selected="selected"';

		  }
	  }
   ?>

        <div style="float:right; margin-left: 20px;">

          <!-- input type="text" id="search_run" class="input-medium search-query" style="margin-right: 5px;" -->

          <select name="Lien" size="1" onchange="window.location.href=this.value" style="margin-top: 10px; margin-right: 5px;">
            <!-- dropdown menu links -->

            <option value="/carl500/?page=run">Tous les jours</a></option>

            	<?php foreach(get_days() as $a_day) : ?>

            		<option value="/carl500/?page=run&date=<?php echo $a_day; if(isset($_GET['filter'])){ echo '&filter='.$_GET['filter']; } ?>" <?php if(isset($_GET['date']) && $a_day==$_GET['date']){ echo 'selected="selected"'; } ?> ><?php echo $a_day; ?></a></option>

				<?php endforeach; ?>
          </select>
		  
          <select name="Lien" size="1" onchange="window.location.href=this.value" style="margin-top: 10px; margin-right: 5px;">
            <!-- dropdown menu links -->
            
            <option value="/carl500/?page=run<?php if(isset($_GET['date'])){ echo '&date='.$_GET['date']; } ?>" >Runs non terminés</a></option>
            <option value="/carl500/?page=run&filter=non_cales<?php if(isset($_GET['date'])){ echo '&date='.$_GET['date']; } ?>" <?php echo $selected_non_cale; ?> >Runs non calés</a></option>
            <option value="/carl500/?page=run&filter=cales<?php if(isset($_GET['date'])){ echo '&date='.$_GET['date']; } ?>" <?php echo $selected_cale; ?> >Runs calés</a></option>
            <option value="/carl500/?page=run&filter=termine<?php if(isset($_GET['date'])){ echo '&date='.$_GET['date']; } ?>" <?php echo $selected_termine; ?> >Runs terminés</a></option>
            <option value="/carl500/?page=run&filter=tous"<?php if(isset($_GET['date'])){ echo '&date='.$_GET['date']; } ?>" <?php echo $selected_tous; ?> >Tous les Runs</a></option>
          </select>

        </div>

          <div  id="addRun" class ="btn" style= "margin-left: 10px; margin-bottom: 10px; margin-top: 8px;" > <a href="/carl500/?page=run&action=add">Ajouter un RUN</a> </div>



<div id="tableau__" align="center" style="text-align:center;" > 


    <table id="tableau" border="1" width=100%>



        <thead>
            <tr>
                <th>N°</th>
				<th>Action</th>
                <th>Groupe</th>
                <th>Date de départ</th>
                <th colspan=3>Trajet</th>
                <th>Nombre de personnes</th>
                <th>Calé</th>
            </tr>
        </thead>
      
            <tbody>
	<?php 
		if(isset($_GET['date'])){
			$a_day=$_GET['date']; } 
		else {
			$a_day=0;
		} 
	?>

			<?php 
			foreach(get_runs($a_day,$status,(string)$calles, 0) as $a_run) : ?>
								
                <tr id="container_run_<?php echo $a_run[0]; ?>" class="<?php run_class_css($a_run); ?>">
                    <td><?php echo $a_run[0]; ?></td>
					<td class="action child">
						<div  class ="btn child" style ="opacity:0.3; float:none; margin-top: 5px; margin-bottom: 5px;"> <a class="child" href="/carl500/?page=run&action=display&id=<?php echo $a_run['id']; ?>"><img width="20px" src="/carl500/style/images/voir.png"/> </a></div> 
						<div  class ="btn child" style =" opacity:0.3; float:none;"><a class="child" href="/carl500/?page=run&action=modify&id=<?php echo $a_run['id']; ?>"> <img width="20px" src="/carl500/style/images/modifier.png"/> </a></div> 
						<div  class ="btn child" style =" opacity:0.3; float:none;"> <a class="child" href="/carl500/?page=run&action=delete&id=<?php echo $a_run['id']; ?>"><img width="20px" src="/carl500/style/images/supprimer.png"/> </a></div></td>
                    <td><?php echo $a_run['name']; ?></td>
                    <td><?php echo $a_run['jdep']; ?></td>
                    <td><?php echo $a_run['hdep']; ?></td>
                    <td><?php echo $a_run['harr']; ?></td>
                    <td><?php run_destination_timeline($a_run[0]); ?></td>
                    <td><?php echo $a_run['nb']; ?></td>
                    <td><label class="checkbox">
                      <input class="check_calle" id="check_calle_<?php echo $a_run['id']; ?>" type="checkbox" name="finished" <?php if($a_run['calle']){echo 'checked="checked"';} ?> value="1" style="margin-left:auto; margin-right:auto;">
          
                        </label>
                    </td>
                </tr>

			<?php endforeach; ?>

             </tbody>
        
    </table>

</div>


<div id="tableau_" align="center" style="text-align:center;" > 


</div>