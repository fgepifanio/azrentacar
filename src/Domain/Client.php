<?php
require_once ("Database.php");
require_once ("Gestor.php");
class Client {
	
	private $db;
	private $id;
	private $clientInfo;
	
	public function Client($valuesToInsert, $alreadyInDatabase = false) {
		$this->db = gestor::getConnection ();
		$this->clientInfo = $valuesToInsert;
		unset ( $this->clientInfo ['id'] );
		if ($alreadyInDatabase) {
			$this->id = $valuesToInsert ['id'];
		
		} else {
			
			//print_r($valuesToInsert);
			foreach ( $valuesToInsert as $coluna => $valor ) {
				$colunas .= $coluna . ',';
				$valores .= "'{$valor}'" . ',';
			}
			
			$colunas = substr ( $colunas, 0, - 1 );
			$valores = substr ( $valores, 0, - 1 );
			$this->db->SQLInsert ( 'cliente', $colunas, "{$valores}" );
			$this->id = $this->db->getLastId ();
		}
	}
	
	public function updatePassword($password) {
		$this->db->SQLUpdate ( 'cliente', "password = '{$password}'", "id = {$this->id}" );
	}
	
	public function getCondutores() {
		$temp = $this->db->SQLSelect ( array ('*' ), array ('condutor' ), array ('id_cliente=' . $this->id ) );
		foreach ( $temp as $id => $rest ) {
			$id_condutor = $rest ['id'];
			if ($id_condutor != '') {
				$condutores [$id] ['cond_id_condutor'] = $id_condutor;
				$condutores [$id] ['cond_num_carta'] = $rest ['num_carta'];
				unset ( $rest ['id'] );
				unset ( $rest ['num_carta'] );
				foreach ( $rest as $coluna => $valor ) {
					$condutores [$id] [$coluna] = $valor;
				}
				$temp = $this->db->SQLSelect ( array ('c.data_emissao, ca.categoria ' ), array ('condutor_categorias_carta c , categoria_carta ca ' ), array ('ca.id = c.id_categoria and id_condutor=' . $id_condutor ) );
				foreach ( $temp as $index => $valores ) {
					$condutores[$id]['cond_cat_carta' . $valores ['categoria']] = 1;
					$condutores[$id]['cond_cat_carta' . $valores ['categoria'] . '_data'] = $valores ['data_emissao'];
				}
			}
		}
		return $condutores;
	}
	public function getMyCondutorInfo() {
		$temp = $this->db->SQLSelect ( array ('id,num_carta' ), array ('condutor' ), array ('id_cliente=' . $this->id . " and (nome = '' or nome is null)" ) );
		$id_condutor = $temp [0] ['id'];
		if ($id_condutor != '') {
			$condutores ['cond_id_condutor'] = $id_condutor;
			$condutores ['cond_num_carta'] = $temp [0] ['num_carta'];
			$temp = $this->db->SQLSelect ( array ('c.data_emissao, ca.categoria ' ), array ('condutor_categorias_carta c , categoria_carta ca ' ), array ('ca.id = c.id_categoria and id_condutor=' . $id_condutor ) );
			foreach ( $temp as $index => $valores ) {
				$condutores ['cond_cat_carta' . $valores ['categoria']] = 1;
				$condutores ['cond_cat_carta' . $valores ['categoria'] . '_data'] = $valores ['data_emissao'];
			}
		} else {
			$condutores = '';
		}
		return $condutores;
	}
	public function updateData() {
		
		foreach ( $this->clientInfo as $coluna => $valor ) {
			$update .= "{$coluna} = '{$valor}',";
		}
		
		$update = substr ( $update, 0, - 1 );
		$this->db->SqlUpdate ( 'cliente', $update, 'id=' . $this->id );
	
	}
	
	public function getPerfis() {
		$perfis = $this->db->SQLSelect ( array ('*' ), array ('perfis_cliente' ), array ('id_cliente=' . $this->id ) );
		return $perfis;
	}
	
	public function existPerfil($id_perfil) {
		$perfil = $this->db->SQLSelect ( array ('*' ), array ('perfis_cliente' ), array ('id_cliente=' . $this->id . ' and perfil=' . $id_perfil ) );
		
		if (! empty ( $perfil [0] ['perfil'] )) {
			return 1;
		} else {
			return 0;
		}
	}
	
	public function getClientInfo() {
		return $this->clientInfo;
	}
	
	public function getId() {
		return $this->id;
	}

}