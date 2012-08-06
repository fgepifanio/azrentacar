<?php
require_once('../../Domain/Client.php');
require_once('../../Domain/Gestor.php');
require_once('../../Domain/Condutor.php');

class EditCliente {
	private $client;
	private $condutor;
    public $message;
   
	public function EditCliente($dados){
		       
		unset($dados['submited']);
		        
		foreach($dados as $campo => $valor){
			if (empty($valor)){ unset($dados[$campo]); }
			elseif(substr($campo, 0,5) == 'cond_'){
					unset($dados[$campo]);
				$campo = substr($campo,5);
			   	$condutor[$campo] = $valor;
			
			}   
			    
		}       

		 Gestor::getConnection()->beginTransaction();
		
		$this->client =  new Client($dados,true);
        $this->message = "Registo alterado  com sucesso!";
       $this->client->updateData();
		$condutor['id_cliente'] = $this->client->getId();
		 if($this->client->getMyCondutorInfo() == ''){
		 	$this->condutor = new Condutor($condutor);
		 }else{
			$this->condutor = new Condutor($condutor,true);	
		 	$this->condutor->updateData();
		 }
			Gestor::getConnection()->commit();
	
	}
	



	
}