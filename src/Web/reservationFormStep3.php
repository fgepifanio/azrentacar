<?php require_once('../Domain/Gestor.php'); require_once('Interface.php'); include_once ('../../config.php');?>
<form id="reservationStep3">
<div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
    <div class="row-fluid">
        <div class='span12 title'>Resumo Reserva</div>
        <div class="span1"></div>
        <div class="span10 well" style="margin-left: 0px;">
            <div class="span5 " style="padding-top: 0px;">
                <h2><?php echo $_REQUEST['descriptionCar'.$_REQUEST['idCar']]; ?></h2>
                <img src="img/carro.png" style="height:150px">
                <table align="center" width='90%'>
                    <tr>
                        <td style="font-weight: bold;">Levantamento:</td>
                    </tr>
                    <tr>
                        <td><?php WebInterface::drawPickUpData($_REQUEST); ?></td>
                    </tr>
                    <tr>
                        <td style="font-weight: bold;">Entrega:</td>
                    </tr>
                    <tr>
                        <td><?php WebInterface::drawDeliveryData($_REQUEST); ?></td>
                    </tr>
                </table>
                <?php if('tem extras'){ ?>
                <br>
                <table align="center" width='90%'>
                    <tr>
                        <td style="font-weight: bold;">Extras:</td>
                    </tr>
                    <tr>
                        <td>sdm sdlsd sds dsdj sadj sdjs d</td>
                    </tr>
                </table>
            <?php } ?>
            </div>
            <div class="span1" style="padding-top: 0px;"></div>
            <div class="span6" style="padding-top: 15px;">
                <div class="well" style="border: 2px dashed #fff; background-color: #e3eded">
                    <table class='table table-1stcolright' width='100%'>
                    <tr>
                        <td>Elemento faturavel ............................ Valor</td>
                    </tr>
                </table>
                </div>
            </div>
        </div>
        <div class="span1"></div>
    </div>
    <div style="float:left;text-align: left;"><a onclick="prevStep(3)">< Anterior</a></div>
    <div style="float:right;text-align: right;"><a onclick="finishStep()">Terminar Reserva</a></div>
</div>
</form>