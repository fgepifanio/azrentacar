<!DOCTYPE html>
<?php include "config.php"; ?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>AZ Rent-a-car</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="css/geral.css" rel="stylesheet">
    <link href="css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
    <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    
    <!-- Le fav and touch icons -->
    
    <link rel="shortcut icon" href="favicon.ico">
    <!--
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png"> -->
  </head>

  <body>

    <div id="headerContainer">
    <div id="header" class="azHeader"><img src="img/Header.png" style="width:100%;height: 100%"/></div>
    <div id="mainNavbar" class="navbar">
      <div class="navbar-inner">
        <div class="container-fluid">
          <div class="nav-collapse">
            <ul class="nav" style='z-index:100'>
              <li class="active"><a id="homeNav">HOME</a></li>
              <li><a id="reservNav">RESERVAS</a></li>
              <li><a id="servicesNav">SERVIÇOS</a></li>
              <!--li><a id="usedNav">USADOS</a></li-->
              <li><a id="partnerNav">PARCEIROS</a></li>
              <li><a id="contactNav">CONTACTOS</a></li>
            </ul>
            <?php if(!isset($_SESSION['login']) || $_SESSION['login']!=1){?>
            <form id="loginForm" class="navbar-search pull-right" style="margin-top:15px;z-index:100">
                <a id='register'> Registe-se!</a>
                <input name="username" type="text" class="search-query span1" placeholder="Username" style='height:17px;width:70px'>
                <input name="password" type="password" class="search-query span1" placeholder="Password" style='height:17px'>
                <button type='button' class="btn btn-mini btn-primary" style='position:relative;top:-4px' 
                        onclick="postAjax('src/Web/login.php',$('#loginForm').serialize(), '#errorLogin')">ok</button>
            </form>
           <?php } ?>
     <?php if(isset($_SESSION['login']) && $_SESSION['login']==1){?>
              <ul class="nav pull-right" style="z-index:100">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Bem vindo <?php echo $_SESSION['shortName']; ?>! <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                    <li class="nav-header"><i class="icon-user"></i> Conta</li>
                    <li><a onclick="getAjax('src/Web/ContaPessoal/editDadosPessoais.php')">Dados Pessoais</a></li>
                    <li><a onclick="getAjax('src/Web/ContaPessoal/changePassword.php')">Alterar Password</a></li>
                    <li><a onclick="getAjax('src/Web/ContaPessoal/condutoresOptions.php')">Condutores</a></li> 
                    <!--li><a onclick="">Ver Reservas</a></li-->         
                    <?php if($_SESSION['administrador']==1){?>
                    <li class="nav-header"><i class="icon-briefcase"></i> Administrador</li>
                    <li><a onclick="getAjax('src/Web/Admin/Administrador.php')">Backoffice Clientes</a></li>
                    <li><a onclick="getAjax('src/Web/Admin/Administrador.php')">Backoffice Carros</a></li>
                    <?php }?>
                    <li class="divider"></li>
                    <li><a onclick="getAjax('src/Web/logout.php')"><i class="icon-off"></i>&nbsp;Logout</a></li>
                    </ul>
                </li>
              </ul>
           <?php } ?>
          </div><!--/.nav-collapse -->
 
        </div>
                        
      </div>
    </div>

    </div>
    <div id="errorLogin"></div>
    <div id="mainDiv" ></div> <!-- /mainDiv -->
    <div class="navbar">
      <div class="navbar-inner footer">
        <div class="container-fluid">
          <div class="nav-collapse">
            <ul class="nav">
              <li><a id="newsNav">Newsletter</a></li>
              <li><a id="termsNav">Termos e Condições</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    
    <script src="assets/js/jquery.js"></script>
    <script src="js/jquery-ui-1.8.21.custom.min.js"></script>
    <script src="assets/js/bootstrap-transition.js"></script>
    <script src="assets/js/bootstrap-alert.js"></script>
    <script src="assets/js/bootstrap-modal.js"></script>
    <script src="assets/js/bootstrap-dropdown.js"></script>
    <script src="assets/js/bootstrap-scrollspy.js"></script>
    <script src="assets/js/bootstrap-tab.js"></script>
    <script src="assets/js/bootstrap-tooltip.js"></script>
    <script src="assets/js/bootstrap-popover.js"></script>
    <!--script src="assets/js/bootstrap-button.js"></script-->
    <script src="assets/js/bootstrap-collapse.js"></script>
    <script src="assets/js/bootstrap-carousel.js"></script>
    <script src="assets/js/bootstrap-typeahead.js"></script>
    <script src="js/jquery.carouFredSel.js"></script>
    <script src="js/navigation.js"></script>
    <script src="js/jquery-apenasNumeros.js"></script>
    <script src="js/reservation.js"></script>
    <script src="js/jquery.validate.js"></script>
  </body>
</html>

