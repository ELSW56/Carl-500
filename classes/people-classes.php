<?php

//include './connexion-classes.php';

class People {

	private $_id;
	private $_id_people_type;
	private $_gender;
	private $_last_name;
	private $_first_name;
	private $_phone;
	private $_email;
	
	private $_pdo;


	
	//Constructor-Destructor
	public function __construct($id=0){
		$this->_pdo = ConnexionPDO::getInstance();
		if ( !empty( $id ) ) {
			$this->_id = $id;
  	        $this->populate();
  	    }
	}

	public function __destruct( ){

	}

	public function init($id_people_type, $gender, $last_name, $first_name, $phone, $email){
		$this->_id_people_type = $id_people_type;
		$this->_gender = $gender;
		$this->_last_name = $last_name;
		$this->_first_name = $first_name;
		$this->_phone = $phone;
		$this->_email = $email;

	}

	public function populate(){
    	$q = $this->_pdo->query('SELECT * FROM people WHERE id="'.$this->_id.'" ');
    	$data = $q->fetch();

		$this->_id_people_type=$data['id_people_type'];
		$this->_gender=$data['gender'];
		$this->_last_name=$data['last_name'];
		$this->_first_name=$data['first_name'];
		$this->_phone=$data['phone'];
		$this->_email=$data['email'];
	}	

	//=========================================================================
	//GET
	//=========================================================================
	public function get_id(){
		return $this->_id;
	}
	
	public function get_id_people_type(){
			return $this->_id_people_type;
	}
	
	public function get_gender(){
			return $this->_gender;
	}
	
	public function get_last_name(){
		return $this->_last_name;
	}

	public function get_first_name(){
		return $this->_first_name;
	}
	
	public function get_phone(){
			return $this->_phone;
	}
	
	public function get_email(){
			return $this->_email;
	}
	
	public function get_full_name() {
			return $this->_first_name.' '.$this->_last_name;
	}
	
	public function get_peoples( $query = 0,$type=0){
		$req='SELECT * FROM people';
		if(!empty($query)){
			$req .=' WHERE 	last_name LIKE "%'.$query.'%" OR
					first_name LIKE "%'.$query.'%" OR
					phone LIKE "%'.$query.'%" OR
					email LIKE "%'.$query.'%"';
		}
		$req .=' ORDER BY last_name, first_name';
		$q = $this->_pdo->query($req);
	    	$data = $q->fetchAll();
	
		return $data;
	}

	public function get_drivers(){
		$req='SELECT * FROM people WHERE id_people_type=4';
		$q = $this->_pdo->query($req);
	    	$data = $q->fetchAll();


		return $data;
	}

	public function get_type_people($people_type){
		$req='SELECT * FROM people_type WHERE id='.$people_type;
	    $q = $this->_pdo->query($req);
	    $data = $q->fetchAll();
	
		return $data;
	}
	
	public function get_people_types(){
		$req='SELECT * FROM people_type';
		$q = $this->_pdo->query($req);
	    $data = $q->fetchAll();
	
		return $data;
	}

	public function get_id_company_by_name($name){
		$req = $this->_pdo->query('SELECT id FROM company WHERE name="'.$name.'"');
		$data = $req->fetchAll();
		return $data[0];
	}
	
	public function get_drive_ids_by_driver_id($id_people){
		$req = $this->_pdo->query('SELECT id FROM drive WHERE id_driver='.$id_people.' ');
		$data = $req->fetchAll();
		return $data;
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
	
	public function set_id_people_type($idPeopleType){
		$this->_id_people_type = $idPeopleType;
	}
	
	public function set_gender($gender){
		$this->_gender = $gender;
	}
	
	public function set_last_name($lastName){
		$this->_last_name = $lastName;
	}

	public function set_first_name($firstName){
		$this->_first_name = $firstName;
	}
	
	public function set_phone($phone){
		$this->_phone = $phone;
	}
	
	public function set_email($email){
		$this->_email = $email;
	}
	
	//=========================================================================
	//OTHERS
	//=========================================================================
	
	public function save(){
		try{
			$id = $this->get_id();
			// id du constructeur vide
			if(empty($id)){
				
				$req = $this->_pdo->prepare('INSERT INTO people (`id`, `id_people_type`, `gender`, `last_name`, `first_name`, `phone`, `email`)		
						VALUES ( :id, :idPeopleType, :gender, :lastName, :firstName, :phone, :email)');

					$req->execute(array(
						':id' => '',
						':idPeopleType' => $this->get_id_people_type(),
						':gender' => $this->get_gender(),
						':lastName' => $this->get_last_name(),
						':firstName' => $this->get_first_name(),
						':phone' => $this->get_phone(),
						':email' => $this->get_email()
					));
			}
			// $id du constructeur rempli
			else{
				$q = $this->get_pdo()->query('SELECT id FROM people');
				$defined = 0;
				while($data = $q->fetch() AND $defined == 0){

					if($data['id'] ==  $this->get_id()){
						$req = $this->_pdo->prepare('UPDATE people SET
							id_people_type = :idPeopleType,
							gender = :gender,
							last_name = :lastName,
							first_name = :firstName,
							phone = :phone,
							email = :email
							WHERE id='.$this->get_id()
						);
	
						$req->execute(array(
							':idPeopleType'=> $this->get_id_people_type(),
							':gender' => $this->get_gender(),
							':lastName'=> $this->get_last_name(),
							':firstName'=> $this->get_first_name(),
							':phone'=> $this->get_phone(),
							':email'=> $this->get_email()
						));
						$defined = 1;
					}
				}
				if($defined == 0){ 

					$req = $this->_pdo->prepare('INSERT INTO people (`id`, `id_people_type`, `gender`, `last_name`, `first_name`, `phone`, `email`)		
						VALUES ( :id, :idPeopleType, :gender, :lastName, :firstName, :phone, :email)');

					$req->execute(array(
						':id' => $this->get_id(),
						':idPeopleType' => $this->get_id_people_type(),
						':gender' => $this->get_gender(),
						':lastName' => $this->get_last_name(),
						':firstName' => $this->get_first_name(),
						':phone' => $this->get_phone(),
						':email' => $this->get_email()
					));

				}
			}
		}	
		catch(Exception $e){
			echo $e->getMessage();
		}
	}	
	
	public function delete(){
		$id_drive = $this->get_drive_ids_by_driver_id($this->_id);
		foreach($id_drive as $an_id){
				$drive = new Drive($an_id[id]);
				$drive->set_id_driver(null);
				$drive->save();

				$id_run = get_run_by_id_run_car($an_id[id]);
				$run = new Run($id_run[0]);
				$run->set_calle(0);
				$run->save();				
		}
		if(!empty($this->_id)){
			try{
				$count = $this->get_pdo()->exec('DELETE FROM people WHERE id='.$this->_id); 
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}

	public function get_all_id_name_company(){
		$req = $this->_pdo->query('SELECT id, name FROM company');
		return $req->fetchAll();
	}

	public function get_all_id_name_driver($tri){
		$str_req = 'SELECT id, last_name, first_name FROM people WHERE id_people_type = (SELECT id FROM people_type WHERE UPPER(type)="CHAUFFEUR")';
		if ($tri==1) {$str_req .= ' ORDER BY last_name, first_name';}
		$req = $this->_pdo->query($str_req);
		return $req->fetchAll();
	}
	public function get_all_id_name_driver_with_run($tri){
		$str_req = 'SELECT distinct people.id, last_name, first_name FROM people inner join drive on (people.id=drive.id_driver) WHERE id_people_type = (SELECT id FROM people_type WHERE UPPER(type)="CHAUFFEUR")';
		if ($tri==1) {$str_req .= ' ORDER BY last_name, first_name';}
		$req = $this->_pdo->query($str_req);
		return $req->fetchAll();
	}
}
?>
