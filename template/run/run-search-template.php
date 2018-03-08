    <?php 
      $status=0;
      $calles=0;
	  if (isset($_GET['filter'])) {
		  if($_GET['filter']=='terminee'){
			$status='1';
			$selected_termine='selected="selected"';

		  }
		  if($_GET['filter']=='calles'){
			$calles='oui';
			$selected_calle='selected="selected"';
		  }
		  if($_GET['filter']=='non_calles'){
			$calles='non';
			$selected_non_calle='selected="selected"';

		  }
	  }
	echo $calles;

   ?>

    <table id="tableau" border="1" width=100%>



        <thead>
            <tr>
                <th>Action</th>
                <th>Groupe</th>
                <th>Date</th>
                <th>Heure de départ</th>
                <th>Lieu de départ</th>
                <th>Heure d'arrivée</th>
                <th>Lieu d'arrivée</th>
                <th>Nombre de personnes</th>
                <th>Calé</th>
            </tr>
        </thead>
      
            <tbody>

	<?php 
		if(isset($_GET['date'])){
			$a_day=$_GET['date']; } 
		else {
			$a_day=0;
		} 
	?>

			<?php foreach(get_runs($a_day,$status,(string)$calles,$_GET['q']) as $a_run) : ?>
								
                <tr class="<?php run_class_css($a_run); ?>">
                     <td class="action child">
						<div  class ="btn child" style ="opacity:0.3; float:none; margin-top: 5px; margin-bottom: 5px;"> <a class="child" href="/carl500/?page=run&action=display&id=<?php echo $a_run['id']; ?>">Afficher </a></div> 
						<div  class ="btn child" style =" opacity:0.3; float:none;"><a class="child" href="/carl500/?page=run&action=modify&id=<?php echo $a_run['id']; ?>"> Modifier </a></div> 
						<div  class ="btn child" style =" opacity:0.3; float:none;"> <a class="child" href="/carl500/?page=run&action=delete&id=<?php echo $a_run['id']; ?>">Supprimer </a></div></td>
                    <td><?php echo $a_run['name']; ?></td>
                    <td><?php echo $a_run['jdep']; ?></td>
                    <td><?php echo $a_run['hdep']; ?></td>
                    <td><?php location_name_by_id($a_run['ldep']); ?></td>
                    <td><?php echo $a_run['harr']; ?></td>
                    <td><?php location_name_by_id($a_run['larr']); ?></td>
                    <td><?php echo $a_run['nb']; ?></td>
                    <td><label class="checkbox">
                      <input class="check_calle" id="check_calle_<?php echo $a_run['id']; ?>" type="checkbox" name="finished" <?php if($a_run['calle']==1){echo 'checked="checked"';} ?> value="1" style="margin-left:auto; margin-right:auto;">
          
                        </label>
                    </td>
                </tr>

			<?php endforeach; ?>

             </tbody>
        
    </table>

    <script src="/carl500/style/js/opacity.js" > </script>	
