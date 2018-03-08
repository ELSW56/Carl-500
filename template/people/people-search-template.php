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
                <th>Prénom</th>
                <th>Rôle</th>
                <th>Tél</th>
                <th>E-mail</th>
              
            </tr>
        </thead>
		<br>
            <tbody>

				<?php foreach(get_peoples($_GET['q']) as $a_people): ?>

	                <tr>
	                    <td class="action child">
							<div  class ="btn child" style ="float:none; margin-top: 5px; margin-bottom: 5px;"><a class="child" href="/carl500/?page=people&action=display&id=<?php echo $a_people['id']; ?>"> Afficher </a></div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=people&action=modify&id=<?php echo $a_people['id']; ?>">Modifier</a> </div> 
							<div  class ="btn child" style ="float:none;"> <a class="child" href="/carl500/?page=people&action=delete&id=<?php echo $a_people['id']; ?>">Supprimer</a> </div>
						</td>
	                    <td><?php echo $a_people['last_name']; ?></td>
	                    <td><?php echo $a_people['first_name']; ?></td>
                    	<td><?php echo get_type_people($a_people['id_people_type']); ?></td>
	                    <td><?php echo $a_people['phone']; ?></td>
	                    <td><?php echo $a_people['email']; ?></td>
	                </tr>

				<?php endforeach; ?>
                
            </tbody>
