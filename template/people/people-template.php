<?php
/**
 * Feature name:  CARL 500 people-template
 * Description:   Page de liste des personnes
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */
?>
<?php
    if(isset($_GET['action']) && $_GET['action']=='delete'){
      echo '<center><p style="color:green;">La personne a été supprimée</p></center>';
            delete_people_by_id($_GET['id']);
          }
    ?>

<script>
$(document).ready(function(){
	$('#search_poeple').bind('keyup', function(){
   		if( $(this).val().length > 1 ){
			$.ajax({
			  	type : 'GET',
				url : '/carl500/?page=people&action=search&option=no_header_footer' ,
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
          <input type="text" id="search_poeple" class="input-medium search-query" style="margin-left: 640px; float: left;">
          
        </div>

         <div class="btn non-printable" style="float: left; margin-left: 20px; margin-bottom: 20px; margin-right: 20px;"><a href="/carl500/?page=people&action=import">Importer un fichier .csv</div></a>
          
        <div  id="addDriver" class ="btn non-printable"><a href="/carl500/?page=people&action=add"> Ajouter une Personne </a></div>
    
</div>


<div align="center" style="text-align:center;" > 
    <table id="tableau" border="1" width=100%>

       

        <thead>
            <tr>
                <th class ="non-printable" style="width:10%">Action</th>
                <th style="width:18%">Nom</th>
                <th style="width:18%">Prénom</th>
                <th style="width:10%">Rôle</th>
                <th style="width:10%">Tél</th>
                <th style="width:24%">E-mail</th>
              
            </tr>
        </thead>
      
            <tbody>

				<?php foreach(get_peoples() as $a_people): ?>

	                <tr>
	                    <td class="action child non-printable" style="width:369px; height:40px;" >
								<div  class ="btn child " style ="opacity: 0.3; float:none; margin-top: 5px; margin-bottom: 5px;"><a class="child" href="/carl500/?page=people&action=display&id=<?php echo $a_people['id']; ?>"> <img width="20px" src="/carl500/style/images/voir.png"/>  </a></div> 
								<div  class ="btn child" style ="opacity: 0.3; float:none;"> <a class="child" href="/carl500/?page=people&action=modify&id=<?php echo $a_people['id']; ?>"><img width="20px" src="/carl500/style/images/modifier.png"/> </a> </div> 
								<div  class ="btn child" style ="opacity: 0.3; float:none;"> <a class="child" href="/carl500/?page=people&action=delete&id=<?php echo $a_people['id']; ?>"><img width="20px" src="/carl500/style/images/supprimer.png"/> </a> </div>	
						</td>
	                    <td><?php echo $a_people['last_name']; ?></td>
	                    <td><?php echo $a_people['first_name']; ?></td>
                    	<td><?php echo get_type_people($a_people['id_people_type']); ?></td>
	                    <td><?php echo $a_people['phone']; ?></td>
	                    <td><?php echo $a_people['email']; ?></td>
	                </tr>

				<?php endforeach; ?>
                
            </tbody>
        
    </table>
</div>

<div align="center" style="text-align:center;" > 
    <table id="tableau_" border="1" width=100%>

    </table>
</div>