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
        <!-- BAR CHART -->
                <div class="box box-success">
                  <div class="box-header with-border">
                    <h3 class="box-title">Usuarios registrados vs Usuarios instalados ultimos 3 meses</h3>
                    <div class="box-tools pull-right">
                    </div>
                  </div>
                  <div class="box-body chart-responsive">
                    <div class="chart" id="bar-chart" style="height: 300px;"></div>
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
        </div>
  </div>



     <div class="row">
        <div class="col-md-12">
                  <!-- solid sales graph -->
                  <div class="box box-info">
                    <div class="box-header">
                      <i class="fa fa-th"></i>
                      <h3 class="box-title">Instalaciones realizadas ultimos 7 dias</h3>
                      <div class="box-tools pull-right">
                      </div>
                    </div>
                    <div class="box-body border-radius-none">
                      <div class="chart" id="line-chart3" style="height: 250px;"></div>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
        </div>
  </div>    

  <!-- solid sales graph -->
  <div class="box box-solid bg-teal-gradient">
    <div class="box-header">
      <i class="fa fa-th"></i>
      <h3 class="box-title">Usuarios registrados ultimos 7  dias</h3>
      <div class="box-tools pull-right">
      </div>
    </div>
    <div class="box-body border-radius-none">
      <div class="chart" id="line-chart" style="height: 250px;"></div>
    </div><!-- /.box-body -->
  </div><!-- /.box -->

 <div class="row">
        <div class="col-md-12">
                  <!-- solid sales graph -->
                  <div class="box box-info">
                    <div class="box-header">
                      <i class="fa fa-th"></i>
                      <h3 class="box-title">Publicaciones realizadas ultimos 7 dias</h3>
                      <div class="box-tools pull-right">
                      </div>
                    </div>
                    <div class="box-body border-radius-none">
                      <div class="chart" id="line-chart2" style="height: 250px;"></div>
                    </div><!-- /.box-body -->
                  </div><!-- /.box -->
        </div>
  </div>    



   


</section>              


 <script type="text/javascript">
  $(function () {
        "use strict";

              var line2 = new Morris.Line({
                  element: 'line-chart3',
                  resize: true,
                  data: [
                  <?php 
                    foreach ($totalusuariosinst as $key) {
                        echo "{day: '".$key['fecha']."', total: ".$key['valor']."},";
                    }
                  ?>
                  ],
                  xkey: 'day',
                  parseTime:false,
                  ykeys: ['total'],
                  labels: ['Total'],
                  lineColors: ['#3c8dbc'],
                  hideHover: 'auto'
                });



              var line = new Morris.Line({
                  element: 'line-chart',
                  resize: true,
                  data: [
                  <?php 
                    foreach ($totalusuarios as $key) {
                        echo "{day: '".$key['fecha']."', total: ".$key['valor']."},";
                    }
                  ?>
                  ],
                  xkey: 'day',
                  parseTime:false,
                  ykeys: ['total'],
                  labels: ['Total '],
                  lineColors: ['#efefef'],
                  lineWidth: 2,
                  hideHover: 'auto',
                  gridTextColor: "#fff",
                  gridStrokeWidth: 0.4,
                  pointSize: 4,
                  pointStrokeColors: ["#efefef"],
                  gridLineColor: "#efefef",
                });




              var line2 = new Morris.Line({
                  element: 'line-chart2',
                  resize: true,
                  data: [
                  <?php 
                    foreach ($totalpublicaciones as $key) {
                        echo "{day: '".$key['fecha']."', total: ".$key['valor']."},";
                    }
                  ?>
                  ],
                  xkey: 'day',
                  parseTime:false,
                  ykeys: ['total'],
                  labels: ['Total'],
                  lineColors: ['#3c8dbc'],
                  hideHover: 'auto'
                });






              var bar = new Morris.Bar({
                element: 'bar-chart',
                resize: true,
                data: [
                  <?php 
                    $contar = 0;
                    foreach ($totalinstallvsregistro as $key) {
                        $contar++;
                        $a = isset($key['inst'])?$key['inst']:0;
                        $b = isset($key['regis'])?$key['regis']:0;
                        $mes = mes_text_devuelve($key['mes']);
                        echo "{y: '".$mes."', a:".$a.", b:".$b."  },";
                    }
                  ?>
                ],
                barColors: ['#00a65a', '#f56954'],
                xkey: 'y',
                ykeys: ['a', 'b'],
                labels: ['Instalados', 'Registrados'],
                hideHover: 'auto'
              });
      });

    </script>


