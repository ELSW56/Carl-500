<?php

/**
 * Feature name:  CARL 500 run-classes
 * Description:   Class de création/modification d'objets run
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 * Last Modified : 2015-07-03
 * Object : function get_runs_for_timeline to query only once the DB to get the informations needed for the timeline
 */

//include './connexion-classes.php';

class Run {

	private $_id;
	private $_id_run_type;
	private $_id_company;
	private $_id_band;
	private $_number_persons;
	private $_status;
	private $_comments;

	private $_way;
	private $_pdo;


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
	*	This function set all the value of a non set value object
	*/
	public function init($id_run_type, $id_company, $id_band, $nb_people, $status, $comments){
		$this->_id_run_type = $id_run_type;
		$this->_id_company = $id_company;
		$this->_id_band = $id_band;
		$this->_number_persons = $nb_people;
		$this->_status = $status;
		$this->_comments = $comments;
	}

	/**
	*	This function search in data base and set all the value of the object with the id corresponding
	*/
	public function populate(){
		$q = $this->get_pdo()->query('SELECT * FROM run WHERE id='.$this->_id);
		$data = $q->fetch();
		
		if($q != false){
			
			$this->set_id_run_type($data['id_run_type']);//->id_run
			$this->set_id_company($data['id_company']);//->id_company

			$this->set_id_band($data['id_band']);//->id_band);
			$this->set_number_persons($data['nb_people']);//->number_persons);
			$this->set_status($data['status']);//->status);
			$this->set_comments($data['comments']);//->comments);
		}
	}

	//=========================================================================
	//GET
	//=========================================================================
	
	public function get_id(){
		return $this->_id;
	}	

	public function get_maximum_id(){
		$q = $this->get_pdo()->query('SELECT max(id) FROM run');
		$id =  $q->fetch();
		$id[0] ++;
		return $id[0]; 
	}

	public function get_id_run_type(){
		return $this->_id_run_type;
	}	

	public function get_id_company(){
		return $this->_id_company;
	}

	public function get_id_band(){
		return $this->_id_band;
	}	

	public function get_number_persons(){
		return $this->_number_persons;
	}	

	public function get_status(){
		return $this->_status;
	}
	
	public function get_comments(){
		return $this->_comments;
	}	

	public function get_way(){
		return $this->_way;
	}

	public function get_pdo(){
		return $this->_pdo;
	}

	public function get_max_id(){
		$q = $this->_pdo->query('SELECT max(id) FROM run');
		$data = $q->fetchAll();
		$data++;
		return $data[0];	
	}

	//=========================================================================
	//SET
	//=========================================================================

	public function set_id($id){
		$this->_id = $id;
	}

	public function set_id_run_type($idRunType){
		$this->_id_run_type = $idRunType;
	}	

	public function set_id_company($idCompany){
		$this->_id_company = $idCompany;
	}

	public function set_id_band($idBand){
		$this->_id_band = $idBand;
	}	

	public function set_number_persons($numberPersons){
		$this->_number_persons = $numberPersons;
	}	

	public function set_status($status){
		$this->_status = $status;
	}
	
	public function set_comments($comments){
		$this->_comments = $comments;
	}	

	public function set_way($way){
		$this->_way = $way;
	}
	
	//=========================================================================
	//OTHERS
	//=========================================================================

	public function to_string(){
		echo '$_id = '.$this->get_id().'<br/>';
		echo '$_id_run_type = '.$this->get_id_run_type().'<br/>';
		echo '$_id_band = '.$this->get_id_band().'<br/>';
		echo '$_id_company = '.$this->get_id_company().'<br/>';
		echo '$_number_persons = '.$this->get_number_persons().'<br/>';
		echo '$_status = '.$this->get_status().'<br/>';
	}

	/**save the run to the database 
	*
	*/
	public function save(){
		try{
			if(empty($this->_id)){
				$req = $this->_pdo->prepare('INSERT INTO run VALUES(:id, :idRunType, :idCompany, :idBand, :nbPeople, :status, 0, :comments)');
				$req->execute(array(
					'id' => $this->get_maximum_id(),
					'idRunType'=> $this->get_id_run_type(),
					'idCompany'=> $this->get_id_company(),
					'idBand'=> $this->get_id_band(),
					'nbPeople'=> $this->get_number_persons(),
					'status'=> $this->get_status(),
					'comments'=> $this->get_comments()
				));
			}
			else{
				$req = $this->_pdo->prepare('UPDATE run SET
					id_run_type = :idRunType, 
					id_company = :idCompany, 
					id_band = :idBand, 
					nb_people = :nbPeople, 
					status =  :status, 
					comments = :comments
					WHERE id='.$this->get_id());

				$req->execute(array(
					'idRunType'=> $this->get_id_run_type(),
					'idCompany'=> $this->get_id_company(),
					'idBand'=> $this->get_id_band(),
					'nbPeople'=> $this->get_number_persons(),
					'status'=> $this->get_status(),
					'comments'=> $this->get_comments()
				));
						
			}
		}
		catch(Exception $e){
			$e->getMessage();
		}
	}


		public function get_runs($day, $status, $query){
			/* A modifier pour récupérer toutes les infos nécessaires d'un coup en se basant sur la requête suivante :
				select run.id, band.name as 'groupe', date_format(way1.date_heure_depart, '%d/%m/%Y' ) as 'Jour départ', date_format(way1.date_heure_depart, '%H:%i' ) as 'heure départ', way1.id_location_depart as 'lieu départ', run.nb_people, date_format(way2.date_heure_arrivee, '%H:%i' ) as 'heure arrivée'
				from run join way way1 on (run.id=way1.id_run) join band on (band.id=run.id_band) join way way2 on (way2.id_run = run.id)
				where way1.date_heure_depart = (select min(date_heure_depart) from way where id_run = run.id)
				and way2.date_heure_depart = (select max(date_heure_depart) from way where id_run = run.id)
			*/
			$req="select run.id as id, 
					band.name as name, 
					date_format(way1.date_heure_depart, '%d/%m/%Y' ) as jdep, 
					status,
					date_format(way1.date_heure_depart, '%H:%i' ) as hdep,
					way1.id_location_depart as ldep,
					run.nb_people as nb,
					date_format(way2.date_heure_arrivee, '%H:%i' ) as harr, way2.id_location_depart AS larr
				from run join way way1 on (run.id=way1.id_run) join band on (band.id=run.id_band) join way way2 on (way2.id_run = run.id)
				where way1.date_heure_depart = (select min(date_heure_depart) from way where id_run = run.id)
				and way2.date_heure_depart = (select max(date_heure_depart) from way where id_run = run.id)";
			if (!empty($day)) {
				$req .= " AND date_format( way1.date_heure_depart, '%d/%m/%Y' ) = '".$day."'";

			}
			if($status<2){
				$req .=' AND status<2';
			}
			else {
				$req .=' AND status=2';
			}

			//Selection des id des locations
				//Recouper avec les id des way
				//En déduire les runs
				if(!($query==0)){

					$requete = $this->_pdo->query('SELECT id FROM band WHERE name LIKE"%'.$query.'%" ');

					$donnees = $requete->fetchAll();

					$i = 0;
					$req .= ' AND ( ';

					if(!empty($donnees)){

						foreach($donnees[$i] as $data){
							if($i == 0){
								$req .= ' id_band= '.$data ;
								$i++;
							}
							else{
								$req .= 'OR  id_band= '.$data ;
							}
						}
						
					}
					$req .= ' ) ';
				}
				$req .= " ORDER BY way1.date_heure_depart";
				$q = $this->_pdo->query($req);
    			$data = $q->fetchAll();
			return $data;
	
		}
	
	public function get_runs_for_timeline() {
		$req = 'SELECT * FROM VUE_TIMELINE';
		$q = $this->_pdo->query($req);
    	$data = $q->fetchAll();
		return $data;
	}
		
	public function get_runs_by_band($id_band) {
		$req="select run.id as id, 
				band.name as name, 
				date_format(way1.date_heure_depart, '%d/%m/%Y' ) as jdep, 
				status,
				date_format(way1.date_heure_depart, '%H:%i' ) as hdep,
				way1.id_location_depart as ldep,
				run.nb_people as nb,
				date_format(way2.date_heure_arrivee, '%H:%i' ) as harr, way2.id_location_depart AS larr
			from run join way way1 on (run.id=way1.id_run) join band on (band.id=run.id_band) join way way2 on (way2.id_run = run.id)
			where way1.date_heure_depart = (select min(date_heure_depart) from way where id_run = run.id)
			and way2.date_heure_depart = (select max(date_heure_depart) from way where id_run = run.id)
			and band.id = ";
		$req.=$id_band;
		$req.=" order by jdep, hdep";
			$q = $this->_pdo->query($req);
    	$data = $q->fetchAll();
		return $data;
	}
		
	public function delete(){
		if(!empty($this->_id)){
			try{
				$count = $this->get_pdo()->exec('DELETE FROM run WHERE id='.$this->_id); 
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

	}

	public function get_name_company(){
		$req='SELECT * FROM company WHERE id='.$this->_id_company;
	    	$q = $this->_pdo->query($req);
	    	$data = $q->fetchAll();
	
		return $data[0]['name'];
	}
	
	public function updateStatus() {
		$req = $this->_pdo->prepare('update Run SET status = (SELECT min(status) FROM Drive WHERE id_run = :id) WHERE id = :id');
		$req->execute(array(
			'id' => $this->get_id()
		));
			
	}
}

?>
