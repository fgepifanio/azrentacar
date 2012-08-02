function nextStep(currentStep, url){
    var nextStep = parseInt(currentStep) + 1;

    $('#navStep'+currentStep).removeClass('hover');
    $('#navStep'+nextStep).addClass('hover');

    $('#passo'+currentStep).toggle();
    $('#passo'+nextStep).toggle();
    if(url == null){
        url = "src/Web/reservationFormStep"+nextStep+".php";
    }

    postAjax(url,$('#reservationStep'+currentStep).serialize(),'#passo'+nextStep);
}

function selectCar(currentStep, idCar){
    var nextStepNr = parseInt(currentStep) + 1;
    var form = $('#reservationStep1').serialize();

    $('#navStep'+currentStep).removeClass('hover');
    $('#navStep'+nextStepNr).addClass('hover');

    var url = "src/Web/reservationFormStep"+nextStepNr+".php?idCar="+idCar+"&"+form;
    nextStep(currentStep, url);
}

function prevStep(currentStep){
    var prevStep = parseInt(currentStep) - 1;

    $('#navStep'+currentStep).removeClass('hover');
    $('#navStep'+prevStep).addClass('hover');

    $('#passo'+currentStep).toggle();
    $('#passo'+prevStep).toggle();
}

function finishStep(){
    $('#passo3').toggle();
}
