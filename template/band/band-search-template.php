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
                <th>Nombre de personnes</th>
                <th>Jour de passage</th>
                <th>Heure de passage</th>
              
            </tr>
        </thead>
      
            <tbody>

				<?php foreach(get_bands($_GET['q']) as $a_band): ?>

	                <tr>
	                    <td class="action child">
							<div  class ="btn child" style ="float:none; margin-top: 5px; margin-bottom: 5px;"> <a class="child" href="/carl500/?page=band&action=display&id=<?php echo $a_band[id]; ?>">Afficher </a></div>
			 				<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=band&action=modify&id=<?php echo $a_band[id]; ?>">Modifier </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=band&action=delete&id=<?php echo $a_band[id]; ?>"> Supprimer </a></div>
						</td>
	                    <td><?php echo $a_band[name]; ?></td>
	                    <td><?php echo $a_band[nb_people]; ?></td>
	                    <td><?php band_day_pass($a_band[jour_passage]); ?></td>
	                    <td><?php band_hour_pass($a_band[jour_passage]); ?></td>
	                </tr>

				<?php endforeach; ?>
                <tr>

            </tbody>

    <script src="/carl500/style/js/opacity.js" > </script>	

