<?php

/**
 * Feature name:  CARL 500 car-classes
 * Description:   Class de création/modification d'objets car
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

//include './connexion-classes.php';

class Car {

	private $_id;
	private $_type;
	private $_immat;
	private $_manufacturer;
	private $_model;
	private $_capacity;
	private $_color;
	private $_conso_essence;
	private $_CO2;
	private $_comments;
	
	/*Constructor
	 */
	public function __construct( $id=0){
		$this->_pdo = ConnexionPDO::getInstance();
		if ( !empty( $id ) ) {
			$this->_id = $id;
  		        $this->populate();
  	    	}
	}

	/**
	*	This function set all the value of a non set value object
	*/
	public function init($type, $immat, $manufacturer, $model, $capacity, $color, $conso_essence, $CO2, $comments){
		$this->_type = $type;
		$this->_immat = $immat;
		$this->_manufacturer = $manufacturer;
		$this->_model = $model;
		$this->_capacity = $capacity;
		$this->_color = $color;
		$this->_conso_essence = $conso_essence;
		$this->_CO2 = $CO2;
		$this->_comments = $comments;
	}

	/**
	*	This function search in data base and set all the value of the object with the id corresponding
	*/
	public function populate(){
    		$q = $this->_pdo->query('SELECT * FROM car WHERE id='.$this->_id);
    		$data = $q->fetch();

		$this->_type = $data['type'];
		$this->_immat = $data['immat'];
		$this->_manufacturer = $data['manufacturer'];
		$this->_model = $data['model'];
		$this->_capacity = $data['capacity'];
		$this->_color = $data['color'];
		$this->_conso_essence = $data['conso_essence'];
		$this->_CO2 = $data['CO2'];
		$this->_comments = $data['comments'];
	}
	
	//=========================================================================
	//GET
	//=========================================================================

	/**
	 *	@return the id of this object
	 */
	public function get_id(){
		return $this->_id;
	}

	/**
	 *	@return the type of this object
	 */
	public function get_type(){
		return $this->_type;
	}

	
	/**
	 *	@return the id of this object
	 */
	public function get_immat(){
		return $this->_immat;
	}

	
	/**
	 *	@return the id of this object
	 */
	public function get_manufacturer(){
		return $this->_manufacturer;
	}

	
	/**
	 *	@return the id of this object
	 */
	public function get_model(){
		return $this->_model;
	}

	
	/**
	 *	@return the id of this object
	 */
	public function get_capacity(){
		return $this->_capacity;
	}

	
	/**
	 *	@return the id of this object
	 */
	public function get_color(){
		return $this->_color;
	}
	
	
	/**
	 *	@return the id of this object
	 */
	public function get_conso_essence(){
		return $this->_conso_essence;
	}

	
	/**
	 *	@return the id of this object
	 */
	public function get_CO2(){
		return $this->_CO2;
	}

	
	/**
	 *	@return the id of this object
	 */
	public function get_comments(){
		return $this->_comments;
	}

	
	/**
	 *	@return the id of this object
	 */
	public function get_pdo(){
		return $this->_pdo;
	}

	
	/**
	 *	@return the id of this object
	 */
	public function get_cars($query){
		$req='SELECT * FROM car';
		if(!empty($query)){
			$req .=' WHERE type LIKE "%'.$query.'%" OR
                                       immat LIKE "%'.$query.'%" OR
                                       manufacturer LIKE "%'.$query.'%" OR
                                       model LIKE "%'.$query.'%" OR
                                       color LIKE "%'.$query.'%" OR
                                       capacity LIKE "%'.$query.'%" ';
                }
		$req.=' ORDER BY model';
		$q = $this->_pdo->query($req);
		$data = $q->fetchAll();
		return $data;
	}
	
	//=========================================================================
	//SET
	//=========================================================================

	public function set_type($type){
		$this->_type = $type;
	}

	public function set_immat($immat){
		$this->_immat = $immat;
	}

	public function set_manufacturer($manufacturer){
		$this->_manufacturer = $manufacturer;
	}

	public function set_model($model){
		$this->_model = $model;
	}

	public function set_capacity($capacity){
		$this->_capacity = $capacity;
	}

	public function set_color($color){
		$this->_color = $color;
	}
	
	public function set_conso_essence($consoEssence){
		$this->_conso_essence = $consoEssence;
	}
	public function set_CO2($CO2){
		$this->_CO2 = $CO2;
	}
	public function set_comments($comments){
		$this->_comments = $comments;
	}

	//=========================================================================
	//OTHERS
	//=========================================================================
	
	public function save(){
		try{
			$id = $this->get_id();
			// id du constructeur vide
			if(empty($id)){
				
				$req = $this->_pdo->exec('INSERT INTO car VALUES ("",
										"'.$this->get_type().'",
										"'.$this->get_immat().'",
										"'.$this->get_manufacturer().'", 
										"'.$this->get_model().'",
										"'.$this->get_capacity().'", 
										"'.$this->get_color().'",
										"'.$this->get_conso_essence().'",
										"'.$this->get_CO2().'",
										"'.$this->get_comments().'")');
			
				
			}
			// $id du constructeur rempli
			else{
				$q = $this->get_pdo()->query('SELECT id FROM car');
				$defined = 0;
				while($data = $q->fetch()){

					if($data['id'] ==  $this->get_id()){

						$req = $this->_pdo->prepare('UPDATE car SET
							type = :type,
							immat = :immat,
							manufacturer = :manufacturer,
							model = :model,
							capacity = :capacity,
							color = :color,
							conso_essence = :consoEssence,
							CO2 = :CO2,
							comments = :comments
							WHERE id='.$this->get_id()
						);
	
						$req->execute(array(
							':type'=> $this->get_type(),
							':immat' => $this->get_immat(),
							':manufacturer'=> $this->get_manufacturer(),
							':model'=> $this->get_model(),
							':capacity'=> $this->get_capacity(),
							':color'=> $this->get_color(),
							':consoEssence'=> $this->get_conso_essence(),
							':CO2'=> $this->get_CO2(),
							':comments'=> $this->get_comments()
						));
						$defined = 1;
					}
				}
				if($defined == 0){ 

					$req = $this->_pdo->exec('INSERT INTO car VALUES (
										"'.$this->get_id().'",
										"'.$this->get_type().'",
										"'.$this->get_immat().'",
										"'.$this->get_manufacturer().'", 
										"'.$this->get_model().'",
										"'.$this->get_capacity().'", 
										"'.$this->get_color().'",
										"'.$this->get_conso_essence().'",
										"'.$this->get_CO2().'",
										"'.$this->get_comments().'")');

				}
			}
	}
		catch(Exception $e){
			$e->getMessage();
		}
	}

	/**
	 *  	Delete this object from the database, but not from the application
	 *	@
	 */
	public function delete(){

		if(!empty($this->_id)){
			try{
				$count = $this->get_pdo()->exec('DELETE FROM car WHERE id='.$this->_id); 
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}

	}
	
	/**
	 *	@return the ids from run containing the specific band id entered inthe parameter
	 */


	public function get_all_id_name_car($tri){
		$str_req = 'SELECT id, model, manufacturer FROM car';
		if ($tri==1) {$str_req .= ' ORDER BY manufacturer, model';}
		$req = $this->_pdo->query($str_req);
		return $req->fetchAll();
	}
	
	public function get_all_car_types(){
		$str_req = 'SELECT DISTINCT type FROM car ORDER BY type ASC';
		$req = $this->_pdo->query($str_req);
		return $req->fetchAll();
	}

}
?>
