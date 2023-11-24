<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Configure::read('namesysT') ?></title> 
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
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/dist/css/skins/_all-skins.css', 'AdminLTE-2.3.0');?>">

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


    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
     <?php echo $this->Html->script('jquery.ui.widget.js'); ?>
    <!-- fileupload JS -->
    <?php echo $this->Html->script('jquery.iframe-transport.js'); ?>
    <?php echo $this->Html->script('jquery.fileupload.js'); ?>




  




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
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper">
      <header class="main-header">
        <!-- Logo -->
        <a href="<?= $this->Html->url('/Dashboard/')?>" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b><?= Configure::read('namesysM') ?></b></span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b><?= Configure::read('namesysS') ?></b></span>
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
                  $foto_url =  $this->Session->read('foto');
                  if(isset($foto_url)){
                      $foto = $foto_url;
                      if (file_exists($foto)) {
                          $src = $this->webroot.$foto_url;
                      } else {
                          $src = $this->Html->templateinclude('dist/img/user2-160x160.jpg', 'AdminLTE-2.3.0');
                      }
                  }else{
                       $src = $this->Html->templateinclude('dist/img/user2-160x160.jpg', 'AdminLTE-2.3.0');
                  }
                  ?>
                  <img src="<?= $src ?>" class="user-image" alt="User Image">
                  <span class="hidden-xs"><?php $name = $this->Session->read('usuario'); echo $name; ?></span>
                </a>
                <ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">
                    <img src="<?= $src ?>" class="img-circle" alt="User Image">
                    <p>
                      <?php $name = $this->Session->read('usuario'); echo $name; ?>
                      <small><?php $roldeno = $this->Session->read('roldeno'); echo $roldeno; ?></small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <?php
                             $user_id = $this->Session->read('USUARIO_ID');   
                      ?>
                      <a href="<?= $this->Html->url('/Dashboard/edit_pass/'.$user_id )?>" class="btn btn-default btn-flat">Perfil</a>
                    </div>
                    <div class="pull-right">
                      <a href="<?= $this->Html->url('/Login/logout')?>" class="btn btn-default btn-flat">Cerrar Sesión</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <?php
       $modulos = $this->Session->read('MODULOS');
       $rol     = $this->Session->read('ROL');
       for($i=1; $i<=20; $i++){
        $activa[$i] = 0;
       }
       foreach ($modulos as $modulo) {
           $activa[$modulo['modulo_id']] = 1;

       }
      ?>
      <!-- =============================================== -->
      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
        <!-- Sidebar user panel -->
            <div class="user-panel">
              <div class="pull-left image">
                <img src="<?= $src ?>" class="img-circle" alt="User Image">
              </div>
              <div class="pull-left info">
                <p><?php $name = $this->Session->read('usuario'); echo $name; ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
              </div>
            </div>
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header">Opciones del sistema</li>
            <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-dashboard"></i><span>Inicio</span></a></li>


          

            <li class="header">SISTEMA</li>
             <?php if($activa[1]==1){ ?>
                <li class="treeview" id="activa1">
                  <a href="#"> 
                    <i class="fa fa-cogs"></i> <span>Sistema</span> <i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu"> 
                    <li>
                        <a href="#"><span>Roles/Modulos</span> <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li data-controller="dummies"><a href="<?= $this->Html->url('/Roles/')?>">Roles</a></li>
                        </ul>
                    </li>
                  </ul>
              </li>
              <?php } ?>
              <?php if($activa[4]==1){ ?>
                <li><a href="<?= $this->Html->url('/Empresas/')?>"><i class="fa fa-circle-o text-red"></i> <span>Empresa</span></a></li>
              <?php } ?>
               <?php if($activa[3]==1){?>
                <li><a href="<?= $this->Html->url('/Empresasurcusales/')?>"><i class="fa fa-circle-o text-yellow"></i> <span>Sucursales</span></a></li>
              <?php } ?>
              <?php if($activa[2]==1){?>
                <li><a href="<?= $this->Html->url('/Users/')?>"><i class="fa fa-circle-o text-aqua"></i> <span>Usuarios</span></a></li>
              <?php } ?>
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
       /*if($_SESSION["MODULO_ACTIVO"]==7 || $_SESSION["MODULO_ACTIVO"]==8 || $_SESSION["MODULO_ACTIVO"]==12 || $_SESSION["MODULO_ACTIVO"]==16){
        echo "<script> $('#activa781216').addClass('active'); </script>";
       }else if($_SESSION["MODULO_ACTIVO"]==9 || $_SESSION["MODULO_ACTIVO"]==15){
        echo "<script> $('#activa915').addClass('active'); </script>";
       }*/
      echo "<script> $('#activa".$_SESSION["MODULO_ACTIVO"]."').addClass('active'); </script>";
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
   <script src="<?= $this->Html->templateinclude('/dist/js/raphael-min.js', 'AdminLTE-2.3.0');?>"></script>
   <script src="<?= $this->Html->templateinclude('/plugins/morris/morris.min.js', 'AdminLTE-2.3.0');?>"></script>
   */?>
    
   
    
    <?php echo $this->Html->script('highcharts/drilldown.js'); ?>
    <?php echo $this->Html->script('highcharts/data.js'); ?>

  </body>
</html>

