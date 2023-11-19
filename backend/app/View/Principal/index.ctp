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
  <!-- Small boxes (Stat box) -->
  <div class="row">

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $cusuariosaprobacion ?></h3>
          <p>Verificaciones</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="<?= $this->Html->url('/Verificacion/aprobacionusuarios')?>" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->


    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?= $cusuarios ?></h3>
          <p>Nuevos usuarios</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="<?= $this->Html->url('/Verificacion/usuarios')?>" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $cpublicaciones ?></h3>
          <p>Nuevas publicaciones</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?= $this->Html->url('/Verificacion/publicacione')?>" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-yellow">
        <div class="inner">
          <h3><?= $casistentes ?></h3>
          <p>Asistentes</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?= $this->Html->url('/Historialpushes/conasistentevirtual')?>" class="small-box-footer">Enviar mensaje <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->


    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $credes ?></h3>
          <p>Redes conectadsa</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="#" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $cwhatsapp ?></h3>
          <p>Whatsapp<p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?= $this->Html->url('/Historialpushes/marketingwhatsapp')?>"  class="small-box-footer">Enviar mensaje <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->

     <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?= $cwhatsapp ?></h3>
          <p>Whatsapp<p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?= $this->Html->url('/Historialpushes/marketingwhatsapp2')?>" class="small-box-footer">Enviar estadisticas <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->


    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $csugerencias?></h3>
          <p>Sugerencias</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?= $this->Html->url('/Sugerencias/')?>" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $cusuariosregistrados?></h3>
          <p>Usuarios Registrados</p>
        </div>
        <div class="icon">
          <i class="ion ion-pie-graph"></i>
        </div>
        <a href="<?= $this->Html->url('/Historialpushes/')?>" class="small-box-footer">Mensajes <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-blue">
        <div class="inner">
          <h3><?= $cinstalaccionapp ?></h3>
          <p>Instalaciones</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?= $this->Html->url('/Historialpushes/instalados')?>" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->

    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-red">
        <div class="inner">
          <h3><?= $csuscripciones ?></h3>
          <p>Suscrpciones</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->


    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-aqua">
        <div class="inner">
          <h3><?= $tpublicaciones ?></h3>
          <p>Total publicaciones</p>
        </div>
        <div class="icon">
          <i class="ion ion-person-add"></i>
        </div>
        <a href="#" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->
    <div class="col-lg-3 col-xs-6">
      <!-- small box -->
      <div class="small-box bg-green">
        <div class="inner">
          <h3><?= $tpromociones ?></h3>
          <p>Total Promociones</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="#" class="small-box-footer">Ver más <i class="fa fa-arrow-circle-right"></i></a>
      </div>
    </div><!-- ./col -->

  </div><!-- /.row -->
</section>

