<?php

/**
 * Feature name:  CARL 500 day-classes
 * Description:   Class de création/modification d'objets day
 * Author:        Steve Cotonnec & Antoine Le Douarin & Gwendal Aubert & Tanguy Nicolas
 */

 class Day {

	private $_id;
	private $_libelle;
	private $_shows;
	
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
		$q = $this->_pdo->query('SELECT * FROM Date WHERE id='.$this->get_id());
		$data = $q->fetch();
		if($q != false){ 
			$this->_libelle = $data['libelle'];
			$this->_shows = $data['shows'];
		}
	}

	/**
	*	This function set all the value of a non set value object
	*/
	public function init( $libelle, $shows){
		$this->_libelle = $libelle;
		$this->_shows = $shows;

		$this->_pdo = ConnexionPDO::getInstance();
	}

	public function __destruct( ){

	}

	public function get_id(){
		return $this->_id;
	}

	public function get_libelle(){
		return $this->_libelle;
	}	

	public function get_shows(){
		return $this->_shows;
	}

	public function get_pdo(){
		return $this->_pdo;
	}

	public function get_days(){
	$q = $this->get_pdo()->query('SELECT * FROM date');
		$data = $q->fetchAll();

	return $data;
	}

	//=========================================================================
	//SET
	//=========================================================================

	public function set_id($id){
		$this->_id = $id;
	}

	public function set_libelle($new_lib){
		$this->_libelle = $new_lib;
	}
	
	public function set_shows($new_shows){
		$this->_shows = $new_shows;
	}

}

?>	