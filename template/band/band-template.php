<?php
/**
 * Feature name:  CARL 500 band-template
 * Description:   Page de liste des groupes
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>
<?php
    if(isset($_GET['action']) && $_GET['action']=='delete'){
      echo '<center><p style="color:green;">Le groupe a été supprimé</p></center>';
            delete_band_by_id($_GET['id']);
          }
    ?>
<script>
$(document).ready(function(){
	$('#search_band').bind('keyup', function(){
   		if( $(this).val().length > 1 ){
			$.ajax({
			  	type : 'GET',
				url : '/carl500/?page=band&action=search&option=no_header_footer' ,
				data : 'q='+$(this).val() ,
				beforeSend : function() {
					$("#tableau").hide();
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
			$("#tableau").show();
			$("#tableau_").hide();
		}
	});
});	
</script>

 <div style="margin-bottom: 20px;">   

        <div class="form-search">
          <input type="text" id="search_band" class="input-medium search-query" style="margin-left: 660px; float: left;">
        </div>

        <a href="/carl500/?page=band&action=import"><div class="btn" style="float: left; margin-left: 20px; margin-bottom: 20px; margin-right: 20px;">Importer un fichier .csv</div></a>
          

        <div  id="addBand" class ="btn"><a href="/carl500/?page=band&action=add"> Ajouter un Groupe </a></div>
    
</div>


<div align="center" style="text-align:center;" > 
    <table id="tableau" border="1" width=100%>


        
        <thead>
            <tr>
                <th>Action</th>
                <th>Nom</th>
                <th>Nombre de personnes</th>
                <th>Jour de passage</th>
                <th>Heure de passage</th>
                <th>Rappel</th>
                <th>Scénarios validés</th>
              
            </tr>
        </thead>
      
            <tbody>

				<?php foreach(get_bands() as $a_band): ?>

	                <tr>
	                    <td class="action child">
							<div  class ="btn child" style ="float:none; margin-top: 5px; margin-bottom: 5px;"> <a class="child" href="/carl500/?page=band&action=display&id=<?php echo $a_band['id']; ?>"><img width="20px" src="/carl500/style/images/voir.png"/>  </a></div>
			 				<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=band&action=modify&id=<?php echo $a_band['id']; ?>"><img width="20px" src="/carl500/style/images/modifier.png"/>  </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=band&action=delete&id=<?php echo $a_band['id']; ?>"> <img width="20px" src="/carl500/style/images/supprimer.png"/>  </a></div>
						</td>
	                    <td><?php echo $a_band['name']; ?></td>
	                    <td><?php echo $a_band['nb_people']; ?></td>
	                    <td><?php band_day_pass($a_band['jour_passage']); ?></td>
	                    <td><?php band_hour_pass($a_band['jour_passage']); ?></td>
	                    <td><?php if($a_band['rappel']==1){echo'<img src="/carl500/style/images/phone.png"/>';} ?></td>
	                    <td><?php if($a_band['validation']==1){echo'<img src="/carl500/style/images/validate.png"/>';}else{echo'<img src="/carl500/style/images/wrong.png"/>';}?></td>
	                </tr>

				<?php endforeach; ?>
                <tr>

            </tbody>
        
    </table>
</div>

<div align="center" style="text-align:center;" > 
    <table id="tableau_" border="1" width=100%>
        
    </table>
</div>