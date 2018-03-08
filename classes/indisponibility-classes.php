<?php

/**
 *
 *
 */

//include './connexion-classes.php';

class Indisponibility {

	private $_id;
	private $_id_item;
	private $_id_item_type;
	private $_begin_date;
	private $_end_date;

	private $_pdo ; 

	/**
	 *	Constructor
	 */
	public function __construct($id = 0){
		$this->_pdo = ConnexionPDO::getInstance();
		if(!empty($id)){
			$this->set_id($id);
			$this->populate();
		}			
	}

	/**
	 *	Destructor
	 */
	public function __destruct( ){

	}

	public function init($id_item, $id_item_type, $begin_date, $end_date ){
		$this->_id_item = $id_item;
		$this->_id_item_type = $id_item_type;
		$this->_begin_date = $begin_date;
		$this->_end_date = $end_date;
	}

	public function populate(){
		$q = $this->get_pdo()->query('SELECT * FROM indisponibility WHERE id='.$this->_id);
		$data = $q->fetch();
		
		$this->_id_item = $data['id_item'];
		$this->_id_item_type = $data['id_item_type'];
		$this->_begin_date = $data['begin_date'];
		$this->_end_date = $data['end_date'];
	}
	
	//=========================================================================
	//GET
	//=========================================================================

	public function get_id(){
		return $this->_id;
	}
	public function get_id_item(){
		return $this->_id_item;
	}
	
	public function get_id_item_type(){
		return $this->_id_item_type;
	}
	
	public function get_begin_date(){
		return $this->_begin_date;
	}
	
	public function get_end_date(){
		return $this->_end_date;
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

	public function set_id_item($id_item){
		$this->_id_item = $id_item;
	}
	
	public function set_id_item_type($id_item_type){
		$this->_id_item_type = $id_item_type;
	}
	
	public function set_begin_date($begin_date){
		$this->_begin_date = $begin_date;
	}
	
	public function set_end_date($end_date){
		$this->_end_date = $end_date;
	}

	//=========================================================================
	//OTHERS
	//=========================================================================

	public function save(){
		try{
			$id = $this->get_id();
			// id du constructeur vide
			if(empty($id)){

				//!\\
				//!\\ Aucuns éléments à NULL
				//!\\	
				
				$req = $this->get_pdo()->prepare('INSERT INTO indisponibility ( `id`, `id_item`, `id_item_type`, `begin_date`, `end_date`) VALUES (:id, :iditem, :iditemType, :beginDate, :endDate)');
				$req->execute(array(
					':id' => '',
					':iditem' => $this->get_id_item(), 
					':iditemType' => $this->get_id_item_type(),
					':beginDate' => $this->get_begin_date(),
					':endDate' => $this->get_end_date()
				));
				$insert_id = $this->_pdo->lastInsertId();
			}
			// $id du constructeur rempli
			else{
				$q = $this->get_pdo()->query('SELECT id FROM indisponibility');
				$defined = 0;
				while($data = $q->fetch() AND $defined == 0){

					if($data['id'] ==  $this->get_id()){

						$req = $this->_pdo->prepare('UPDATE indisponibility SET
							id_item = :iditem,
							id_item_type = :iditemType,
							begin_date = :beginDate,
							end_date = :endDate
							WHERE id='.$this->get_id()
						);
	
						$req->execute(array(
							':iditem' => $this->get_id_item(), 
							':iditemType' => $this->get_id_item_type(),
							':beginDate' => $this->get_begin_date(),
							':endDate' => $this->get_end_date()
						));

						$defined = 1;
					}
				}
				if($defined == 0){ 

					$req = $this->get_pdo()->prepare('INSERT INTO indisponibility ( `id`, `id_item`, `id_item_type`, `begin_date`, `end_date`) VALUES (:id, :iditem, :iditemType, :beginDate, :endDate)');
					$req->execute(array(
						':id' => '', 
						':iditem' => $this->get_id_item(), 
						':iditemType' => $this->get_id_item_type(),
						':beginDate' => $this->get_begin_date(),
						':endDate' => $this->get_end_date()
					));
					$insert_id = $this->_pdo->lastInsertId();
				}
			}
		}
		catch(Exception $e){
			echo $e->getMessage();
		}
		return $insert_id;
	}	

	public function indisponibilities($type){
		$req = $this->_pdo->query('SELECT * FROM indisponibility WHERE id_item_type='.$type);
		$data = $req->fetchAll();
		return $data;
	}

	public function delete(){
		if(!empty($this->_id)){
			try{
				$count = $this->get_pdo()->exec('DELETE FROM indisponibility WHERE id='.$this->_id); 
			}
			catch(PDOException $e){
				echo $e->getMessage();
			}
		}
	}

	public function exist(){
		$ret = false;
		$req =$this->get_pdo()->query('SELECT id FROM indisponibility');
		$data = $req->fetchAll();
		while($data = $req->fetch() AND $ret == false ){

			if($this->get_id() == $data[id]){
				$ret = true;
			}
		}
		return $ret;
	}
}
?>
