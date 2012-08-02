/* 
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

$.datepicker.setDefaults({

	changeMonth: true,

	changeYear: true,

	dateFormat: 'yy-mm-dd',

	showButtonPanel: true,

	monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],

	monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],

	nextText: 'Seguinte',

	prevText: 'Anterior',

	dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],

	dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],

	dayNamesMin: ['Do', 'Se', 'Te', 'Qu', 'Qu', 'Se', 'Sa'],

	closeText: 'Fechar',

	currentText: 'Hoje',

	firstDay: 1,

	numberOfMonths: 1,

	defaultDate: '0y',

	minDate: new Date(1900, 1 - 1, 1),

	maxDate: new Date(2032, 02 - 1, 07),

	yearRange: '1900:2032'

});



function getAjax(url, div){
    if(div == null){
        div = '#mainDiv';
    }
    $.ajax({
        url: url,
        success: function(data) {
            $(div).html(data);
            $('input[rel=picker]').attr('readonly', 'readonly').css('cursor','pointer').css('width', '90px').datepicker();
            $('input[rel=numerico]').apenasNumeros();
            $("div[rel=buttonset]").buttonset();
            setBinds();
        }
    }); 
}

function postAjax(url,dados, div){
    if(div == null){
        div = '#mainDiv';
        
    }
    $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: dados,
            success: function(data) {
                $(div).html(data);
                $('input[rel=picker]').attr('readonly', 'readonly').css('cursor','pointer').css('width', '90px').datepicker();
                $('input[rel=numerico]').apenasNumeros();
                $("div[rel=buttonset]").buttonset();
                setBinds();
              
            },
            error: function(){
                alert('Ocorreu um erro!')
            }
        }); 
}

function bindNav(idNav, url){
   $('#'+idNav).bind('click',function(){
        $.ajax({
          url: url,
          success: function(data) {
            $('#mainDiv').html(data);
            $('input[rel=picker]').attr('readonly', 'readonly').css('cursor','pointer').css('width', '90px').datepicker();
            $("#mainNavbar").find('.active').removeClass('active');
            $('#'+idNav).parent().addClass('active');
            $('input[rel=numerico]').apenasNumeros();
            $("div[rel=buttonset]").buttonset();
            setBinds();
        }
    }) 
})}

function bindImg(relImg, url){
  $('[rel='+relImg+']').bind('click',function(){
        $.ajax({
          url: url,
          success: function(data) {
            $('#mainDiv').html(data);
            $('input[rel=picker]').attr('readonly', 'readonly').css('cursor','pointer').css('width', '90px').datepicker();
            $("#mainNavbar").find('.active').removeClass('active');
            $('#'+relImg+'Nav').parent().addClass('active');
            $('input[rel=numerico]').apenasNumeros();
            $("div[rel=buttonset]").buttonset();
            setBinds();
          }   
        }) 
    })
}


$.ajax({
  url: 'src/home.php',
  success: function(data) {
    $('#mainDiv').html(data);
    setBinds();
  }
});


function setBinds(){
    bindNav('header','src/home.php');
    bindNav('homeNav','src/home.php');
    bindNav('reservNav','src/Web/reservation.php');
    bindImg('reserv','src/Web/reservation.php');
    bindNav('servicesNav','src/Web/services.php');
    bindImg('services','src/Web/services.php');
    bindNav('usedNav','src/Web/usedCars.php');
    bindNav('partnerNav','src/Web/partners.php');
    bindImg('partner','src/Web/partners.php');
    bindNav('contactNav','src/Web/contacts.php');
    bindNav('newsNav','src/Web/newsletter.php');
    bindNav('termsNav','src/Web/termsUse.php');
    bindNav('register','src/Web/registationForm.php');
}