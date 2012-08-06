<?php 
require_once('../../Services/ListCondutores.php');
include_once ('../../../config.php');
?>
<div class='well'>
<?php 

$condutores = new ListCondutores($_SESSION['userID']);

$condutores = $condutores->getCondutores();

?>
<ul class="pager pull-left">
  <li>
    <a onclick="getAjax('src/Web/ContaPessoal/condutoresOptions.php')">Voltar</a>
  </li>
</ul>
<table class='table table-bordered' >
<thead>
<th>#</th>
<th>Nome</th>
<th>Editar</th>
</thead>
<?php 
foreach($condutores as $num => $condutor){

	?>
	<tr>
	<td><?php echo $num+1;?></td>
	<td>
	<form id='edit_condutor<?php echo $num;?>' name='edit_condutor<?php echo $num;?>'>
	<?php
	 foreach($condutor as $nome => $valor){?>
	 	
	 	<input type='hidden' id='<?php echo $nome;?>' name='<?php echo $nome;?>' value='<?php echo $valor;?>' />
	 <?php }
	if(empty($condutor['nome'])){

		?>
		<span class="label label-info">Eu próprio</span> 
	<?php echo $_SESSION['name'];}
	else{
		
		echo $condutor['nome'];
	}?>
	</form></td>
	<td><button type='button' onclick="postAjax('src/Web/ContaPessoal/editCondutor.php',$('#edit_condutor<?php echo $num;?>').serialize())">Editar</button></td>
	</tr>
<?php }
?>
</table>
</div>
