<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Asistentechatsredes'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Asistentechatsredes'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Asistentechatsredes'); ?> Registrados</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <p><?php echo $this->Html->link(__('Crear Nuevo'), array('action' => 'add'),  array('class'=>'btn btn-primary')); ?></p>

							<table id="data" class="table table-striped table-bordered responsive nowrap" width="100%" cellspacing="0">
							<thead>
							<tr>
															<th><?php echo __('Id'); ?></th>
															<th><?php echo __('Sender id'); ?></th>
															<th><?php echo __('Recipient id'); ?></th>
															<th><?php echo __('Role'); ?></th>
															<th><?php echo __('Fecha Hora'); ?></th>
															<th><?php echo __('Mensaje'); ?></th>
															<th class="actions"><?php echo __('Acción'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php $id_tr=0; ?><?php foreach ($asistentechatsredes as $asistentechatsrede): ?>
			<?php $id_tr++; ?>
			<tr id="tr_<?php echo $id_tr; ?>" > 
		<td><?php echo h($asistentechatsrede['Asistentechatsrede']['id']); ?></td>
		<td><?php echo h($asistentechatsrede['Asistentechatsrede']['sender_id']); ?></td>
		<td><?php echo h($asistentechatsrede['Asistentechatsrede']['recipient_id']); ?></td>
		<td><?php echo h($asistentechatsrede['Asistentechatsrede']['role']); ?></td>
		<td><?php echo h($asistentechatsrede['Asistentechatsrede']['created']); ?></td>
		<td><?php echo h($asistentechatsrede['Asistentechatsrede']['mensaje']); ?></td>
		<td class="actions">
			<?php 			 
				$usuario_rol              = $this->Session->read('usuario_rol'); 
			 	$usuario_id             = $this->Session->read('usuario_id'); 
			?> 			
			<?php echo $this->Html->link(__('Editar'),   array('action' => 'edit',   $asistentechatsrede['Asistentechatsrede']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Ver'),      array('action' => 'view',   $asistentechatsrede['Asistentechatsrede']['id']), array('class'=>'btn btn-success')); ?>
			<?php echo $this->Html->link(__('Eliminar'), '#', array('onclick'=>"eliminar('tr_".$id_tr."', '".$asistentechatsrede['Asistentechatsrede']['id']."'  )", 'class'=>'btn btn-danger', 'confirm'=>__('Esta seguro que desea eliminar el registro # %s?', $asistentechatsrede['Asistentechatsrede']['id']))); ?>
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
	                title: '<?php echo __('Asistentechatsredes'); ?>'
	            },
	            {
	                extend:'csv',
	                title: '<?php echo __('Asistentechatsredes'); ?>'
	            },
	            {
	                extend:'excel',
	                title: '<?php echo __('Asistentechatsredes'); ?>'
	            },
	            {
	                extend:'pdf',
	                title: '<?php echo __('Asistentechatsredes'); ?>'
	            },
	            ,
	            {
	                extend:'print',
	                title: '<?php echo __('Asistentechatsredes'); ?>'
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

	    function eliminar(id, valor){
           table =  $('#data').DataTable();
           table.row('#'+id).remove().draw(false);
           //$.ajax({url:'/Asistentechatsredes/delete/'+valor,type:"post",data:{},success:function(n){} });
           $.ajax({url:'<?= $this->Html->url("/Asistentechatsredes/delete/") ?>'+valor,type:"post",data:{},success:function(n){} });
	    }
	//} );
</script>
