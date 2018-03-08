<?php
/**
 * Feature name:  CARL 500 location-template
 * Description:   Page de liste des lieux
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>
<?php
    if(isset($_GET['action']) && $_GET['action']=='delete'){
      echo '<center><p style="color:green;">Le lieu a été supprimé</p></center>';
            delete_location_by_id($_GET['id']);
          }
    ?>
<script>
$(document).ready(function(){
	$('#search_location').bind('keyup', function(){
   		if( $(this).val().length > 1 ){
			$.ajax({
			  	type : 'GET',
				url : '/carl500/?page=location&action=search&option=no_header_footer' ,
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

        <div class="form-search non-printable">
          <input type="text" id="search_location" class="input-medium search-query" style="margin-right: 5px; margin-left: 675px; float: left;">
          
        </div>

        <a href="/carl500/?page=location&action=import"><div class="btn non-printable" style="float: left; margin-left: 20px; margin-bottom: 20px; margin-right: 20px;">Importer un fichier .csv</div></a>
          

        <div  id="addDriver" class ="btn non-printable"><a href="/carl500/?page=location&action=add"> Ajouter un Lieu </a></div>
    
</div>




<div align="center" style="text-align:center;" > 
    <table id="tableau" border="1" width=100%>

        
        <thead>
            <tr>
                <th class ="non-printable">Action</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Tél</th>
                <th>Fax</th>
            </tr>
        </thead>
      
            <tbody>

				<?php foreach(get_locations() as $a_location): ?>

	                <tr>
	                    <td class="action child non-printable">
							<div  class ="btn child" style ="float:none; margin-top: 5px; margin-bottom: 5px;"><a class="child" href="/carl500/?page=location&action=display&id=<?php echo $a_location['id']; ?>"> <img width="20px" src="/carl500/style/images/voir.png"/>  </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=location&action=modify&id=<?php echo $a_location['id']; ?>"><img width="20px" src="/carl500/style/images/modifier.png"/>  </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=location&action=delete&id=<?php echo $a_location['id']; ?>"><img width="20px" src="/carl500/style/images/supprimer.png"/>  </a></div>
						</td>
	                    <td><?php echo $a_location['name']; ?></td>
	                    <td><?php echo $a_location['address']; ?></td>
	                    <td><?php echo $a_location['zip']; ?></td>
	                    <td><?php echo $a_location['town']; ?></td>
	                    <td><?php echo $a_location['phone']; ?></td>
	                    <td><?php echo $a_location['fax']; ?></td>
	                </tr>

				<?php endforeach; ?>
                
            </tbody>
        
    </table>
</div>

<div align="center" style="text-align:center;" > 
    <table id="tableau_" border="1" width=100%>        
    </table>
</div>
