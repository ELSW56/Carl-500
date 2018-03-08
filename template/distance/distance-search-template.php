<?php
/**
 * Feature name:  CARL 500 distance-search-template
 * Description:   Page de recherche des distances
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

?>


   
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

				<?php foreach(get_distances($_GET['q']) as $a_distance): ?>
	                <tr>
	                    <td class="action child">
							<div  class ="btn child" style ="float:none; margin-top: 5px; margin-bottom: 5px;"><a class="child" href="/carl500/?page=distance&action=display&id=<?php echo $a_distance[id]; ?>"> Afficher </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=distance&action=modify&id=<?php echo $a_distance[id]; ?>">Modifier </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=distance&action=delete&id=<?php echo $a_distance[id]; ?>">Supprimer </a></div>
						</td>
	                    <td><?php location_name_by_id($a_distance[location1]); ?></td>
	                    <td><?php location_name_by_id($a_distance[location2]); ?></td>
	                    <td><?php echo $a_distance[distance]; ?></td>
	                    <td><?php echo $a_distance[time]; ?></td>
	                    
	                </tr>

				<?php endforeach; ?>
                
            </tbody>

    <script src="/carl500/style/js/opacity.js" > </script>	

