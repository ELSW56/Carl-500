<?php
/**
 * Feature name:  CARL 500 car-search-template
 * Description:   Page de recherche des véhicules
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

?>


   
        <thead>
            <tr>
                <th>Action</th>
                <th>Nom</th>
                <th>Adresse</th>
                <th>Code postal</th>
                <th>Ville</th>
                <th>Tél</th>
                <th>Fax</th>
              
            </tr>
        </thead>
      
            <tbody>

				<?php foreach(get_locations($_GET['q']) as $a_location): ?>
				<?php echo $_GET['q'];?>

	                <tr>
	                    <td class="action child">
							<div  class ="btn child" style ="float:none; margin-top: 5px; margin-bottom: 5px;"><a class="child" href="/carl500/?page=location&action=display&id=<?php echo $a_location['id']; ?>"> Afficher </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=location&action=modify&id=<?php echo $a_location['id']; ?>">Modifier </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=location&action=display&id=<?php echo $a_location['id']; ?>">Supprimer </a></div>
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

    <script src="/carl500/style/js/opacity.js" > </script>	

