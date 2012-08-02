<?php 

 include ('../Interface.php');
 include_once ('../../../config.php');


if ($_POST ['submited']) {
WebInterface::CarregaCampos($_POST);	
	
	try {
	 require_once ('../../Services/ChangePassword.php');	
		$create = new ChangePassword (  $_SESSION['userID'],$_POST['password'] );
                WebInterface::drawSucess ( $create->message );
                echo "<script>scroll(0,0);</script>";
                die();
	} catch ( exception $e ) {
		WebInterface::drawError ( $e->getMessage () );
	
	}

}
?>

<script src='src/Web/ContaPessoal/changePassword.js'></script>
<div class='title'>Alterar Password</div>
<div class='well' align='center'>
<form id='changePassForm' name='changePassForm' >
<table class='table table-1stcolright' width='100%'>

	<tr>
		<td><b>Password:</b></td>
		<td><input type='password' id='password' name='password'></td>
	</tr>
	<tr>
		<td><b>Confirme Password:</b></td>
		<td><input type='password' id='password_again' name='password_again'></td>
	</tr>
</table>
<input type='hidden' id='submited' name='submited' value='1' /> 
<button type='button' id='registClient' class="btn btn-large btn-primary" 
	value='Registar' style='height: 35px'
	onclick="if($('#changePassForm').valid()){postAjax('src/Web/ContaPessoal/changePassword.php',$('#changePassForm').serialize())}">
Alterar Password</button>
</form>
</div>