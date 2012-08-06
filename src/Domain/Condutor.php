<?php
require_once ("Database.php");
require_once ("Gestor.php");

class Condutor {
	
	private $db;
	private $id;
	private $condutor_info;
	
	public function Condutor($valuesToInsert, $alreadyInDb = false) {
		$this->db = Gestor::getConnection ();
		
		if (! isset ( $valuesToInsert ['id_cliente'] )) {
			throw new Exception ( 'Não foi possível associar o condutor ao cliente' );
		}
		
		if (! isset ( $valuesToInsert ['num_carta'] )) {
			throw new Exception ( 'O condutor terá que ter uma carta' );
		}
		
		$this->condutor_info = $valuesToInsert;
		unset($this->condutor_info['id_condutor']);
		if ($alreadyInDb) {
			$this->id = $valuesToInsert ['id_condutor'];
		} else {
			foreach ( $valuesToInsert as $coluna => $valor ) {
				
				if (substr ( $coluna, 0, 9 ) != 'cat_carta') {
					if ($coluna == "condutor")
						$coluna = "id";
					$colunas .= $coluna . ',';
					$valores .= "'{$valor}'" . ',';
				}
			}
			
			$categorias = Gestor::getCategoriasCarta ();
			
			$colunas = substr ( $colunas, 0, - 1 );
			$valores = substr ( $valores, 0, - 1 );
			
			$this->db->SQLInsert ( 'condutor', $colunas, "{$valores}" );
			$this->id = $this->db->getLastId ();
			foreach ( $categorias as $index => $categoria ) {
				$cat = $categoria ['categoria'];
				if (isset ( $valuesToInsert ['cat_carta' . $cat] ) && ! empty ( $valuesToInsert ['cat_carta' . $cat] )) {
					$this->gravaCategoriasCondutor ( $valuesToInsert ['cat_carta' . $cat], $valuesToInsert ['cat_carta' . $cat . '_data'] );
				}
			}
		}
	}
	
	private function gravaCategoriasCondutor($idCategoria, $data) {
		$this->db->SQLInsert ( 'condutor_categorias_carta', 'id_condutor,id_categoria,data_emissao', "$this->id,$idCategoria, '{$data}'" );
	}
	
	
	public function updateData() {
		print_r ( $this->condutor_info );
		foreach ( $this->condutor_info as $coluna => $valor ) {
			
			if (substr ( $coluna, 0, 9 ) != 'cat_carta' && $coluna != 'condutor') {
				$updateInfo .= "$coluna = '{$valor}' ,";
			}
		
		}
		$updateInfo = substr ( $updateInfo, 0, - 1 );
		$this->db->SQLDelete ( 'condutor_categorias_carta', 'id_condutor=' . $this->id );
		if ($this->condutor_info ['condutor']) {
			$this->db->sqlUpdate ( 'condutor', $updateInfo, 'id=' . $this->id );
				$categorias = Gestor::getCategoriasCarta ();
			foreach ( $categorias as $index => $categoria ) {
				$cat = $categoria ['categoria'];
				if (isset ($this->condutor_info['cat_carta' . $cat] ) && ! empty ( $this->condutor_info['cat_carta' . $cat] )) {
					$this->gravaCategoriasCondutor ( $this->condutor_info ['cat_carta' . $cat], $this->condutor_info ['cat_carta' . $cat . '_data'] );
				}
			}
		}else{
			$this->db->SQLDelete ( 'condutor', 'id=' . $this->id );
		}
	
	}
	public function getId() {
		return $this->id;
	}

}