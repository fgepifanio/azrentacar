<?php

require('../Domain/Gestor.php');
require('Interface.php');
include_once ('../../config.php');

$newUser = Gestor::getClienteByUsername($_POST['username'], $_POST['password']);

if(!(empty($newUser))){
    try{
        $clientInfo =  $newUser->getClientInfo();
        $_SESSION['login'] = 1;
        $_SESSION['userID'] = $newUser->getId();
        $_SESSION['username'] = $clientInfo['username'];
        $_SESSION['name'] = $clientInfo['nome'];
        $explodeName = explode(' ',trim($clientInfo['nome']));
        $_SESSION['shortName'] = $explodeName[0];
        $_SESSION['administrador'] = $newUser->existPerfil(1);
    }catch (Exception $e){
        WebInterface::drawError($e->getMessage());	
        die();
    }
    echo "<script>window.location = 'index.php'</script>";
}else{ 
    WebInterface::drawError('O username e/ou password está incorrecto!');
}