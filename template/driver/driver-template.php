 <div>   

        <div class="form-search">
          <input type="text" class="input-medium search-query" style="margin-right: 5px; margin-left: 455px; float: left;">
          <button type="submit" class="btn" style="float: left;">Rechercher un Chauffeur</button>
        </div>

        <div><button type="submit" class="btn" style="float: left; margin-left: 20px; margin-bottom: 20px; margin-right: 20px;">Importer un fichier .csv</button></div>
          

        <div  id="addDriver" class ="btn"><a href="/carl500/?page=driver&action=add"> Ajouter un Chauffeur </a></div>
    
</div>

<div align="center" style="text-align:center;" > 
    <table id="tableau" border="1" width=100%>

         

        <thead>
            <tr>
                <th>Action</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Tél</th>
                <th>Email</th>

              
            </tr>
        </thead>
      
            <tbody>

				<?php foreach(get_drivers() as $a_driver): ?>

	                <tr>
	                    <td>
							<div  class ="btn" style ="float:none; margin-top: 5px; margin-bottom: 5px;"><a href="/carl500/?page=driver&action=display&id=<?php echo $a_driver[id]; ?>"> <img width="20px" src="/carl500/style/images/voir.png"/>  </a></div> 
							<div  class ="btn" style ="float:none;"> <a href="/carl500/?page=driver&action=modify&id=<?php echo $a_driver[id]; ?>"><img width="20px" src="/carl500/style/images/modifier.png"/> </a> </div> 
							<div  class ="btn" style ="float:none;"> <a href="/carl500/?page=driver&action=delete&id=<?php echo $a_driver[id]; ?>"><img width="20px" src="/carl500/style/images/supprimer.png"/> </a> </div>
						</td>
	                    <td><?php echo $a_driver[last_name]; ?></td>
	                    <td><?php echo $a_driver[first_name]; ?></td>
	                    <td><?php echo $a_driver[phone]; ?></td>
	                    <td><?php echo $a_driver[email]; ?></td>
	                </tr>

				<?php endforeach; ?>
                       
            </tbody>
        
    </table>
</div>