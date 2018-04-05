<?php

/**
 * Feature name:  CARL 500 drive-classes
 * Description:   Class de création/modification d'objets drive
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

class Drive {

	private $_id;
	private $_id_run;
	private $_id_car;
	private $_id_driver;
	private $_start;
	private $_end;
	private $_status;
	private $_pdo;
	
	//Constructor-Destructor

	public function __construct($id = 0){
		$this->_pdo = ConnexionPDO::getInstance();
		if(!empty($id)){
			$this->set_id($id);
			$this->populate();
		}			
	}
	public function __destruct( ){

	}
	
	/**
	*	This function search in data base and set all the value of the object with the id corresponding
	*/
	public function populate(){
		$q = $this->_pdo->query('SELECT * FROM drive WHERE id='.$this->_id);;
		$data = $q->fetch();

		$this->_id_car = $data[1];
		$this->_id_run = $data[2];
		$this->_id_driver = $data[3];
		$this->_start = $data[4];
		$this->_end = $data[5];
		$this->_status = $data[6];
	}

	/**
	*	This function set all the value of a non set value object
	*/
	public function init($id_run, $id_car, $id_driver,$start, $end){
		$this->_id_run = $id_run;
		$this->_id_driver = $id_driver;
		$this->_id_car = $id_car;
		$this->_start = $start;
		$this->_end = $end;
		$this->_status = 0;
	}
	
	//=========================================================================
	//GET
	//=========================================================================

	public function get_id(){
		return $this->_id;
	}

	public function get_id_car(){
		return $this->_id_car;
	}	

	public function get_id_run(){
		return $this->_id_run;
	}	

	public function get_id_driver(){
		return $this->_id_driver;
	}	

	public function get_start(){
		return $this->_start;
	}	

	public function get_end(){
		return $this->_end;
	}	

	public function get_status(){
		return $this->_status;
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

	public function set_id_car($idCar){
		$this->_id_car = $idCar;
	}

	public function set_id_run($idRun){
		$this->_id_run = $idRun;
	}

	public function set_id_driver($idDriver){
		$this->_id_driver = $idDriver;
	}

	public function set_start($start){
		$this->_start = $start;
	}

	public function set_end($end){
		$this->_end = $end;
	}

	public function set_status($status){
		$this->_status = $status;
	}

	//=========================================================================
	//OTHERS
	//=========================================================================
	
	public function save(){
		try{
			$id = $this->get_id();
			// id du constructeur vide
			if(empty($id)){
			
				$req = $this->_pdo->prepare('INSERT INTO drive ( `id_car`, `id_run`, `id_driver`, `start`, `end`,`status`) VALUES (:idCar, :idRun, :idDriver, :start, :end, :status)');
				$req->execute(array(
					'idCar' => $this->get_id_car(),
					'idRun' => $this->get_id_run(),
					'idDriver' => $this->get_id_driver(),
					'start' => $this->get_start(),
					'end' => $this->get_end(),
					'status' => $this->get_status()
				));
			}
			// $id du constructeur rempli
			else{
				//$q = $this->get_pdo()->query('SELECT id FROM drive');
				//$defined = 0;
				/* while($data = $q->fetch()){

					if($data['id'] ==  $this->get_id()){
 */
						$strreq= 'UPDATE `drive` SET';
						if ($this->get_id_car() == '') {
							$strreq .="`id_car`= NULL,";
						}
						else {
							$strreq .="`id_car`= ".$this->get_id_car().',';
						}

						if ($this->get_id_driver() == '') {
							$strreq .="`id_driver`= NULL,";
						}
						else {
							$strreq .="`id_driver`= ".$this->get_id_driver().',';
						}

						$strreq .= '`start` = :start,`end` = :end,`id_run`  = :idRun,`status` = :status  WHERE id='.$id;
						$req = $this->_pdo->prepare($strreq);
				
						$req->execute(array(
							'idRun' => $this->get_id_run(),
							'start' => $this->get_start(),
							'end' => $this->get_end(),
							'status' => $this->get_status(),
							
						));
			}
	}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}


	public function delete(){
		if(!empty($this->_id)){
			try{
				$req='SELECT nb FROM nb_drives_per_run where id_run = '.$this->_id_run;
				$q = $this->_pdo->query($req);
				$count = $q->fetch();
				if ($count['nb'] > 1) {
					$this->get_pdo()->exec('DELETE FROM drive WHERE id='.$this->_id); 
				}
				return $count['nb'];
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}

	public function get_drives(){
		$req='SELECT * FROM drive';
		$q = $this->_pdo->query($req);
		$data = $q->fetchAll();
	
		return $data;
	}

	public function get_drives_by_run_id($id_run){
		if ($id_run > 0) {
			$req='SELECT * FROM drive WHERE id_run = '.$id_run;
		} else {
			$req='SELECT * FROM drive';
		}
		$q = $this->_pdo->query($req);
		$data = $q->fetchAll();
	
		return $data;
	}

}
?>
