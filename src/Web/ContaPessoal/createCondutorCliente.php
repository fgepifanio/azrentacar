<?php 
require_once ('../Interface.php');
include_once ('../../../config.php');

WebInterface::CarregaCampos($_POST);

if ($_POST ['submited']) {
	unset($_POST['submited']);
	include ('../../Services/CreateCondutorCliente.php');
	
	try {
		
		$create = new CreateCondutorCliente ( $_SESSION['userID'],$_POST );
                WebInterface::drawSucess ( $create->message );
                echo "<script>scroll(0,0);</script>";
                die();
	
	} catch ( exception $e ) {
		WebInterface::drawError ( $e->getMessage () );
	
	}

}
?>


<div class='span12'>
<br/>
<ul class="pager pull-left">
  <li>
    <a onclick="getAjax('src/Web/ContaPessoal/CondutoresOptions.php')">Voltar</a>
  </li>
</ul>
<br/>
</div>

<script src='src/Web/ContaPessoal/createCondutor.js'></script>
<div class="container-fluid"
	style="padding-left: 0px; padding-right: 0px;">
<div class="row-fluid">
<form id='createCondutor' name='createCondutor' >
<div class='span6'>
<div class='title'>Dados Carta</div>
<div class='well'>
<?php
echo WebInterface::$clientForms->drawDadosCondutor();
?>
</div>
</div>
<div class='span6'>
<?php
echo WebInterface::$clientForms->drawDadosPessoaisForm('Dados Pessoais do Condutor');
?>
</div>
<input type='hidden' id='submited' name='submited' value='1' /> 
<button type='button' id='registClient' class="btn btn-large btn-primary" style='float:right'
	value='Criar Condutor' style='height: 35px'
	onclick="if($('#createCondutor').valid()){postAjax('src/Web/ContaPessoal/createCondutorCliente.php',$('#createCondutor').serialize())}">
Registar </button>
</form>
</div>
</div>



