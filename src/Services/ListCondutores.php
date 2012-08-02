<?php
require_once('../../Domain/Gestor.php');
class ListCondutores{
private $condutores;
	public function ListCondutores($id_cliente){
		$this->condutores = Gestor::getClienteById($id_cliente)->getCondutores();
	}
	
 	public function getCondutores(){
 		return $this->condutores;
 	}
	
}

?>