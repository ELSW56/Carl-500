<?php
/**
 * Feature name:  CARL 500 distance-template
 * Description:   Page de liste des distances
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>
   <?php if(isset($_GET['action']) && $_GET['action']=='delete'){
      echo '<center><p style="color:green;">La distance a été supprimée</p></center>';
            delete_distance_by_id($_GET['id']);
          }
    ?>

    <script>
$(document).ready(function(){
    $('#search_distance').bind('keyup', function(){
        if( $(this).val().length > 1 ){
            $.ajax({
                type : 'GET',
                url : '/carl500/?page=distance&action=search&option=no_header_footer' ,
                data : 'q='+$(this).val(),
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

 <div>   

        <div class="form-search">
          <input type="text" id="search_distance" class="input-medium search-query" style="margin-left: 600px; float: left;">
          
        </div>

        <div class="btn" style="float: left; margin-left: 20px; margin-bottom: 20px; margin-right: 20px;"><a href="/carl500/?page=distance&action=import">Importer un fichier .csv</a></div>
          

        <div  id="addDistance" class ="btn"><a href="/carl500/?page=distance&action=add"> Ajouter une Distance </a></div>
    
</div>

<br>


<div align="left" style="text-align:center;" > 
    <table id="tableau" border="1" width=100%>

        
        <thead>
            <tr>
                <th>Action</th>
                <th>Départ</th>
                <th>Arrivée</th>
                <th>Nombre de Kms</th>
                <th>Temps</th>
            </tr>
        </thead>
      
            <tbody>

				<?php if (isset($_GET['q'])) {
							$query = $_GET['q'];
							} else {
							$query = '';}
						foreach(get_distances($query) as $a_distance): ?>
	                <tr>
	                    <td class="action child">
							<div  class ="btn child" style ="float:none; margin-top: 5px; margin-bottom: 5px;"><a class="child" href="/carl500/?page=distance&action=display&id=<?php echo $a_distance['id']; ?>"> <img width="20px" src="/carl500/style/images/voir.png"/>  </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=distance&action=modify&id=<?php echo $a_distance['id']; ?>"><img width="20px" src="/carl500/style/images/modifier.png"/>  </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=distance&action=delete&id=<?php echo $a_distance['id']; ?>"><img width="20px" src="/carl500/style/images/supprimer.png"/>  </a></div>
						</td>
	                    <td><?php location_name_by_id($a_distance['location1']); ?></td>
	                    <td><?php location_name_by_id($a_distance['location2']); ?></td>
	                    <td><?php echo $a_distance['distance']; ?></td>
	                    <td><?php echo substr($a_distance['time'],0,5); ?></td>
	                    
	                </tr>

				<?php endforeach; ?>
                
            </tbody>
        
    </table>
</div>

