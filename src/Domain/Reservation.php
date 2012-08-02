<?php
require_once("Database.php");

class Reservation{

	private $db;
        private $id;

	public function Reservation ($valuesToInsert){
            $this->db = new Database();
            //print_r($valuesToInsert);
            foreach($valuesToInsert as $coluna => $valor){
                    $colunas .= $coluna.',';
                    $valores .= "'{$valor}'".',';
            }
            $colunas = substr($colunas,0,-1);
            $valores = substr($valores,0,-1);
            $this->db->SQLInsert('reserva', $colunas, "{$valores}");
            $this->id = $this->db->getLastId();
	}
        
        
        public function setReservationExtas ($valuesToInsert){
		//print_r($valuesToInsert);
            //$this->db = new Database();
            $this->db->beginTransaction();
            
            $colunas = "id_reserva, id_extra, valor";
            
            foreach($valuesToInsert as $valor){
                    $valores .= "'{$this->id}','{$valor['id_extra']}','{$valor['valor_extra']}'";
                    $this->db->SQLInsert('extras_reserva', $colunas, "{$valores}");
            }
            
            $this->db->commit();
            
            	
	}
        
        

}