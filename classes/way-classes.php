<?php

/**
 * Feature name:  CARL 500 way-classes
 * Description:   Class de création/modification d'objets way
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

class Way {

	private $_id;
	private $_id_location_depart;
	private $_id_location_arrivee;
	private $_date_depart;
	private $_date_arrivee;
	private $_comments;
	private $_id_run;

	private $_pdo; 
	

	//Constructor-Destructor
	public function __construct( $id=0){
		$this->_pdo = ConnexionPDO::getInstance();
		if(!empty($id)){
			$this->set_id($id);
			$this->populate();
		}
	}

	/**
	*	This function search in data base and set all the value of the object with the id corresponding
	*/
	public function populate(){
		$q = $this->_pdo->query('SELECT * FROM way WHERE id='.$this->get_id());
		$data = $q->fetch();
		if($q != false){ 
			$this->_comments = $data['comments'];
			$this->_id_location_depart = $data['id_location_depart'];
			$this->_id_location_arrivee = $data['id_location_arrivee'];
			$this->_date_depart = $data['date_heure_depart'];
			$this->_date_arrivee = $data['date_heure_arrivee'];
			$this->_id_run = $data['id_run'];
		}
	}

	/**
	*	This function set all the value of a non set value object
	*/
	public function init( $id_loc_dep, $id_loc_arr, $date_dep, $date_arr, $id_run ){
		$this->_id_location_depart = $id_loc_dep;
		$this->_id_location_arrivee = $id_loc_arr;
		$this->_date_depart = $date_dep;
		$this->_date_arrivee = $date_arr;
		$this->_id_run = $id_run;


		$this->_pdo = ConnexionPDO::getInstance();
	}

	public function __destruct( ){

	}

	public function get_id(){
		return $this->_id;
	}

	public function get_id_location_depart(){
		return $this->_id_location_depart;
	}	

	public function get_id_location_arrivee(){
		return $this->_id_location_arrivee;
	}

	public function get_date_depart(){
		return $this->_date_depart;
	}	

	public function get_date_arrivee(){
		return $this->_date_arrivee;
	}

	public function get_comments(){
		return $this->_comments;
	}	

	public function get_id_run(){
		return $this->_id_run ; 
	}

	public function get_pdo(){
		return $this->_pdo;
	}

	//=========================================================================
	//SET
	//=========================================================================

	public function set_id($id){
		$this->_id = $id;
	}

	public function set_id_location_depart($new_loc){
		$this->_id_location_depart = $new_loc;
	}
	
	public function set_id_location_arrivee($new_loc){
		$this->_id_location_arrivee = $new_loc;
	}

	public function set_date_heure_depart($new_date){
		$this->_date_depart = $new_date;
	}

	public function set_date_heure_arrivee($new_date){
		$this->_date_arrivee = $new_date;
	}

	public function set_comments($comments){
		$this->_comments = $comments;
	}

	public function set_id_run($idRun){
		$this->_id_run = $idRun ; 
	}

	/**add the way to the database 
	*
	*/
	public function get_max_id(){
		$q = $this->_pdo->query('SELECT max(id) FROM way');
		$data = $q->fetch();
		$data ++;
		return $data;
	}
	public function save(){
		try{
			$id = $this->get_id();
			// id du constructeur vide
			if(empty($id)){
			
				$req = $this->_pdo->prepare('INSERT INTO way (`id`, `comments`, `id_location_depart`, `id_location_arrivee`, `date_heure_depart`, `date_heure_arrivee`, `id_run`) VALUES (:id, :comments, :idLocationDepart, :idLocationArrivee, :dateDepart, :dateArrivee, :idRun)');
				$req->execute(array(
					'id' => $this->get_max_id(), 
					'comments' => $this->get_comments(),
					'idLocationDepart'=> $this->get_id_location_depart(),
					'idLocationArrivee'=>$this->get_id_location_arrivee(),
					'dateDepart'=> $this->get_date_depart(),
					'dateArrivee'=>$this->get_date_arrivee(),
					'idRun'=>$this->get_id_run()
				));
			}
			// $id du constructeur rempli
			else{
				$q = $this->get_pdo()->query('SELECT id FROM way');
				$defined = 0;
				while($data = $q->fetch()){

					if($data['id'] ==  $this->get_id()){
						
						$req = $this->_pdo->prepare('UPDATE way SET
							id_location_depart = :idLocationDepart, 
							id_location_arrivee = :idLocationArrivee, 
							date_heure_depart = :dateDepart, 
							date_heure_arrivee = :dateArrivee, 
							id_run = :idRun
							WHERE id='.$this->get_id());
	
						$req->execute(array(
							'idLocationDepart'=> $this->get_id_location_depart(),
							'idLocationArrivee'=> $this->get_id_location_arrivee(),
							'dateDepart'=> $this->get_date_depart(),
							'dateArrivee'=> $this->get_date_arrivee(),
							'idRun'=> $this->get_id_run()
						));
						$defined = 1;
					}
				}
				if($defined == 0){ 
					$req = $this->_pdo->prepare('INSERT INTO way (`id`, `comments`, `id_location_depart`, `id_location_arrivee`, `date_heure_depart`, `date_heure_arrivee`, `id_run`) VALUES (:id, :comments, :idLocationDepart, :idLocationArrivee, :dateDepart, :dateArrivee, :idRun)');
					$req->execute(array(
						'id' => $this->get_max_id(), 
						'comments' => $this->get_comments(),
						'idLocationDepart'=> $this->get_id_location_depart(),
						'idLocationArrivee'=>$this->get_id_location_arrivee(),
						'dateDepart'=> $this->get_date_depart(),
						'dateArrivee'=>$this->get_date_arrivee(),
						'idRun'=>$this->get_id_run()
					));
					
				}
			}
	}
		catch(Exception $e){
			$e->getMessage();
		}
	}



	/**add the run to the database 
	*
	*/
	/*public function save(){
		try{
			if(empty($this->_id)){
				$req = $this->get_pdo()->prepare('INSERT INTO way VALUES(:comments, :loc_dep, :loc_arr, :date_dep, :date_arr, :id_run)');
				$req->execute(array(
					'comments'=>$this->get_comments(),
					'id_location_depart' => $this->get_id_location_depart(),
					'id_location_arrivee'=> $this->get_id_location_arrivee(),
					'date_heure_depart'=>$this->get_date_depart(),
					'date_heure_arrivee'=>$this->get_date_arrivee(),
					'id_run'=>$this->get_id_run() 
		 		));
			}
			
			// si l'id est utilisé (hypothétiquement)	
			else{
				$req = $this->get_pdo()->prepare('UPDATE way 
					SET comments =  :comments, 
					SET id_location_depart = :loc_dep, 
					SET id_location_arrivee = :loc_arr, 
					SET date_heure_depart = :date_dep, 
					SET date_heure_arrivee = :date_arr,
					SET id_run = :id_run');

				$req->execute(array(
					'comments'=> $this->get_comments(),
					'loc_dep'=> $this->get_id_location_depart(),
					'loc_arr'=> $this->get_id_location_arrivee(),
					'date_dep'=> $this->get_date_depart(),
					'date_arr'=> $this->get_date_arrivee(),
					'id_run'=> $this->get_id_run()
				));
			}	
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}
*/
	public function delete(){
		if(!empty($this->_id)){
			try{
				$count = $this->get_pdo()->exec('DELETE FROM way WHERE id='.$this->_id); 
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

	}

	public function get_ways($a_date){
		if ($a_date=='Tous') {
			$q = $this->get_pdo()->query('SELECT * FROM way');
		} else {
			$q = $this->get_pdo()->query('SELECT * FROM way WHERE day(`date_heure_depart`)='.$a_date.' OR day(`date_heure_arrivee`)='.$a_date);
		}
    		$data = $q->fetchAll();
		return $data;
	}

	public function get_ways_by_id_run($id_run){
	   		$q = $this->_pdo->query('SELECT * FROM way WHERE id_run='.$id_run.' ORDER BY date_heure_depart');
    		$data = $q->fetchAll();

		return $data;
	}

	public function get_min_date_by_run_id($run_id){
		$q = $this->_pdo->query('SELECT * FROM way WHERE id_run='.$run_id.' ORDER BY date_heure_depart');
    		$data = $q->fetch();
		
		return $data['date_heure_depart'];
	}
	
	public function get_max_date_by_run_id($run_id){
		$q = $this->get_pdo()->query('SELECT * FROM way WHERE id_run='.$run_id.' ORDER BY date_heure_arrivee DESC');
    		$data = $q->fetch();
		
		return $data['date_heure_arrivee'];
	}

	public function get_location_dep_by_run_id($run_id){
		$q = $this->get_pdo()->query('SELECT * FROM way WHERE id_run='.$run_id.' ORDER BY date_heure_depart');
    		$data = $q->fetchAll();
		
		return $data[0]['id_location_depart'];
	}

	public function get_location_max_dep_by_run_id($run_id){
		$q = $this->get_pdo()->query('SELECT * FROM way WHERE id_run='.$run_id.' ORDER BY date_heure_depart DESC');
    		$data = $q->fetchAll();
		
		return $data[0]['id_location_depart'];
	}

	public function get_location_arr_by_run_id($run_id){
		$q = $this->get_pdo()->query('SELECT * FROM way WHERE id_run='.$run_id.' ORDER BY date_heure_arrivee DESC');
    		$data = $q->fetchAll();
		
		return $data[0]['id_location_arrivee'];
	}
	
}

?>
