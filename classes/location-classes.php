<?php

//include './connexion-classes.php';

class Location {

	private $_id;
	private $_id_location_type;
	private $_name;
	private $_address;
	private $_town;
	private $_zip;
	private $_country;
	private $_phone;
	private $_fax;
	private $_web;

	private $_pdo;

	//Constructor-Destructor
	public function __construct( $id=0){
		$this->_pdo = ConnexionPDO::getInstance();
		if ( !empty( $id ) ) {
			$this->_id = $id;
			$this->populate();
  	    }
	}

	public function init($name, $type, $address, $town, $zip, $country, $phone, $fax, $web){
		$this->_id_location_type = $type;
		$this->_address = $address;
		$this->_name = $name;
		$this->_town = $town;
		$this->_zip = $zip;
		$this->_country = $country;
		$this->_phone = $phone;
		$this->_fax = $fax;
		$this->_web = $web;
	}

	public function populate(){
    	$q = $this->_pdo->query('SELECT * FROM location WHERE id='.$this->_id);
    	$data = $q->fetch();

		$this->_id_location_type = $data['id_location_type'];
		$this->_address = $data['address'];
		$this->_name = $data['name'];
		$this->_town = $data['town'];
		$this->_zip = $data['zip'];
		$this->_country = $data['country'];
		$this->_phone = $data['phone'];
		$this->_fax = $data['fax'];
		$this->_web = $data['web'];
	}

	public function __destruct( ){

	}
	
	//=========================================================================
	//GET
	//=========================================================================

	public function get_id(){
		return $this->_id;
	}

	public function get_id_location_type(){
		return $this->_id_location_type;
	}	

	public function get_address(){
		return $this->_address;
	}

	public function get_name(){
		return $this->_name;
	}

	public function get_town(){
		return $this->_town;
	}	

	public function get_zip(){
		return $this->_zip;
	}

	public function get_country(){
		return $this->_country;
	}	

	public function get_phone(){
		return $this->_phone;
	}

	public function get_fax(){
		return $this->_fax;
	}	

	public function get_web(){
		return $this->_web;
	}
	
	public function get_pdo(){
		return $this->_pdo;
	}
	
	public function get_complete_address() {
		return $this->_address.' '.$this->_zip.' '.$this->_town;
	}
	public function get_locations($query = 0){
		$req='SELECT * FROM location ';
		if(!empty($query)){
			$req .= ' WHERE 	name LIKE "%'.$query.'%" OR
					address LIKE "%'.$query.'%" OR
					town LIKE "%'.$query.'%" OR
					zip LIKE "%'.$query.'%"';
		}
	    	$req .=' ORDER BY name';
			$q = $this->_pdo->query($req);
	    	$data = $q->fetchAll();
	
		return $data;
	}

	public function get_location_types(){
		$req='SELECT * FROM location_type order by type';
	    	$q = $this->_pdo->query($req);
	    	$data = $q->fetchAll();
	
		return $data;
	}
	
	public function get_id_location_by_name($name){
		$q = $this->_pdo->query('SELECT id FROM location WHERE name="'.$name.'"');
		$data = $q->fetchAll();
		return $data[0];
	}
	
	public function get_name_location_type(){
		$req='SELECT * FROM location_type WHERE id='.$this->_id_location_type;
		$q = $this->_pdo->query($req);
	    	$data = $q->fetchAll();
	
		return $data[0]['type'];
	}

	
	//=========================================================================
	//SET
	//=========================================================================
	
	public function set_id_location_type($idLocationType){
		$this->_id_location_type = $idLocationType;
	}	

	public function set_address($address){
		$this->_address = $address ;
	}

	public function set_name($name){
		$this->_name = $name;
	}

	public function set_town($town){
		$this->_town = $town;
	}	

	public function set_zip($zip){
		$this->_zip = $zip;
	}

	public function set_country($country){
		$this->_country = $country;
	}	

	public function set_phone($phone){
		$this->_phone = $phone;
	}

	public function set_fax($fax){
		$this->_fax = $fax;
	}	

	public function set_web($web){
		$this->_web = $web;
	}	
	
	//=========================================================================
	//OTHERS
	//=========================================================================
	
	/**add the run to the database 
	*
	*/
	public function save(){
		try{
			$id = $this->get_id();
			// id du constructeur vide
			if(empty($id)){

				$req = $this->_pdo->prepare('INSERT INTO location (`id`, `id_location_type`, `name`, `address`, `town`, `zip`, `country`, `phone`, `fax`, `web`)		
						VALUES ( :id, :idLocationType, :name, :address, :town, :zip, :country, :phone, :fax, :web)');

				$req->execute(array(
						':id' => '',
						':idLocationType' => $this->get_id_location_type(),
						':name' => $this->get_name(),
						':address' => $this->get_address(),
						':town' => $this->get_town(),
						':zip' => $this->get_zip(),
						':country' => $this->get_country(),
						':phone' => $this->get_phone(),
						':fax' => $this->get_fax(),
						':web' => $this->get_web()
					));
				
			}
			//OK
			// $id du constructeur rempli
			else{
				$q = $this->get_pdo()->query('SELECT id FROM location');
				$defined = 0;
				
				while($data = $q->fetch() AND $defined == 0){

					if($data['id'] ==  $this->get_id()){


						$req = $this->_pdo->prepare('UPDATE location SET
							id_location_type = :idLocationType,
							name = :name,
							address = :address,
							town = :town,
							zip = :zip,
							country = :country,
							phone = :phone,
							fax = :fax,
							web = :web
							WHERE id='.$this->get_id()
						);
	
						$req->execute(array(
							':idLocationType'=>$this->get_id_location_type(),
							':name' => $this->get_name(),
							':address' => $this->get_address(),
							':town' => $this->get_town(),
							':zip' => $this->get_zip(),
							':country' => $this->get_country(),
							':phone' => $this->get_phone(),
							':fax' => $this->get_fax(),
							':web' => $this->get_web()
						));
						
						$defined = 1;
					}
				}
				if($defined == 0){ 
										
					$req = $this->_pdo->prepare('INSERT INTO location (`id`, `id_location_type`, `name`, `address`, `town`, `zip`, `country`, `phone`, `fax`, `web`)		
						VALUES ( :id, :idLocationType, :name, :address, :town, :zip, :country, :phone, :fax, :web)');

					$req->execute(array(
						':id' => '',
						':idLocationType' => $this->get_id_location_type(),
						':name' => $this->get_name(),
						':address' => $this->get_address(),
						':town' => $this->get_town(),
						':zip' => $this->get_zip(),
						':country' => $this->get_country(),
						':phone' => $this->get_phone(),
						':fax' => $this->get_fax(),
						':web' => $this->get_web()
					));
									
				}
			}
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
	}

public function delete(){
		//!\\ si le run n'est pas supprimé, il faut supprimer les clés étrangères avant
		if(!empty($this->_id)){
			try{
				$count = $this->get_pdo()->exec('DELETE FROM location WHERE id='.$this->_id); 
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

	}

	public function get_all_id_name_location(){
		$req = $this->_pdo->query('SELECT id, name FROM location');
		return $req->fetchAll();
	}
}

?>
