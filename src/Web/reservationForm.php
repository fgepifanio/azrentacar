<div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
    <div class="row-fluid">
        <div class="span12">
            <div class='well' style="width:95%">
                <table width='100%'>
                    <td>
                        <td width="33%" id="navStep1" class="hover">Dados de Aluguer</td>
                        <td width="33%" id="navStep2">Escolher Ve&iacute;culo</td>
                        <td width="33%" id="navStep3">Reservar Ve&iacute;culo</td>
                    </td>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="passo1" style="width:100%;">
    <form id="reservationStep1" name="reservationStep1">
    <div class="container-fluid" style="padding-left: 0px; padding-right: 0px;">
        <div class="row-fluid">
            <div class="span6">
                <div class='title'>Dados Levantamento</div>
                <div class='well'>
                    <table class='table table-1stcolright' width='100%' style="height: 90px">
                        <tr>
                            <td width="10%" style="vertical-align: middle;">Local:</td>
                            <td colspan="5" style="vertical-align: middle;">
                                <select id="localLevantamento" name="localLevantamento">
                                    <option>Aeroporto Lisboa</option>
                                    <option>Rua 31 ABC</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                    <table class='table table-1stcolright' width='100%'>
                        <tr>
                            <td width="10%">Data:</td>
                            <td width="20%"><input id="dataLevantamento" name="dataLevantamento" type='text' rel='picker' style="width:80%"></td>
                            <td width="10%">Hora:</td>
                            <td width="10%">
                                <input id="horaLevantamento" name="horaLevantamento" type='text' style="width:20px" rel='numerico' maxlength="2">
                            </td>
                            <td width="10%">Minutos:</td>
                            <td>
                                <input id="minutosLevantamento" name="minutosLevantamento" type='text' style="width:20px" rel='numerico' maxlength="2">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="span6">
                <div class='title'>Dados Entrega</div>
                <div class='well'>
                    <table class='table table-1stcolright' width='100%' style="height: 90px;">
                        <tr style="display:none;">
                            <td width="10%" style="vertical-align: middle;">Local:</td>
                            <td colspan="5" style="vertical-align: middle;">
                                <select id="localEntrega" name="localEntrega">
                                    <option>Aeroporto Lisboa</option>
                                    <option>Rua 31 ABC</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6" style="text-align: left;vertical-align: middle;">Entrega no mesmo local &nbsp;
                                <input id="igualLocalEntrega" name="igualLocalEntrega" type="checkbox" checked="true" onchange='$(this).parent().parent().prev().toggle("slow");'>
                            </td>
                        </tr>
                    </table>
                    <table class='table table-1stcolright' width='100%'>
                        <tr>
                            <td width="10%">Data:</td>
                            <td width="20%"><input id="dataEntrega" name="dataEntrega" type='text' rel='picker' style="width:80%"></td>
                            <td width="10%">Hora:</td>
                            <td width="10%">
                                <input id="horaEntrega" name="horaEntrega" type='text' style="width:20px" rel='numerico' maxlength="2">
                            </td>
                            <td width="10%">Minutos:</td>
                            <td>
                                <input id="minutosEntrega" name="minutosEntrega" type='text' style="width:20px" rel='numerico' maxlength="2">
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div style="text-align: right;"><a onclick="nextStep(1)">Seguinte ></a></div>
    </div>
    </form>
</div>
<div id="passo2" style="width:100%;display:none">
</div>
<div id="passo3" style="width:100%;display:none">
</div>