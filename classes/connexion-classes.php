<?php
	class ConnexionPDO{
		
		private static $_pdo;

		public function __construct(){
			$_pdo=$this->get_pdo();
		}

		public function execute($sql, $data = array()){
			$req = $this->pdo->query($sql);
			$req->execute($data);
			return $req->fetchAll(PDO::FETCH_OBJ);
		}

		public function deconnexion(){
			$this->pdo = null;		
		}
		
		public function get_pdo(){
			try{
				$obj_pdo=$this->pdo = new PDO('mysql:host=localhost;dbname=carl500_new_v1', 'root', '');
				$obj_pdo->setattribute(PDO::ATTR_PERSISTENT, true);
				$obj_pdo->setAttribute(PDO::ATTR_TIMEOUT, 300);
				$obj_pdo->exec("SET CHARACTER SET utf8");

			}catch(Exception $e){
				echo 'Une erreur est survenue';
				die('Erreur : '.$e->getMessage());
			}
			return $obj_pdo;
		}
		
		public static function getInstance(){
			$obj= new ConnexionPDO();
			return $obj->get_pdo();
		}
	}
?>
