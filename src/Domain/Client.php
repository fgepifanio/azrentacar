<?php
require_once ("Database.php");
require_once ("Gestor.php");
class Client {
	
	private $db;
	private $id;
	private $clientInfo;
	
	public function Client($valuesToInsert, $alreadyInDatabase = false) {
		$this->db = gestor::getConnection ();
		$this->clientInfo =  $valuesToInsert;
		if ($alreadyInDatabase) {
			$this->id = $valuesToInsert['id'];
			
		}else {
			
			//print_r($valuesToInsert);
			foreach ( $valuesToInsert as $coluna => $valor ) {
				$colunas .= $coluna . ',';
				$valores .= "'{$valor}'" . ',';
			}
			
			$colunas = substr ( $colunas, 0, - 1 );
			$valores = substr ( $valores, 0, - 1 );
			$this->db->SQLInsert ( 'cliente', $colunas, "{$valores}" );
			$this->id = $this->db->getLastId ();
		}
	}
	
	public function updatePassword($password){
		$this->db->SQLUpdate('cliente', "password = '{$password}'", "id = {$this->id}");
	}

	public function getCondutores() {
		$condutores = $this->db->SQLSelect(array('*'),array('condutor'),array('id_cliente='.$this->id));		
		return $condutores;
	}
	public function getMyCondutorInfo(){
		$condutores = $this->db->SQLSelect(array('*'),array('condutor'),array('id_cliente='.$this->id." and (nome = '' or nome is null)"));	

		return $condutores;
	}
	
	public function getPerfis(){
		$perfis = $this->db->SQLSelect(array('*'),array('perfis_cliente'),array('id_cliente='.$this->id));		
		return $perfis;
	}
	
	public function existPerfil($id_perfil){
		$perfil = $this->db->SQLSelect(array('*'),array('perfis_cliente'),array('id_cliente='.$this->id.' and perfil='.$id_perfil));		
		
		if(!empty($perfil[0]['perfil'])){
		return 1;}
		else{return 0;}
	}
	public function getClientInfo(){
		return $this->clientInfo;
	}
	public function getId() {
		return $this->id;
	}

}