<?php
require_once('../Domain/Client.php');
require_once('../Domain/Gestor.php');
require_once('../Domain/Condutor.php');

class CreateCliente {
	private $client;
	private $condutor;
    public $message;
   
	public function CreateCliente($dados){
		       
		unset($dados['submited']);
		        
		foreach($dados as $campo => $valor){
			if (empty($valor)){ unset($dados[$campo]); }
			elseif(substr($campo, 0,5) == 'cond_'){
					unset($dados[$campo]);
				$campo = substr($campo,5);
			   	$condutor[$campo] = $valor;
			
			}   
			    
		}       
		unset($dados['password_again']);
		$dados['password'] = sha1($dados['password']);
		 Gestor::getConnection()->beginTransaction();
		
		$this->client =  new Client($dados);
        $this->message = "O seu registo foi realizado com sucesso.<br> Bem vindo ao AZ Rent-a-car!";
		$condutor['id_cliente'] = $this->client->getId();
		$this->condutor = new Condutor($condutor);	
		Gestor::getConnection()->commit();
	
	}
	



	
}