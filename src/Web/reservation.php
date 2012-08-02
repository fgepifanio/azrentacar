<?php 
require_once('../Domain/Gestor.php'); 
require_once('Interface.php'); 
include_once ('../../config.php');
if(ONLINE!=1){
    include "reservationForm.php"; 
}else{
?>
<div class="hero-unit">
    <p>O sistema de reservas online estará brevemente disponivel.</p>
    <p>Para realizar a sua reserva deve contactar-nos pelo contacto 21 829 77 40 ou pelo email geral@azrentacar.pt</p>
    <?php if(isset($_SESSION['userID'])) echo "<p>Na sua reserva deve referenciar o seu número de cliente: Cliente Nº {$_SESSION['userID']}</p>"; ?>
</div>
<?php
}

?>