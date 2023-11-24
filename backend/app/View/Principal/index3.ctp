<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dashboard
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  

  <div class="row">
        <div class="col-md-12">
             <!-- Info Boxes Style 2 -->
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Nuevos mensajes</span>
                  <span class="info-box-number"><?= $cmensajes ?></span>
                  <a href="<?= $this->Html->url('/Verificacion/mensajes')?>" class="" style="color:#fff;">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Nuevos calificaciones</span>
                  <span class="info-box-number"><?= $ccalificaciones ?></span>
                  <a href="<?= $this->Html->url('/Verificacion/mycarcalificacione')?>" class="" style="color:#fff;">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-red">
                <span class="info-box-icon"><i class="ion-ios-chatbubble-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Nuevos comentarios</span>
                  <span class="info-box-number"><?= $ccomentarios ?></span>
                  <a href="<?= $this->Html->url('/Verificacion/mycarscomentario')?>" class="" style="color:#fff;">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->
              <div class="info-box bg-aqua">
                <span class="info-box-icon"><i class="ion ion-ios-cloud-download-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Nuevos denuncias</span>
                  <span class="info-box-number"><?= $cdenuncacias ?></span>
                  <a href="<?= $this->Html->url('/Verificacion/denuncias')?>" class="" style="color:#fff;">Ver más <i class="fa fa-arrow-circle-right"></i></a>
                </div><!-- /.info-box-content -->
              </div><!-- /.info-box -->

        </div>

        <!--
        <div class="col-md-12">
              <div class="info-box bg-yellow">
                <span class="info-box-icon"><i class="ion ion-ios-pricetag-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Registrados vs Sin publicar</span>
                  <span class="info-box-number"><?= $cusuariosregistrados." vs ".$totalusuariossinpubli ?></span>
                  <a href="<?= $this->Html->url('/Historialpushes/sinpublicar')?>" class="" style="color:#fff;">Mensaje <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
               <div class="info-box bg-green">
                <span class="info-box-icon"><i class="ion ion-ios-heart-outline"></i></span>
                <div class="info-box-content">
                  <span class="info-box-text">Registrados con publicaciones</span>
                  <span class="info-box-number"><?= ($cusuariosregistrados-$totalusuariossinpubli) ?></span>
                  <a href="<?= $this->Html->url('/Historialpushes/publicar')?>" class="" style="color:#fff;">Mensaje <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
        </div>

        -->
  </div>

</section>              

