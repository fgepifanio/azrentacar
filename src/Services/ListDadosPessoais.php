<?php
require_once('../../Domain/Gestor.php');
class ListDadosPessoais{
private $dados;
private $condutorInfo;
	public function ListDadosPessoais($id_cliente){
		$this->dados = Gestor::getClienteById($id_cliente)->getClientInfo();
		
		$this->condutorInfo =Gestor::getClienteById($id_cliente)->getMyCondutorInfo();

	}
	
 	public function getDados(){
 		return $this->dados;
 	}
	public function getCondutorInfo(){
 		return $this->condutorInfo;
 	}
	
}

?>