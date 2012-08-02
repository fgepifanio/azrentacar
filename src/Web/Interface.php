<?php

class WebInterface {
	public static $generalForms;
	public static $reservationForms;
	public static $clientForms; //Objectos usados em ficheiros que tenham a ver com a conta do cliente
	
	
	
	public function init() {
		self::$generalForms = new GeneralForms ();
		self::$clientForms = new ClientForms ();
		self::$reservationForms = new ReservationForms();
	}
	public static function drawPickUpData($data) { //deverá ir para o reservation forms
		if ($data ['minutos_levantamento'] == "") {
			$data ['minutos_levantamento'] = '00';
		}
		
		$string = $data ['local_levantamento'] . ", " . $data ['data_levantamento'] . " &agrave;s " . $data ['hora_levantamento'] . ":" . $data ['minutos_levantamento'];
		
		echo $string;
	}
	
	public static function drawDeliveryData($data) { //deverá ir para o reservation forms
		if ($data ['local_igual'] == 1) {
			$data ['local_entrega'] = $data ['local_levantamento'];
		}
		if ($data ['minutos_entrega'] == "") {
			$data ['minutos_entrega'] = '00';
		}
		
		$string = $data ['local_entrega'] . ", " . $data ['data_entrega'] . " &agrave;s " . $data ['hora_entrega'] . ":" . $data ['minutos_entrega'];
		
		echo $string;
	}
	
	public static function drawChargingTable($listItems) {
		$string = "<table class='table table-1stcolright' width='100%'>";
		
		$total = 0;
		foreach ( $listItems as $line ) {
			$total += $line ['value'];
			$string .= "<tr><td>{$line['description']} ........................................ {$line['value']}&euro;</td></tr>";
		}
		$string .= "<tr><td>Total: $total&euro;</td></tr></table>";
		echo $string;
	}
	
	public static function CarregaCampos($array) {
		foreach ( $array as $campo => $valor ) {
			?>
<script>
	 $('#<?php
			echo $campo;
			?>').val('<?php
			echo $valor;
			?>');
	</script>
<?php
		}
	}
	public static function drawError($message) {
		?>

<div class='alert alert-error'>
<button class="close" data-dismiss="alert">×</button>	
    	<?php
		echo $message;
		?></div>
<?php
	}
	
	public static function drawWarning($message) {
		?>

<div class='alert alert-block'>
<button class="close" data-dismiss="alert">×</button>
<h4 class="alert-heading">Warning!</h4>
    	<?php
		echo $message;
		?></div>
<?php
	}
	
	public static function drawSucess($message) {
		?>

<div class='alert alert-success'>
<button class="close" data-dismiss="alert">×</button>
<h4 class="alert-heading">Sucesso!</h4>
    	<?php
		echo $message;
		?></div>
<?php
	}

}

//Não consigo fazer "subclasses de outra forma" se souberes uma forma melhor em php altera
WebInterface::init ();

class GeneralForms {
	
	public static function drawIdentificationSelectBox() {
		?>
<select id='tipoIdentificacao' name='tipoIdentificacao'>
	<option value='1'>BI/CC</option>
	<option value='2'>Passaporte</option>
</select>
<input type='text' id='numIdentificacao' name='numIdentificacao'>
<?php
	}
	
	public static function drawLocalSelectBox($id = 'local_levantamento') {
		?>
<select id='<?php
		echo $id;
		?>' name='<?php
		echo $id;
		?>'>
	<option>Aeroporto Lisboa</option>
	<option>Rua 31 ABC</option>
</select>
<?php
	}

}

class ClientForms {
	
	public static function drawDadosCondutor(){?>
		
		<table class='table table-1stcolright' width='100%' >
	<tr>
		<td> <b>Nº Carta Condução:</b> </td>
		<TD> <input type='text' name='cond_num_carta' id='cond_num_carta' />
	</TR>	
	<tr>
		<td width='30%'><b>Que Categorias Possui?</b></td>
		<td>
		<div rel='buttonset'  >
			<input type='checkbox' value='1' name='cond_cat_cartaA1' id='cond_cat_cartaA1' onclick="$('#categoriaA1').toggle()"  /> <label for='cond_cat_cartaA1'>A1</label>
			<input type='checkbox'  value='2' name='cond_cat_cartaA' id='cond_cat_cartaA' onclick="$('#categoriaA').toggle()" ><label for='cond_cat_cartaA'>A</label>
			<input type='checkbox' value='3'  name='cond_cat_cartaB' id='cond_cat_cartaB' onclick="$('#categoriaB').toggle()" ><label for='cond_cat_cartaB'>B</label>
			<input type='checkbox'  value='4' name='cond_cat_cartaC' id='cond_cat_cartaC' onclick="$('#categoriaC').toggle()" ><label for='cond_cat_cartaC'>C</label>
			<input type='checkbox'  value='5' name='cond_cat_cartaD' id='cond_cat_cartaD' onclick="$('#categoriaD').toggle()" ><label for='cond_cat_cartaD'>D</label>
			<input type='checkbox'  value='6' name='cond_cat_cartaBE' id='cond_cat_cartaBE' onclick="$('#categoriaBE').toggle()" ><label for='cond_cat_cartaBE'>BE</label>
			<input type='checkbox' value='7' name='cond_cat_cartaCE' id='cond_cat_cartaCE' onclick="$('#categoriaCE').toggle()" ><label for='cond_cat_cartaCE'>CE</label>
			<input type='checkbox' value='8' name='cond_cat_cartaDE' id='cond_cat_cartaDE' onclick="$('#categoriaDE').toggle()" ><label for='cond_cat_cartaDE'>DE</label>
		</div>
		</td>
	</tr>
	<tr id='categoriaA1' style='display:none' > <td> <b>Data emissão A1:</b> </td>	<td> <input id='cond_cat_cartaA1_data' name='cond_cat_cartaA1_data' type='text' rel='picker' /> </td></tr>
	<tr id='categoriaA' style='display:none' > <td> <b>Data emissão A:</b> </td>	<td> <input id='cond_cat_cartaA_data' name='cond_cat_cartaA_data' type='text' rel='picker' /> </td></tr>
	<tr id='categoriaB' style='display:none' > <td> <b>Data emissão B:</b> </td>	<td> <input id='cond_cat_cartaB_data' name='cond_cat_cartaB_data' type='text' rel='picker' /> </td></tr>
	<tr id='categoriaC' style='display:none' > <td> <b>Data emissão C:</b> </td>	<td> <input id='cond_cat_cartaC_data' name='cond_cat_cartaC_data' type='text' rel='picker' /> </td></tr>
	<tr id='categoriaD' style='display:none' > <td> <b>Data emissão D:</b> </td>	<td> <input id='cond_cat_cartaD_data' name='cond_cat_cartaD_data' type='text' rel='picker' /> </td></tr>
	<tr id='categoriaBE' style='display:none' > <td> <b>Data emissão BE:</b> </td>	<td> <input id='cond_cat_cartaBE_data' name='cond_cat_cartaBE_data' type='text' rel='picker' /> </td></tr>
	<tr id='categoriaCE' style='display:none' > <td> <b>Data emissão CE:</b> </td>	<td> <input id='cond_cat_cartaCE_data' name='cond_cat_cartaCE_data' type='text' rel='picker' /> </td></tr>
	<tr id='categoriaDE' style='display:none' > <td> <b>Data emissão DE:</b> </td>	<td> <input id='cond_cat_cartaDE_data' name='cond_cat_cartaDE_data' type='text' rel='picker' /> </td></tr>
</table>
		
		
	<?php }
	
	public static function drawDadosPessoaisForm($titulo ='Dados Pessoais') {
		?>
			<div class='title'><?php echo $titulo; ?></div>
			<div class='well'>
			<table class='table table-1stcolright' width='100%'>
				<tr>
					<td><b>Nome:</b></td>
					<td><input type='text' style='width: 100%' id='nome' name='nome'></td>
				</tr>
				<tr>
					<td><b>Data Nascimento:</b></td>
					<td><input type='text' id='data_nascimento' name='data_nascimento'
						style='width: 90px' rel='picker'></td>
				</tr>
				<tr>
					<td><b>Morada:</b></td>
					<td><input type='text' style='width: 100%' id='morada' name='morada'></td>
				</tr>
				<tr>
					<td></td>
					<td><input type='text' style='width: 100%' id='morada2' name='morada2'></td>
				</tr>
				<tr>
					<td><b>Localidade:</b></td>
					<td><input type='text' id='localidade' style='width: 100%'
						name='localidade'></td>
				</tr>
				<tr>
					<td><b>Código Postal:</b></td>
					<td><input type='text' style='width: 45px' maxlength='4'
						id='codigo_postal' name='codigo_postal' />-<input type='text'
						maxlength='3' style='width: 30px' id='codigo_postal2'
						name='codigo_postal2' /></td>
				</tr>
				<tr>
					<td><b>Telefone:</b></td>
					<td><input type='text' style='width: 90px' rel='numerico'
						id='telefone' name='telefone'></td>
				</tr>
				<tr>
					<td><b>Telemovel alternativo:</b></td>
					<td><input type='text' style='width: 90px' rel='numerico'
						id='telefone_alt' name='telefone_alt'></td>
				</tr>
				<tr>
					<td><b>Fax:</b></td>
					<td><input type='text' style='width: 90px' rel='numerico' id='fax'
						name='fax'></td>
				</tr>
				<tr>
					<td><b>NIF:</b></td>
					<td><input type='text' style='width: 90px' rel='numerico' id='nif'
						name='nif'></td>
				</tr>
				<tr>
					<td><b>Identificação:</b></td>
					<td>
					<?php
					WebInterface::$generalForms->drawIdentificationSelectBox ();
					?>
					</td>
			
				</tr>
			</table>
			
			</div>
<?php
	}
	

}


class ReservationForms{

}
