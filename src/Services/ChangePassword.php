<?php 
require_once('../../Domain/Gestor.php') ;
class ChangePassword {
public $message;
	
	function ChangePassword($id_cliente,$password){
		$cliente = Gestor::getClienteById($id_cliente);
		$password = sha1($password);
		$cliente->updatePassword($password);
		$this->message = 'Password alterada com sucesso!';
	}

	
}
?>