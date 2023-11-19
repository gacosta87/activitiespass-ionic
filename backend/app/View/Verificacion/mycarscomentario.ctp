<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Comentario'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Comentario'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Comentario'); ?> Registrados</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
							<table id="data" class="table table-striped table-bordered responsive nowrap" width="100%" cellspacing="0">
							<thead>
							<tr>
								<th><?php echo __('Usuario'); ?></th>
								<th><?php echo __('Publicacion'); ?></th>
								<th><?php echo __('Titulo'); ?></th>
								<th><?php echo __('Texto'); ?></th>
								<th><?php echo __('Imagen1'); ?></th>
								<th><?php echo __('Imagen2'); ?></th>
								<th><?php echo __('Imagen3'); ?></th>
								<th><?php echo __('Comentario'); ?></th>
								<th class="actions"><?php echo __('Acción'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php $id_tr=0; ?>
							<?php foreach ($datos as $dato): ?>
								<?php $id_tr++; ?>
								<tr id="tr_<?php echo $id_tr; ?>" > 
									<td><?php echo h($dato['Usuario']['username']); ?>&nbsp;</td>
									<td><?php echo h($dato['Mycarscomentario']['publicacione_id']); ?>&nbsp;</td>
									<td style="white-space: normal;"><?php echo h($dato['Publicacione']['titulo']); ?>&nbsp;</td>
									<td style="white-space: normal;"><?php echo h($dato['Publicacione']['texto']); ?>&nbsp;</td>
									<td>
										<?php if($dato['Publicacione']['imagen1']!=""){ ?>
											<img src="<?= $dato['Publicacione']['imagen1'] ?>" height="200" width="200">
										<?php } ?>
									</td>
									<td>
										<?php if($dato['Publicacione']['imagen2']!=""){ ?>
											<img src="<?= $dato['Publicacione']['imagen2'] ?>" height="200" width="200">
										<?php } ?>
									</td>
									<td>
										<?php if($dato['Publicacione']['imagen3']!=""){ ?>
											<img src="<?= $dato['Publicacione']['imagen3'] ?>" height="200" width="200">
										<?php } ?>
									</td>
									<td><?php echo h($dato['Mycarscomentario']['comentario']); ?>&nbsp;</td>
									<td class="actions">
										<?php echo $this->Html->link(__('Aceptar'), '#',  array('onclick'=>"aprobar('tr_".$id_tr."', '".$dato['Mycarscomentario']['id']."'  )", 'class'=>'btn btn-primary')); ?>
										<?php echo $this->Html->link(__('Rechazar'), '#', array('onclick'=>"eliminar('tr_".$id_tr."', '".$dato['Mycarscomentario']['id']."'  )", 'class'=>'btn btn-danger')); ?>
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
	                title: '<?php echo __('Comentario'); ?>'
	            },
	            {
	                extend:'csv',
	                title: '<?php echo __('Comentario'); ?>'
	            },
	            {
	                extend:'excel',
	                title: '<?php echo __('Comentario'); ?>'
	            },
	            {
	                extend:'pdf',
	                title: '<?php echo __('Comentario'); ?>'
	            },
	            ,
	            {
	                extend:'print',
	                title: '<?php echo __('Comentario'); ?>'
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
	    function aprobar(id, valor){
           table =  $('#data').DataTable();
           table.row('#'+id).remove().draw(false);
           $.ajax({url:'<?= $this->Html->url("/Verificacion/mycarscomentarioaceptar/") ?>'+valor,type:"post",data:{},success:function(n){} });
	    }
	    function eliminar(id, valor){
           table =  $('#data').DataTable();
           table.row('#'+id).remove().draw(false);
           $.ajax({url:'<?= $this->Html->url("/Verificacion/mycarscomentariodelete/") ?>'+valor,type:"post",data:{},success:function(n){} });
	    }
	//} );
</script>
