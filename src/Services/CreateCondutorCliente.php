<?php

require_once('../../Domain/Gestor.php');
require_once('../../Domain/Condutor.php');

class CreateCondutorCliente {
	private $condutor;
    public $message;
   
	public function CreateCondutorCliente($id_cliente,$dados){
		       
		unset($dados['submited']);
		        
		foreach($dados as $campo => $valor){
			if (empty($valor)){ unset($dados[$campo]); }
			elseif(substr($campo, 0,5) == 'cond_'){
					unset($dados[$campo]);
				$campo = substr($campo,5);
			  $condutor[$campo] = $valor;
			} else{
			 	$condutor[$campo] = $valor;
			}
		}       
	
		 Gestor::getConnection()->beginTransaction();
		
		$this->message = "Este condutor foi associado com sucesso à sua conta!";
		$condutor['id_cliente'] = $id_cliente;
		$this->condutor = new Condutor($condutor);	
		Gestor::getConnection()->commit();
	
	}
	



	
}