<script>
$("#foo").carouFredSel({
        items: 3,
        direction: "down",
        scroll : {
            duration: 1000,							
            pauseOnHover: true
        }					
});	   
</script>
<div class="container-fluid" style="padding-left: 0px;padding-right: 0px;">
    <div class="container-fluid" style="padding-left: 0px;padding-right: 0px;">
        <div class="row-fluid">
            <!-- Carousel
            ================================================== -->
            <section id="carousel">
                <div class="span6 columns" style="margin-left: 0px">
                    <div id="myCarousel" class="carousel slide">
                        <div class="carousel-inner">
                        <div rel="1" class="item active">
                            <img onclick="" rel="partner" src="img/parceiros.png" alt="" style="cursor: pointer;">
                        </div>
                        <div rel="2" class="item">
                            <img onclick="" rel="services" src="img/servicos_destaques.jpg" alt="" style="cursor: pointer;">
                        </div>
                        <div rel="3" class="item">
                            <img oncick="" rel="reserv" src="img/promocao10-10.jpg" alt="" style="cursor: pointer;">
                        </div>
                        </div>
                    </div>
                    <div style="background-color: #97aebe;height: 45px;text-align: right;vertical-align: middle;margin-bottom: 18px;">
                        <div class="lighterText bigText" style="margin-left:20px; margin-top: 10px;text-align: left;float: left;">
                            <p>DESTAQUES</p>
                        </div>
                        <div style="text-align: right;">
                            <img id="navSlider1" src="img/1Sel.png" style="width: 35px;height: 35px;" onclick="$('#myCarousel').carousel(0);">
                            <img id="navSlider2" src="img/2.png" style="width: 35px;height: 35px;" onclick="$('#myCarousel').carousel(1);">
                            <img id="navSlider3" src="img/3.png" style="width: 35px;height: 35px;" onclick="$('#myCarousel').carousel(2);">
                        </div>
                    </div>
                </div>
                <script>
                    $('#myCarousel').carousel({
                        interval: 4000
                    });
                    $('#myCarouse2').carousel({
                        interval: 4000
                    });
                    $('#myCarousel').bind('slide',function(a){
                        var nrSlider = $('#myCarousel .active').attr('rel');
                        $('#navSlider'+nrSlider).attr('src','img/'+nrSlider+'.png');
                    });
                    $('#myCarousel').bind('slid',function(a){
                        var nrSlider = $('#myCarousel .active').attr('rel');
                        $('#navSlider'+nrSlider).attr('src','img/'+nrSlider+'Sel.png');
                    });
                </script>
            </section>
            <div class="span3">
                <table style="width:100%;">
                    <tr>
                        <td>
                            <div style="width:100%;">
                                <img rel="reserv" src="img/frota.png" style="width:100%;"/>
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 20px"><td><td></tr>
                    <tr>
                        <td>
                            <div style="width:100%;">
                                <img rel="services" src="img/motorista.png" style="width:100%;"/>
                            </div>
                        </td>
                    </tr>
                </table> 
            </div>
            <div class="span3" align="center" style="margin-top: 20px;background-color: #d0dcda;">
                <div align="center" id="foo" class="image_carousel" style="height: 190px;">
                        <img src="img/applications/estafetas.jpg" style="width:140px;"/>
                        <img src="img/applications/OPolvo.jpg" style="width:140px;"/>
                        <img src="img/applications/seguros.jpg" style="width:140px;"/>
                        <img src="img/applications/EstremozBrinde.jpg" style="width:140px;"/>
                        <img src="img/applications/taxis.jpg" style="width:140px;"/>
                        <img src="img/applications/softwareapl.jpg" style="width:140px;"/>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container-fluid" style="padding-left: 0px;padding-right: 0px;">
        <!-- Example row of columns -->
        <div class="row-fluid">
            <div class="span6" style=" margin-right: 0px;">
                <img rel="reserv" src="img/reservas.png" style="cursor:pointer;width:100%;"/>
            </div>
            <div class="span4">
                <table style="width:100%;margin-left: 20px;">
                    <tr style="height: 10px"><td><td></tr>
                    <tr>
                        <td>
                            <div>
                                <h2>Newsletter</h2>
                                <p>Saiba as ultimas noticias da Az Rent-a-car.</p>
                                <p><a class="btn btn-primary" href="#">Inscreva-se &raquo;</a></p>
                            </div>
                        </td>
                    </tr>
                    <tr style="height: 30px"><td><td></tr>
                    <tr>
                        <td>
                            <div>
                                <h2>Apoio a Clientes</h2>
                                <p>Contacte-nos através do contacto 21 829 77 40</p>
                                <p>Ou pelo email <a>geral@azrentacar.pt</a></p>
                            </div>
                        </td>
                    </tr>
                </table>         
            </div>
            <div class="span2"></div>
        </div>
    </div>

</div> <!-- /container -->
