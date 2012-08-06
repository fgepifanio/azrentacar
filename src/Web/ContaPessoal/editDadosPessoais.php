<?php
include ('../Interface.php');
include ('../../Services/ListDadosPessoais.php');
include_once ('../../../config.php');



	try {
$dados = new ListDadosPessoais($_SESSION['userID']);
$dadosPessoais = $dados->getDados();
WebInterface::CarregaCampos($dadosPessoais);
$condutorInfo = $dados->getCondutorInfo();
WebInterface::CarregaCampos($condutorInfo);


	} catch ( exception $e ) {
		WebInterface::drawError ( $e->getMessage () );
	echo "<script>scroll(0,0);</script>";
	}

if ($_POST ['submited']) {
	include ('../../Services/EditCliente.php');
	$_POST['id'] = $_SESSION['userID'];
	try {
		$create = new EditCliente ( $_POST );
                WebInterface::drawSucess ( $create->message );
                echo "<script>scroll(0,0);</script>";
                die();
	} catch ( exception $e ) {
	WebInterface::drawError ( $e->getMessage () );
	
	}

}


?>
<script src='src/Web/ContaPessoal/editDadosPessoais.js'></script>
<div class="container-fluid"
	style="padding-left: 0px; padding-right: 0px;">
<div class="container-fluid"
	style="padding-left: 0px; padding-right: 0px;">
<div class="row-fluid">
<form id='editDadosPessoais'>

<div class="span6">
<div class='title'>Dados da conta</div>
<div class='well'>
<table class='table table-1stcolright' width='100%'>
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
		<input type='radio' name='cond_condutor' id ='cond_condutor1' <?php if(!empty($condutorInfo)){ echo "checked='checked'";}?> value='1'  onclick="$('#CondutorInfo').css('display','')" ><label for='cond_condutor1'>Sim</label>
		<input type='radio' name='cond_condutor'  id='cond_condutor2' value='0' onclick="$('#CondutorInfo').css('display','none')" ><label for='cond_condutor2'>Não</label>
		</div>
		</td>
	</tr>
</table>
<div  id='CondutorInfo' <?php if(empty($condutorInfo)){?> style='display:none' <?php } ?> >
<?php echo WebInterface::$clientForms->drawDadosCondutor($condutorInfo);?>

</div>

</div>

</div>

<div class="span6">
<input type='hidden' id='cond_id_condutor' name='cond_id_condutor' />
<?php 
echo WebInterface::$clientForms->drawDadosPessoaisForm();
?>

</div>

<input type='hidden' id='submited' name='submited' value='1' /> 
<button type='button' id='registClient' class="btn btn-large btn-primary" style='float:right'
	value='Registar' style='height: 35px'
	onclick="if($('#editDadosPessoais').valid()){postAjax('src/Web/ContaPessoal/editDadosPessoais.php',$('#editDadosPessoais').serialize())}">
Alterar </button>
</form>
</div>
</div>
<br>