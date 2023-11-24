<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Configure::read('nombresistema') ?></title> 
    <?php
      $img_url =  "img/logo.png";
      $ruta_src = $this->webroot.$img_url;
    ?>
    <link rel="shortcut icon" type="image/png" href="<?= $ruta_src ?>"/>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/bootstrap/css/bootstrap.min.css', 'AdminLTE-2.3.0');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/bootstrap/css/font-awesome.min.css', 'AdminLTE-2.3.0');?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/bootstrap/css/ionicons.min.css', 'AdminLTE-2.3.0');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/dist/css/AdminLTE.min.css', 'AdminLTE-2.3.0');?>">

    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/plugins/datatables/dataTables.bootstrap.css', 'AdminLTE-2.3.0');?>">
    <!-- AdminLTE Skins. Choose a skin from the css/skins folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/dist/css/skins/_all-skins.css', 'AdminLTE-2.3.0');?>">

    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/fullcalendar-4.2.0/packages/core/main.css', 'AdminLTE-2.3.0');?>">
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/fullcalendar-4.2.0/packages/daygrid/main.css', 'AdminLTE-2.3.0');?>">
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/fullcalendar-4.2.0/packages/timegrid/main.css', 'AdminLTE-2.3.0');?>">

    <script src="<?= $this->Html->templateinclude('/fullcalendar-4.2.0/packages/core/main.js', 'AdminLTE-2.3.0');?>"></script>
    <script src="<?= $this->Html->templateinclude('/fullcalendar-4.2.0/packages/interaction/main.js', 'AdminLTE-2.3.0');?>"></script>
    <script src="<?= $this->Html->templateinclude('/fullcalendar-4.2.0/packages/moment/main.js', 'AdminLTE-2.3.0');?>"></script>
    <script src="<?= $this->Html->templateinclude('/fullcalendar-4.2.0/packages/daygrid/main.js', 'AdminLTE-2.3.0');?>"></script>
    <script src="<?= $this->Html->templateinclude('/fullcalendar-4.2.0/packages/timegrid/main.js', 'AdminLTE-2.3.0');?>"></script>
    <script src="<?= $this->Html->templateinclude('/fullcalendar-4.2.0/packages/core/locales-all.js', 'AdminLTE-2.3.0');?>"></script>

  <style type="text/css">
.input-form {
    width: 100%;
    padding: 0px;
    box-sizing: border-box;
    background: none;
    outline: none;
    resize: none;
    border: 0;
    font-family: 'Montserrat',sans-serif;
    transition: all .3s;
    border-bottom: 1px solid #bebed2;
}
 p:before{
      content:attr(type);
      display:block;
      font-size:14px;
      color:#000
}
.input-form select{
      height: 44px !important;
}


  </style>
    <!--<script src="https://maps.google.com/maps?file=api&v=2&key=AIzaSyDLW19BOiktbivjhDaTSU7vnTNCf5ZNyNk" type="text/javascript"></script>-->
    <script src="https://maps.google.com/maps?file=api&v=2&key=<?= Configure::read('api_mycarg_google') ?>" type="text/javascript"></script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]> 
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
   <!-- jQuery 2.1.4 -->
    <script src="<?= $this->Html->templateinclude('/plugins/jQuery/jQuery-2.1.4.min.js', 'AdminLTE-2.3.0');?>"></script>

    <!-- croppic -->
    <?php echo $this->Html->script('croppie/croppie.js'); ?>
    <?php echo $this->Html->script('croppie/exif.js'); ?>
    <?php echo $this->Html->script('croppie/sweetalert.min.js'); ?>
    <?php echo $this->Html->css('croppie/croppie.css'); ?>
    <?php echo $this->Html->css('croppie/sweetalert.css'); ?>

    <script src="<?= $this->Html->templateinclude('/ckeditor.js', 'ckeditor');?>"></script>
    <script src="<?= $this->Html->templateinclude('/samples/js/sample.js', 'ckeditor');?>"></script>


    <?php 
    //echo $this->Html->css('datatable/jquery.dataTables.css'); 
    ?>
    <?php echo $this->Html->css('datatable/buttons.dataTables.min.css'); ?>
    <?php echo $this->Html->css('datatable/dataTables.bootstrap.min.css'); ?>
    <?php echo $this->Html->css('datatable/responsive.dataTables.min.css'); ?>
    <?php echo $this->Html->css('jquery.fileupload.css'); ?>
    <?php echo $this->Html->css('wickedpicker.min.css'); ?>
    <?php echo $this->Html->script('wickedpicker.js'); ?>

    <!-- DataTable JS -->
    <?php echo $this->Html->script('datatable/jquery.dataTables.js'); ?>
    <?php echo $this->Html->script('datatable/dataTables.responsive.min.js'); ?>
    <?php echo $this->Html->script('datatable/dataTables.bootstrap.min.js'); ?>
    <?php echo $this->Html->script('datatable/dataTables.buttons.min.js'); ?>
    <?php echo $this->Html->script('datatable/dataTables.buttons.flash.min.js'); ?>
    <?php echo $this->Html->script('datatable/jszip.min.js'); ?>
    <?php echo $this->Html->script('datatable/pdfmake.min.js'); ?>
    <?php echo $this->Html->script('datatable/vfs_fonts.js'); ?>
    <?php echo $this->Html->script('datatable/buttons.html5.min.js'); ?>
    <?php echo $this->Html->script('datatable/buttons.print.min.js'); ?>

    <!-- highcharts JS -->
    <?php echo $this->Html->script('highcharts/highcharts.js'); ?>
    <?php echo $this->Html->script('highcharts/highcharts-3d.js'); ?>
    <?php echo $this->Html->script('highcharts/exporting.js'); ?>

    <?php echo $this->Html->script('highcharts/exporting.js'); ?>


    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
     <?php echo $this->Html->script('jquery.ui.widget.js'); ?>
    <!-- fileupload JS -->
    <?php echo $this->Html->script('jquery.iframe-transport.js'); ?>

     <!-- ChartJS 1.0.1 -->
    <script src="<?= $this->Html->templateinclude('/plugins/chartjs/Chart.min.js', 'AdminLTE-2.3.0');?>"></script>
    
    <?php echo $this->Html->css('jquery-ui.css'); ?>
    <?php echo $this->Html->script('jquery-ui.min.js'); ?>
    <?php echo $this->Html->script('function.js'); ?>
    <script type="text/javascript">
        jQuery(function($){
            $.datepicker.regional['es'] = {
                closeText: 'Cerrar',
                prevText: '&#x3c;Ant',
                nextText: 'Sig&#x3e;',
                currentText: 'Hoy',
                monthNames: ['Enero','Febrero','Marzo','Abril','Mayo','Junio',
                'Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'],
                monthNamesShort: ['Ene','Feb','Mar','Abr','May','Jun',
                'Jul','Ago','Sep','Oct','Nov','Dic'],
                dayNames: ['Domingo','Lunes','Martes','Mi&eacute;rcoles','Jueves','Viernes','S&aacute;bado'],
                dayNamesShort: ['Dom','Lun','Mar','Mi&eacute;','Juv','Vie','S&aacute;b'],
                dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','S&aacute;'],
                weekHeader: 'Sm',
                dateFormat: 'yy-mm-dd',
                firstDay: 1,
                isRTL: false,
                changeMont: true,
                changeYear: true,
                showMonthAfterYear: true,
                yearRange: '-100:+30',
                yearSuffix: ''};
            $.datepicker.setDefaults($.datepicker.regional['es']);
        });
    </script>
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/plugins/morris/morris.css', 'AdminLTE-2.3.0');?>">
   <script src="<?= $this->Html->templateinclude('/dist/js/raphael-min.js', 'AdminLTE-2.3.0');?>"></script>
   <script src="<?= $this->Html->templateinclude('/plugins/morris/morris.min.js', 'AdminLTE-2.3.0');?>"></script>
  </head>
  <style type="text/css">
    .btn-primary {
    }
    .btn-primary:hover, .btn-primary:active, .btn-primary.hover {
    }
  </style>
  <body class="hold-transition skin-red sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="<?= $this->Html->url('/Principal/')?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><?= Configure::read('namesysM') ?></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?= Configure::read('nombresistema') ?></b></span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <?php
                  $img_url =  "img/logo.png";
                  $ruta_src = $this->webroot.$img_url;
                  ?>
                  <img src="<?= $ruta_src ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php $name = $this->Session->read('usuario'); echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= $ruta_src ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php $name = $this->Session->read('usuario'); echo $name; ?>
                      <small><?php $roldeno = $this->Session->read('roldeno'); echo $roldeno; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                    </div>
                    <div class="pull-right">
                      <a href="<?= $this->Html->url('/Login/logout')?>" class="btn btn-default btn-flat">Cerrar Sesi贸n</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- =============================================== -->
      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
        <!-- Sidebar user panel -->
            <div class="user-panel">
              <div class="pull-left image">
                <img src="<?= $ruta_src ?>" class="img-circle" alt="User Image">
              </div>
              <div class="pull-left info">
                <p><?php $name = $this->Session->read('usuario'); echo $name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              </div>
            </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Opciones del sistema</li>
            <li class="treeview" id="activa0">
              <a href="#">
                <i class="fa fa-home"></i> <span>Inicio</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
                <li><a href="<?= $this->Html->url('/Principal/index')?>"><span>Dashboard 1</span></a></li>
                <li><a href="<?= $this->Html->url('/Principal/index2')?>"><span>Dashboard 2</span></a></li>
                <li><a href="<?= $this->Html->url('/Principal/index3')?>"><span>Dashboard 3</span></a></li>
              </ul>
            </li>

            <li class="treeview" id="activa1">
              <a href="#">
                <i class="fa fa-clone"></i> <span>Informaciones</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
                <li><a href="<?= $this->Html->url('/Informaciones/')?>"><span>Informaciones</span></a></li>
               <!-- 
                <li><a href="<?= $this->Html->url('/Menus/')?>"><span>Menus</span></a></li>
                <li><a href="<?= $this->Html->url('/Servicioclientes/')?>"><span>Servicio clientes</span></a></li>-->
              </ul>
            </li>
            <!--
            <li class="treeview" id="activa2">
              <a href="#">
                <i class="fa fa-tags"></i> <span>Mensajes Push</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
                <li><a href="<?= $this->Html->url('/Historialpushes/sinpublicar')?>"><span>Push masivos sin publicar</span></a></li>
                <li><a href="<?= $this->Html->url('/Historialpushes/publicar')?>"><span>Push masivos con publicar</span></a></li>
                <li><a href="<?= $this->Html->url('/Historialpushusuarios/')?>"><span>Push usuarios</span></a></li>
              </ul>
            </li>
            -->
            <li class="treeview" id="activa5">
              <a href="#">
                <i class="fa fa-tags"></i> <span>Configuraciones</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
                <li><a href="<?= $this->Html->url('/Configuraciones/')?>"><span>Conf. Olympus</span></a></li>
                <li><a href="<?= $this->Html->url('/Banners/')?>"><span>Banners</span></a></li>
              </ul>
            </li>


            <li class="treeview" id="activa6">
              <a href="#">
                <i class="fa fa-tags"></i> <span>Chat</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
                <li><a href="<?= $this->Html->url('/Chatcategorias/')?>"><span>Categoria</span></a></li>
                <li><a href="<?= $this->Html->url('/Chatpromts/')?>"><span>Prompts</span></a></li>
                <li><a href="<?= $this->Html->url('/Asistentechatsredes/')?>"><span>Chat whatsapp</span></a></li>
              </ul>
            </li>


            <li class="treeview" id="activa8">
              <a href="#">
                <i class="fa fa-tags"></i> <span>Para ti</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
                <li><a href="<?= $this->Html->url('/Paraticategorias/')?>"><span>Categoria</span></a></li>
                <!--<li><a href="<?= $this->Html->url('/Paratidetalles/')?>"><span>Publicaciones</span></a></li>-->
                <li><a href="<?= $this->Html->url('/Publicaciones/')?>"><span>Publicaciones</span></a></li>
              </ul>
            </li>

            <li class="treeview" id="activa3">
              <a href="#">
                <i class="fa fa-tags"></i> <span>Categorias</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
                <li><a href="<?= $this->Html->url('/Categorias/')?>"><span>Categoria</span></a></li>
              </ul>
            </li>

            

            <li class="treeview" id="activa7">
              <a href="#">
                <i class="fa fa-user"></i> <span>Verificacion</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
                <li><a href="<?= $this->Html->url('/Verificacion/mensajes')?>"><span>Mensajes</span></a></li>
                <li><a href="<?= $this->Html->url('/Verificacion/mycarscomentario')?>"><span>Comentarios</span></a></li>
                <li><a href="<?= $this->Html->url('/Verificacion/mycarcalificacione')?>"><span>Calificaciones</span></a></li>
                <li><a href="<?= $this->Html->url('/Verificacion/promocione')?>"><span>Promociones</span></a></li>
                <li><a href="<?= $this->Html->url('/Verificacion/publicacione')?>"><span>Publicaciones</span></a></li>
                <li><a href="<?= $this->Html->url('/Verificacion/usuarios')?>"><span>Usuarios</span></a></li>
                <li><a href="<?= $this->Html->url('/Verificacion/denuncias')?>"><span>Denuncias</span></a></li>
                <li><a href="<?= $this->Html->url('/Sugerencias/')?>"><span>Sugerencias</span></a></li>
              </ul>
            </li>

            <li class="treeview" id="activa4">
              <a href="#">
                <i class="fa fa-user"></i> <span>Usuarios</span> <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu"> 
                <li><a href="<?= $this->Html->url('/Usuarios/')?>"><span>Usuarios</span></a></li>
              </ul>
            </li>

          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <?php echo $this->Flash->render(); ?>
        <?php echo $this->fetch('content'); ?>
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
      </footer>
      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li class="active"><a href="#control-sidebar-home-tab" data-toggle="tab" class="active"><i class="fa fa-home"></i></a></li>
          <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane active" id="control-sidebar-home-tab">
            <h3 class="control-sidebar-heading">Recent Activity</h3>
          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content -->
          <div class="tab-pane" id="control-sidebar-settings-tab">
              <h3 class="control-sidebar-heading">General Settings</h3>
          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>
    </div><!-- ./wrapper -->
    <?php 
      echo "<script> $('#activa".$_SESSION["modulo_activo"]."').addClass('active'); </script>";
    ?>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?= $this->Html->templateinclude('/bootstrap/js/bootstrap.min.js', 'AdminLTE-2.3.0');?>"></script>
    <!-- SlimScroll -->
    <script src="<?= $this->Html->templateinclude('/plugins/slimScroll/jquery.slimscroll.min.js', 'AdminLTE-2.3.0');?>"></script>
    <!-- FastClick -->
    <script src="<?= $this->Html->templateinclude('/plugins/fastclick/fastclick.min.js', 'AdminLTE-2.3.0');?>"></script>
    <!-- AdminLTE App -->
    <script src="<?= $this->Html->templateinclude('/dist/js/app.js', 'AdminLTE-2.3.0');?>"></script>
    <!-- AdminLTE for demo purposes -->
  <?php /*
   <!-- Morris.js charts -->

   */?>
    <?php echo $this->Html->script('highcharts/drilldown.js'); ?>
    <?php echo $this->Html->script('highcharts/data.js'); ?>
  </body>
</html>

