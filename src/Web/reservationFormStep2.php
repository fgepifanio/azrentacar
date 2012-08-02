<?php 
require_once('../Domain/Gestor.php'); 
include_once ('../../config.php');
?>
<form id="reservationStep2">
<div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
    <?php 
    $cars = Gestor::getFreeCars();

    $nrPerLine = 2;
    $count = 0;
    $countTotal = 0;
    foreach($cars as $idCar => $car){ 
        if($count==0){?><div class="row-fluid"><?php } ?>
        <div class="span6 well" style="height: 170px;padding:2px;background-color: #97aebe">
            <div class="well" style="background-color: #fff;padding-top: 0px;height: 100px;margin: 2px;">
                <div class="span4" style="padding-top: 0px;height: 130px;">
                    <h2><?php echo $car['brand'].' '.$car['model']; ?></h2>
                    <img src="img/carro.png" style="height:70px">
                    <input type="hidden" id="descriptionCar<?php echo $idCar; ?>" name="descriptionCar<?php echo $idCar; ?>" value="<?php echo $car['brand'].' '.$car['model']; ?>">
                </div>
                <div class="span4" style="font-size: 10px;padding-top: 10px;height: 130px">
                    <table>
                        <tr><td>- <?php echo $car['doors']; ?> Portas</td></tr>
                        <tr><td>- Transmissão <?php echo $car['transmission']; ?></td></tr>
                        <tr><td>- Idade minima: <?php echo $car['minAge']; ?> anos</td></tr>
                    </table>
                </div>
                <div class="span4" style="font-size: 11px;padding-top: 10px;height: 130px">
                    <table>
                        <?php foreach($car['baseExtras'] as $extra){ 
                            echo "<tr><td>- $extra</td></tr>";
                         } ?>
                    </table>
                </div>
                <div align="right">
                    <input type="button" class="btn btn-primary" style='position:relative;height: 100%; bottom: 2px;' value="RESERVAR" onclick="selectCar(2, '<?php echo $idCar; ?>')">
                </div>
            </div>
        </div>
    <?php 
    $count++;
    $countTotal++;
    if($count==$nrPerLine || $countTotal==count($cars)){ $count = 0;?></div><?php } ?>
    <?php } ?>
    <div style="float:left;text-align: left;"><a onclick="prevStep(2)">< Anterior</a></div>
</div>
</form>
