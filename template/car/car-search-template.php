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
                <th>Marque</th>
                <th>Modèle</th>
                <th>Couleur</th>
                <th>Imatriculation</th>
                <th>Nombre de places</th>
              
            </tr>
        </thead>
      
            <tbody >

				<?php foreach(get_cars($_GET['q']) as $a_car): ?>

                <tr>
                    <td class="action child" >
						<div  class ="btn child" style ="float:none; margin-top: 5px; margin-bottom: 5px;"> <a class="child" href="/carl500/?page=car&action=display&id=<?php echo $a_car[id]; ?>">Afficher</a> </div> 
						<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=car&action=modify&id=<?php echo $a_car[id]; ?>">Modifier </a></div> 
						<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=car&action=delete&id=<?php echo $a_car[id]; ?>">Supprimer </a> </div>
					</td>
                    <td><?php echo $a_car[manufacturer];?></td>
                    <td><?php echo $a_car[model]; ?></td>
                    <td><?php echo $a_car[color]; ?></td>
                    <td><?php echo $a_car[immat]; ?></td>
                    <td><?php echo $a_car[capacity]; ?></td>
                </tr>    

			<?php endforeach; ?>            
                
            </tbody>

    <script src="/carl500/style/js/opacity.js" > </script>	
