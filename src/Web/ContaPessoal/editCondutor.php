<?php
include ('../Interface.php');
include_once ('../../../config.php');

WebInterface::CarregaCampos($_POST);
print_r($_POST);
if ($_POST ['submited']) {
	include ('../../Services/EditCondutor.php');
	try {
		$create = new EditCondutor ( $_POST );
                WebInterface::drawSucess ( $create->message );
                echo "<script>scroll(0,0);</script>";
                die();
	} catch ( exception $e ) {
	WebInterface::drawError ( $e->getMessage () );
	echo "<script>scroll(0,0);</script>";
	
	}
}
	
?>
<div class='span12'>
<br/>
<ul class="pager pull-left">
  <li>
    <a onclick="getAjax('src/Web/ContaPessoal/listCondutores.php')">Voltar</a>
  </li>
</ul>
<br/>
</div>

<script src='src/Web/ContaPessoal/createCondutor.js'></script>
<div class="container-fluid"
	style="padding-left: 0px; padding-right: 0px;">
<div class="row-fluid">
<form id='editCondutor' name='editCondutor' >
<div class='span6'>
<div class='title'>Dados Carta</div>
<div class='well'>
<?php
echo WebInterface::$clientForms->drawDadosCondutor($_POST);
?>
</div>
</div> 
<?php if(!empty($_POST['nome'])){?>
<div class='span6'>
<?php
echo WebInterface::$clientForms->drawDadosPessoaisForm('Dados Pessoais do Condutor');
?>
</div>
<?php } ?>
<input type='hidden' id='condutor' name='condutor' value='1' />
<input type='hidden' id='cond_id_condutor' name='cond_id_condutor' />
<input type='hidden' id='id_cliente' name='id_cliente' value='<?php echo $_SESSION['userID']; ?>' />
<input type='hidden' id='submited' name='submited' value='1' /> 
<div class='span11'>
<button type='button' id='registClient' class="btn btn-large btn-primary" style='float:right'
	value='Criar Condutor' style='height: 35px'
	onclick="if($('#editCondutor').valid()){postAjax('src/Web/ContaPessoal/editCondutor.php',$('#editCondutor').serialize())}">
Editar </button>
</div>
</form>
</div>
</div>