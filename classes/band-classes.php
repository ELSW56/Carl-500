<?php

//include './connexion-classes.php';

class Band {

	private $_id;
	private $_band_name;
	private $_number_persons;
	private $_hebergement;
	private $_check;
	private $_date_show;
	private $_rappel;
	private $_start_scenario;
	private $_end_scenario;
	private $_comments;
	private $_pdo;

	private $_validation;

	//Constructor-Destructor
	public function __construct( $id=0){
		$this->_pdo = ConnexionPDO::getInstance();
		if ( !empty( $id ) ){
			$this->_id = $id;
			$this->populate();
  		}
	}

	public function __destruct( ){

	}

	public function init($band_name, $number_persons, $hebergement, $check, $date_show, $rappel, $start_scenario, $end_scenario, $validation, $comments){
		$this->_band_name=$band_name;
		$this->_number_persons=$number_persons;
		$this->_hebergement=$hebergement;
     		$this->_check=$check;
		$this->_start_scenario=$start_scenario;
		$this->_end_scenario=$end_scenario;
		$this->_validation = $validation;
		$this->_date_show=$date_show;
		$this->_rappel=$rappel;
		$this->_comments=$comments;
	}

	public function populate(){
	  $q = $this->_pdo->query(' SELECT * FROM band WHERE id='.$this->_id);
	  $data = $q->fetch();

	  $this->_band_name=$data['name'];
	  $this->_number_persons=$data['nb_people'];
	  $this->_hebergement=$data['hebergement'];
	  $this->_check=$data['check_band'];
	  $this->_date_show=$data['jour_passage'];
	  $this->_rappel=$data['rappel'];
	  $this->_start_scenario=$data['scenario_arrivee'];
	  $this->_end_scenario=$data['scenario_depart'];
	  $this->_validation=$data['validation'];
	  $this->_comments=$data['comments'];
	}	

	//=========================================================================
	//GET
	//=========================================================================

	public function get_id(){
		return $this->_id;
	}	

	public function get_band_name(){
		return $this->_band_name;
	}	
	
	public function get_number_persons(){
		return $this->_number_persons;
	}	

	public function get_hebergement(){
		return $this->_hebergement;
	}
	
	public function get_check(){
		return $this->_check;
	}

	public function get_start_scenario(){
		return $this->_start_scenario;
	}

	public function get_end_scenario(){
		return $this->_end_scenario;
	}

	public function get_validation(){
		return $this->_validation;
	}

	public function get_date_show(){
		return $this->_date_show;
	}

	public function get_rappel(){
		return $this->_rappel;
	}

	public function get_comments(){
		return $this->_comments;
	}
	
	public function get_pdo(){
		return $this->_pdo;
	}

	/**
	 *	@return the ids of the runs designed for the band which id is given as a parameter
	 */
	public function get_run_by_id_band($id_band){
		$req = $this->get_pdo()->query('SELECT id FROM run WHERE id_band ='.$id_band);
		$data = $req->fetchAll();
		return $data;
	}
	/**
	 *	@return the ids of the band
	 */
	public function get_id_band_by_name($name){
		$req = $this->_pdo->query('SELECT id FROM band WHERE name ="'.$name.'"');
		$data = $req->fetchAll();
		return $data[0];
	}

	/**
	 *
	 *
	 */
	public function get_bands($query = 0){
		$req='SELECT * FROM band';
		if(!empty($query)){
			$req .=' WHERE 	name LIKE "%'.$query.'%"'; 
		}
		$req .= ' ORDER BY date(jour_passage)';
		$q = $this->_pdo->query($req);
	    	$data = $q->fetchAll();
		return $data;
	}


	//=========================================================================
	//SET
	//=========================================================================

	public function set_band_name($new_name){
		$this->_band_name = $new_name;
		echo $this->_band_name;
	}
	
	public function set_number_persons($new_number){
		$this->_number_persons = $new_number;
	}

	public function set_hebergement($hebergement){
		$this->_hebergement = $hebergement;
	}

	public function set_check($check){
		$this->_check = $check;
	}

	public function set_start_scenario($startScenario){
		$this->_start_scenario = $startScenario;
	}

	public function set_end_scenario($endScenario){
		$this->_end_scenario = $endScenario;
	}

	public function set_validation($validation){
		$this->_validation = $validation;
	}

	public function set_date_show($new_date){
		$this->_date_show = $new_date;
	}

	public function set_rappel($rappel){
		$this->_rappel = $rappel;
	}

	public function set_comments($comments){
		$this->_comments = $comments;
	}

	
	//=========================================================================
	//OTHERS
	//=========================================================================

	public function to_string(){
	}

	/**
	 *
	 *
	 */
	public function save(){
		try{
			//OK
			if(empty($this->_id)){
				
				
				$req = $this->_pdo->prepare('INSERT INTO band (`name`, `nb_people`, `hebergement`, `check_band`, `scenario_depart`, `scenario_arrivee`, `validation`, `jour_passage`, `rappel`, `comments`)		VALUES ( :name, :nbPeople, :hebergement, :check_band, :startScenario, :endScenario, :validation, :dateShow, :rappel, :comments)');

				$req->execute(array(
					':name' => $this->get_band_name(),
					':nbPeople' => $this->get_number_persons(),
					':hebergement' => $this->get_hebergement(),
					':check_band' => $this->get_check(),
					':startScenario' => $this->get_start_scenario(),
					':endScenario' => $this->get_end_scenario(),
					':validation' => $this->get_validation(),
					':dateShow' => $this->get_date_show(),
					':rappel' => $this->get_rappel(),
					':comments' => $this->get_comments()
				));
			}
			//NOK
			else{
				$q = $this->get_pdo()->query('SELECT id FROM band where id='.$this->_id);
				$defined = 0;
				while($data = $q->fetch() AND $defined == 0){
										
					if($data['id'] == $this->get_id()){
						$req = $this->_pdo->prepare('UPDATE band SET
										`name`=:name,
						       			`nb_people`=:nbpeople,
										`hebergement`=:hebergement,
										`check_band`=:check,
										`scenario_depart`=:depart,
										`scenario_arrivee`=:arrivee,
										`validation`=:validation,
										`jour_passage`=:jour,
										`rappel`=:rappel,
										`comments`=:comments 
									WHERE id=:id');
						$req->execute(array(
							':name'=> $this->get_band_name(),
							':nbpeople' => $this->get_number_persons(),
							':hebergement'=> $this->get_hebergement(),
							':check'=> $this->get_check(),
							':depart'=> $this->get_end_scenario(),
							':arrivee'=> $this->get_start_scenario(),
							':validation'=> $this->get_validation(),
							':jour' => $this->get_date_show(),
							':rappel' => $this->get_rappel(),
							':comments' => $this->get_comments(),
							':id' => $this->_id
						));
					$defined = 1;
					}
				}
				//OK
				if($defined == 0){ 
					
					$req = $this->_pdo->prepare('INSERT INTO band (`name`, `nb_people`, `hebergement`, `check_band`, `scenario_depart`, `scenario_arrivee`, `validation`, `jour_passage`, `rappel`, `comments`)		VALUES ( :name, :nbPeople, :hebergement, :check_band, :startScenario, :endScenario, :validation, :dateShow, :rappel, :comments)');

					$req->execute(array(
						':name' => $this->get_band_name(),
						':nbPeople' => $this->get_number_persons(),
						':hebergement' => $this->get_hebergement(),
						':check_band' => $this->get_check(),
						':startScenario' => $this->get_start_scenario(),
						':endScenario' => $this->get_end_scenario(),
						':validation' => $this->get_validation(),
						':dateShow' => $this->get_date_show(),
						':rappel' => $this->get_rappel(),
						':comments' => $this->get_comments()
					));
				}
			}	
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}

	/**
	 *
	 *
	 */
	public function delete(){

		foreach($this->get_run_by_id_band($this->get_id()) as $id_run){
			$run = new Run($id_run[id]);
			$run->set_id_band(null);
			$run->save();
		}
		
		if(!empty($this->_id)){
			try{
				$count = $this->get_pdo()->exec('DELETE FROM band WHERE id='.$this->_id); 
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

	}

	public function get_all_id_name_band(){
		$req = $this->_pdo->query('SELECT id, name FROM band');
		return $req->fetchAll();
	}
}
?>
