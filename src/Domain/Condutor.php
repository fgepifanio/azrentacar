<?php
require_once("Database.php");
require_once("Gestor.php");

class Condutor{

    private  $db;
    private $id;
    public function Condutor ($valuesToInsert){
        $this->db = Gestor::getConnection();
		
        if(!isset($valuesToInsert['id_cliente'])){
            throw new Exception('Não foi possível associar o condutor ao cliente');}

        if(!isset($valuesToInsert['num_carta'])){ 
            throw new Exception('O condutor terá que ter uma carta');
        }
		
	foreach ( $valuesToInsert as $coluna => $valor ) {
		
            if(substr($coluna,0,9)!='cat_carta'){
                if($coluna=="condutor")
                    $coluna = "id";
                $colunas .= $coluna . ',';
                $valores .= "'{$valor}'" . ',';
            }
	}
		
        $categorias =  Gestor::getCategoriasCarta();

        $colunas = substr($colunas,0,-1);
        $valores = substr($valores,0,-1);

        $this->db->SQLInsert('condutor', $colunas, "{$valores}");	
        $this->id = $this->db->getLastId();
        foreach($categorias as $index => $categoria){
            $cat = $categoria['categoria'];
            if(isset($valuesToInsert['cat_carta'.$cat]) && !empty($valuesToInsert['cat_carta'.$cat])){
                $this->gravaCategoriasCondutor($valuesToInsert['cat_carta'.$cat], $valuesToInsert['cat_carta'.$cat.'_data']);
            }
        }
    }
		
    private function gravaCategoriasCondutor($idCategoria,$data){
        $this->db->SQLInsert('condutor_categorias_carta', 'id_condutor,id_categoria,data_emissao', "$this->id,$idCategoria, '{$data}'");
    }	

    public function getId(){
        return $this->id;
    }	

}