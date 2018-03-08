<?php
/**
 * Feature name:  CARL 500 car-template
 * Description:   Page de liste des véhicules
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>
<?php
    if(isset($_GET['action']) && $_GET['action']=='delete'){
      echo '<center><p style="color:green;">Le véhicule a été supprimé</p></center>';
            delete_car_by_id($_GET['id']);
          }
    ?>

<script>
$(document).ready(function(){
	$('#search_car').bind('keyup', function(){
   		if( $(this).val().length > 1 ){
			$.ajax({
			  	type : 'GET',
				url : '/carl500/?page=car&action=search&option=no_header_footer' ,
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
          <input type="text" id="search_car" class="input-medium search-query non-printable" style="margin-left: 655px; float: left;">
          
        </div>

        <a href="/carl500/?page=car&action=import"><div class="btn non-printable" style="float: left; margin-left: 20px; margin-bottom: 20px; margin-right: 20px;">Importer un fichier .csv</div></a>
          

        <div  id="addDriver" class ="btn non-printable"><a href="/carl500/?page=car&action=add"> Ajouter un Véhicule </a></div>
    
</div>





<div align="center" style="text-align:center;" > 
    <table id="tableau" border="1" width=100%>

   
        <thead>
            <tr>
                <th>Actions</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Couleur</th>
                <th>Immatriculation</th>
                <th>Nombre de places</th>
              
            </tr>
        </thead>
      
            <tbody>

				<?php foreach(get_cars() as $a_car): ?>

                <tr>
                    <td class="action child">
						<div  class ="btn child non-printable" style ="float:none; margin-top: 5px; margin-bottom: 5px;"> <a  class="child" href="/carl500/?page=car&action=display&id=<?php echo $a_car['id']; ?>"><img width="20px" src="/carl500/style/images/voir.png"/> </a> </div> 
						<div  class ="btn child non-printable" style ="float:none;"> <a class="child" href="/carl500/?page=car&action=modify&id=<?php echo $a_car['id']; ?>"><img width="20px" src="/carl500/style/images/modifier.png"/>  </a></div> 
						<div  class ="btn child non-printable" style ="float:none;"> <a class="child" href="/carl500/?page=car&action=delete&id=<?php echo $a_car['id']; ?>"><img width="20px" src="/carl500/style/images/supprimer.png"/>  </a> </div>
					</td>
                    <td><?php echo $a_car['manufacturer']; ?></td>
                    <td><?php echo $a_car['model']; ?></td>
                    <td><?php echo $a_car['color']; ?></td>
                    <td><?php echo $a_car['immat']; ?></td>
                    <td><?php echo $a_car['capacity']; ?></td>
                </tr>    

			<?php endforeach; ?>            
                
            </tbody>
        
    </table>
</div>


<div align="center" style="text-align:center;" > 
    <table id="tableau_" border="1" width=100%>        
    </table>
</div>