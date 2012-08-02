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
	
	<?php 
	if(empty($condutor['nome'])){?>
		<span class="label label-info">Eu próprio</span> 
	<?php echo $_SESSION['name'];}
	else{
		echo $condutor['nome'];
	}?></td>
	<td><button type='button'>Editar</button></td>
	</tr>
<?php }
?>
</table>
</div>
