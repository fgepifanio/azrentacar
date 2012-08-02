<?php
require('../Domain/Gestor.php');
include_once ('../../config.php');

$newUser = Gestor::checkCliente($_POST['username']);


if(!(empty($newUser))){
	echo false;
}else{ 
	echo true;
}

?>