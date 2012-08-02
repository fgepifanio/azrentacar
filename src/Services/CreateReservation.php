<?php
require('../Domain/Reservation.php');
require('../Domain/Gestor.php');
class CreateReservation {
    private $reservation;
    public function CreateReservation($dados){
        $dbData = $dados;
        
        $dbData['minutos_levantamento'] = ($dados['minutos_levantamento']=="")? '00': $dados['minutos_levantamento'];
        
        if($dados['local_igual']==1){$data['local_entrega'] = $data['local_levantamento'];}
        
        $dbData['minutos_entrega'] = ($dados['minutos_entrega']=="")? '00': $dados['minutos_entrega'];
    
        $this->reservation =  new Reservation($dbData);	
        $this->reservation->setReservationExtas($dbData);

    }

	
}