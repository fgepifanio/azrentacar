<?php
include ('../Domain/Gestor.php');
include_once ('../../config.php');
include ('Interface.php');
/*
$_POST['username'] = 'teste';
$_POST['password'] = 'aaa';
$_POST['password_again'] = 'aaa';
$_POST['nome'] = 'David';
$_POST['data_nascimento'] = '2012-07-25';*/
WebInterface::CarregaCampos($_POST);

if ($_POST ['submited']) {
	include ('../Services/CreateCliente.php');
	
	try {
		$create = new CreateCliente ( $_POST );
                WebInterface::drawSucess ( $create->message );
                echo "<script>scroll(0,0);</script>";
                die();
		/**@todo:  confirmação de email, só após fazer login
		 * 
		 */
	} catch ( exception $e ) {
		WebInterface::drawError ( $e->getMessage () );
	
	}

}
?>
<script src='src/Web/registationForm.js'></script>
<div class="container-fluid"
	style="padding-left: 0px; padding-right: 0px;">
<div class="container-fluid"
	style="padding-left: 0px; padding-right: 0px;">
<div class="row-fluid">
<form id='registerForm'>

<div class="span6">
<div class='title'>Dados da conta</div>
<div class='well'>
<table class='table table-1stcolright' width='100%'>
	<tr>
		<td><b>Username:</b></td>
		<td><input type='text' id='username' name='username'></td>
	</tr>
	<tr>
		<td><b>Password:</b></td>
		<td><input type='password' id='password' name='password'></td>
	</tr>
	<tr>
		<td><b>Confirme Password:</b></td>
		<td><input type='password' id='password_again' name='password_again'></td>
	</tr>
	<tr>
		<td><b>Email Principal:</b></td>
		<td>
		<div class='input-prepend'><span class='add-on'>@</span><input
			type='email' id='email' name='email'
			placeholder='exemplo@azrentacar.pt' /></div>
	
	
	<tr>
		<td><b>Email Alternativo:</b></td>
		<td>
		<div class='input-prepend'><span class='add-on'>@</span><input
			type='email' name='email_alt' id='email_alt'
			placeholder='exemplo@azrentacar.pt' /></div>

</table>
</div>

<div class='title'>Dados Condutor</div>
<div class='well'>
<table class='table table-1stcolright' width='100%'>
	<tr>
		<td width='30%'><b>É condutor?</b></td>
		<td>
		<div rel='buttonset'>
		<input type='radio' name='cond_condutor' id ='cond_condutor1' value='1'  onclick="$('#CondutorInfo').css('display','')" ><label for='cond_condutor1'>Sim</label>
		<input type='radio' name='cond_condutor'  id='cond_condutor2' value='0' onclick="$('#CondutorInfo').css('display','none')" ><label for='cond_condutor2'>Não</label>
		</div>
		</td>
	</tr>
</table>
<div  id='CondutorInfo' style='display:none'>
<?php echo WebInterface::$clientForms->drawDadosCondutor();?>

</div>

</div>

</div>

<div class="span6">
<?php 
echo WebInterface::$clientForms->drawDadosPessoaisForm();
?>

</div>
<input type='hidden' id='submited' name='submited' value='1' /> 
<button type='button' id='registClient' class="btn btn-large btn-primary" style='float:right'
	value='Registar' style='height: 35px'
	onclick="if($('#registerForm').valid()){postAjax('src/Web/registationForm.php',$('#registerForm').serialize())}">
Registar </button>
</form>
</div>
</div>
<br>