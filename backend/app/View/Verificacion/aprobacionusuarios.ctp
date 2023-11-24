<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Denuncias'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Verificaciones'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Verificaciones'); ?> Registrados</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
							<table id="data" class="table table-striped table-bordered responsive nowrap" width="100%" cellspacing="0">
							<thead>
							<tr>
								<th><?php echo __('username'); ?></th>
								<th><?php echo __('Verificacion 3'); ?></th>
								<th><?php echo __('Verificacion 4'); ?></th>
								<th><?php echo __('Verificacion 5'); ?></th>
								<th class="actions"><?php echo __('Acción'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php $id_tr=0; ?>
							<?php foreach ($datos as $dato): ?>
								<?php $id_tr++; ?>
								<tr id="tr_<?php echo $id_tr; ?>" > 

											<td><?php echo h($dato['Usuario']['username']); ?>&nbsp;</td>
											<td>
												<?php if($dato['Usuario']['verificacion_3']=="3"){ ?>
													Aprobad
												<?php } ?>
												<?php if($dato['Usuario']['verificacion_3_ruta']!=""){ ?>
													<a href="<?= $dato['Usuario']['verificacion_3_ruta'] ?>" target="_blank"><img src="<?= $dato['Usuario']['verificacion_3_ruta'] ?>" height="350" width="350"></a>
												<?php } ?>
											</td>
											<td>
												<?php if($dato['Usuario']['verificacion_4']=="3"){ ?>
													Aprobad
												<?php } ?>
												<?php if($dato['Usuario']['verificacion_4_ruta']!=""){ ?>
													<a href="<?= $dato['Usuario']['verificacion_4_ruta'] ?>" target="_blank"><img src="<?= $dato['Usuario']['verificacion_4_ruta'] ?>" height="350" width="350"></a>
													Fecha <?= $dato['Usuario']['verificacion_4_date'] ?>
												<?php } ?>
											</td>
											<td>
												<?php if($dato['Usuario']['verificacion_5']=="3"){ ?>
													Aprobad
												<?php } ?>
												<?php if($dato['Usuario']['verificacion_5_ruta']!=""){ ?>
													<a href="<?= $dato['Usuario']['verificacion_5_ruta'] ?>" target="_blank"><img src="<?= $dato['Usuario']['verificacion_5_ruta'] ?>" height="350" width="350"></a>
												<?php } ?>
											</td>
											<td class="actions">
												<?php if($dato['Usuario']['verificacion_3']!="3"){ ?>
													<?php echo $this->Html->link(__('Aceptar 3'),  '#',  array('onclick'=>"aprobar3('tr_".$id_tr."', '".$dato['Usuario']['id']."' )",      'class'=>'btn btn-primary')); ?>
													<?php echo $this->Html->link(__('Rechazar 3'), '#',  array('onclick'=>"rechaaprobar3('tr_".$id_tr."', '".$dato['Usuario']['id']."' )", 'class'=>'btn btn-danger')); ?>
												<?php } ?>
												<?php if($dato['Usuario']['verificacion_4']!="3"){ ?>
													<?php echo $this->Html->link(__('Aceptar 4'),  '#',  array('onclick'=>"aprobar4('tr_".$id_tr."', '".$dato['Usuario']['id']."' )",      'class'=>'btn btn-primary')); ?>
													<?php echo $this->Html->link(__('Rechazar 4'), '#',  array('onclick'=>"rechaaprobar4('tr_".$id_tr."', '".$dato['Usuario']['id']."' )", 'class'=>'btn btn-danger')); ?>
												<?php } ?>
												<?php if($dato['Usuario']['verificacion_5']!="3"){ ?>
													<?php echo $this->Html->link(__('Aceptar 5'),  '#',  array('onclick'=>"aprobar5('tr_".$id_tr."', '".$dato['Usuario']['id']."' )",      'class'=>'btn btn-primary')); ?>
													<?php echo $this->Html->link(__('Rechazar 5'), '#',  array('onclick'=>"rechaaprobar5('tr_".$id_tr."', '".$dato['Usuario']['id']."' )", 'class'=>'btn btn-danger')); ?>
												<?php } ?>
												<?php echo $this->Html->link(__('Limpiar'), '#',  array('onclick'=>"limpiar('tr_".$id_tr."', '".$dato['Usuario']['id']."' )", 'class'=>'btn btn-danger')); ?>
											</td>

								</tr>
							<?php endforeach; ?>
							</tbody>
							</table>
						</div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
<script type="text/javascript">
	//$(document).ready(function() {
	    $('#data').DataTable( {
	    	dom: 'Bfrtlip',
	    	responsive: true,
	        buttons: [
	            {
	                extend:'copy',
	                title: '<?php echo __('Verificaciones'); ?>'
	            },
	            {
	                extend:'csv',
	                title: '<?php echo __('Verificaciones'); ?>'
	            },
	            {
	                extend:'excel',
	                title: '<?php echo __('Verificaciones'); ?>'
	            },
	            {
	                extend:'pdf',
	                title: '<?php echo __('Verificaciones'); ?>'
	            },
	            ,
	            {
	                extend:'print',
	                title: '<?php echo __('Verificaciones'); ?>'
	            }
	        ],
	        "language": 
	        {
				"sProcessing":     "Procesando...",
				"sLengthMenu":     "Mostrar _MENU_ registros",
				"sZeroRecords":    "No se encontraron resultados",
				"sEmptyTable":     "Ningún dato disponible en esta tabla",
				"sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
				"sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
				"sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
				"sInfoPostFix":    "",
				"sSearch":         "Buscar:",
				"sUrl":            "",
				"sInfoThousands":  ",",
				"sLoadingRecords": "Cargando...",
				"oPaginate": {
					"sFirst":    "Primero",
					"sLast":     "Último",
					"sNext":     "Siguiente",
					"sPrevious": "Anterior"
				},
				"oAria": {
					"sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
					"sSortDescending": ": Activar para ordenar la columna de manera descendente"
				}
			}
	    } );

	     function limpiar(id, valor){
           table =  $('#data').DataTable();
           table.row('#'+id).remove().draw(false);
	    }

	    function aprobar3(id, valor){
           table =  $('#data').DataTable();
           $.ajax({url:'<?= $this->Html->url("/Verificacion/aprobacionusuarios3/") ?>'+valor,type:"post",data:{},success:function(n){} });
	    }


	    function aprobar4(id, valor){
           table =  $('#data').DataTable();
           $.ajax({url:'<?= $this->Html->url("/Verificacion/aprobacionusuarios4/") ?>'+valor,type:"post",data:{},success:function(n){} });
	    }


	    function aprobar5(id, valor){
           table =  $('#data').DataTable();
           table.row('#'+id).remove().draw(false);
           $.ajax({url:'<?= $this->Html->url("/Verificacion/aprobacionusuarios5/") ?>'+valor,type:"post",data:{},success:function(n){} });
	    }



	    function rechaaprobar3(id, valor){
           table =  $('#data').DataTable();
           $.ajax({url:'<?= $this->Html->url("/Verificacion/rechaaprobacionusuarios3/") ?>'+valor,type:"post",data:{},success:function(n){} });
	    }


	    function rechaaprobar4(id, valor){
           table =  $('#data').DataTable();
           $.ajax({url:'<?= $this->Html->url("/Verificacion/rechaaprobacionusuarios4/") ?>'+valor,type:"post",data:{},success:function(n){} });
	    }


	    function rechaaprobar5(id, valor){
           table =  $('#data').DataTable();
           table.row('#'+id).remove().draw(false);
           $.ajax({url:'<?= $this->Html->url("/Verificacion/rechaaprobacionusuarios5/") ?>'+valor,type:"post",data:{},success:function(n){} });
	    }
	    
	//} );
</script>
