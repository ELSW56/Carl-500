<?php

//include './connexion-classes.php';

class Distance {
	
	private $_id;
	private $_location1;
	private $_location2;
	private $_distance;
	private $_time;
	
	private $_pdo;
	
	public function __construct($id=0){
		$this->_pdo = ConnexionPDO::getInstance();
		if ( !empty( $id ) ) {
			$this->_id = $id;
  	        $this->populate();
  	    }
	}
	
	public function __destruct( ){

	}
	
	public function init($location1, $location2, $distance, $time){
		$this->_location1 = $location1;
		$this->_location2 = $location2;
		$this->_distance = $distance;
		$this->_time = $time;
	}
	
	public function populate(){
		$req = $this->_pdo->query('SELECT * FROM distance WHERE id="'.$this->_id.'"');
		$data = $req->fetch();
		
		$this->_location1 = $data['location1'];
		$this->_location2 = $data['location2'];
		$this->_distance = $data['distance'];
		$this->_time = $data['time'];
		
	}
	
	//=========================================================================
	//GET
	//=========================================================================
	
	public function get_id(){
		return $this->_id;
	}
		
	public function get_location1(){
		return $this->_location1;
	}
	
	public function get_location2(){
		return $this->_location2;
	}
	
	public function get_distance(){
		return $this->_distance;
	}
	
	public function get_time(){
		return $this->_time;
	}
	
	public function get_pdo(){
		return $this->_pdo;
	}

	public function get_distances($query = 0){
		$req = 'SELECT * FROM distance';
		if(!empty($query)){
			$req .= ' WHERE ';
			$requete =$this->_pdo->query('SELECT id FROM location WHERE name LIKE "%'.$query.'%"');
			$defined = 0;
			while($data = $requete->fetch()){
				if($defined == 0){
					$req .= ' location1 ='.$data['id'].' OR location2 ='.$data['id'];
				}
				else{
					$req .= ' OR location1 ='.$data['id'].' OR location2 ='.$data['id'];
				}
				$defined ++;				
			}
			//$req .= ' OR distance LIKE "%'.$query.'%" OR
			//		time LIKE "%'.$query.'%" ';
		}
		$q = $this->_pdo->query($req);
		$data = $q->fetchAll();
		return $data;
	}

	//=========================================================================
	//SET
	//=========================================================================
	
	public function set_id($id){
		$this->_id = $id;
	}
		
	public function set_location1($location1){
		$this->_location1 = $location1;
	}
	
	public function set_location2($location2){
		$this->_location2 = $location2;
	}
	
	public function set_distance($distance){
		$this->_distance = $distance;
	}
	
	public function set_time($time){
		$this->_time = $time;
	}	
	
	//=========================================================================
	//OTHERS
	//=========================================================================
	
	public function get_time_distance($location1, $location2){

		$req = $this->_pdo->query('SELECT * FROM distance WHERE (location1='.$location1.' AND location2='.$location2.') OR (location1='.$location2.' AND location2='.$location1.')');

		$data = $req->fetch();
		return $data['time'];
	}

	//!\\ AUCUN ÉLEMENTS À NULL , ILS DOIVENT ETRE TOUS INITIALISÉS
	public function save(){
		try{
			$id = $this->_id;
			if(empty($id)){
				
				$req = $this->_pdo->prepare('INSERT INTO distance (`id`, `location1`, `location2`, `distance`, `time`)
									VALUES( :id, :location1, :location2, :distance, :time)');
									
				$req->execute(array(
							':id' => '',
							':location1' => $this->get_location1(),
							':location2' => $this->get_location2(),
							':distance' => $this->get_distance(),
							':time' => $this->get_time()
				));
			}
			else{
				$q = $this->get_pdo()->query('SELECT id FROM distance');
				$defined = 0;
				while($data = $q->fetch()){

					if($data['id'] ==  $this->get_id()){
						
						$req = $this->_pdo->prepare('UPDATE distance SET
							location1 = :location1,
							location2 = :location2,
							distance = :distance,
							time = :time
							WHERE id='.$this->get_id()
						);
	
						$req->execute(array(
							':location1' => $this->get_location1(),
							':location2' => $this->get_location2(),
							':distance' => $this->get_distance(),
							':time' => $this->get_time()
						));
						$defined = 1;
					}
				}
				
				
				if($defined == 0){
					
					$req = $this->_pdo->prepare('INSERT INTO distance (`id`, `location1`, `location2`, `distance`, `time`)
									VALUES( :id, :location1, :location2, :distance, :time)');
									
					$req->execute(array(
							':id' => $this->get_id(),
							':location1' => $this->get_location1(),
							':location2' => $this->get_location2(),
							':distance' => $this->get_distance(),
							':time' => $this->get_time()
					));
				}
			}
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}


	public function delete(){
		if(!empty($this->_id)){
			try{
				$count = $this->get_pdo()->exec('DELETE FROM distance WHERE id='.$this->_id); 
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}

}
?>
