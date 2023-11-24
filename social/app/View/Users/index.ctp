<section class="content-header">
  <h1>
    
    <small><?php echo __('Usuarios del sistema'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Usuarios del sistema'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Usuarios del sistema'); ?> Registrados</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <p><?php echo $this->Html->link(__('Crear Nuevo'), array('action' => 'add'),  array('class'=>'btn btn-primary')); ?></p>

							<table id="data" class="table table-striped table-bordered responsive nowrap" width="100%" cellspacing="0">
							<thead>
							<tr>
															<th><?php echo h('Empresa'); ?></th>
															<th><?php echo h('Sucursal'); ?></th>

															<th><?php echo h('Nombre'); ?></th>
															<th><?php echo h('Username'); ?></th>
															<th><?php echo h('Rol'); ?></th>
															<th class="actions"><?php echo __('Actions'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php 			 $empresa_id          = $this->Session->read('empresa_id'); 
							 $empresasurcusale_id = $this->Session->read('empresasurcusale_id'); 
							 $rol_id              = $this->Session->read('ROL'); 
							 $user_id             = $this->Session->read('USUARIO_ID'); 
							?>
							<?php foreach ($users as $user): ?>
								<tr>
									<td><?php echo h($user['Empresa']['razon_social']); ?>&nbsp;</td>
									<td><?php echo h($user['Empresasurcusale']['denominacion']); ?>&nbsp;</td>

									<td><?php echo h($user['User']['nombre_apellido']); ?>&nbsp;</td>
									<td><?php echo h($user['User']['username']); ?>&nbsp;</td>
									<td><?php echo h($user['Role']['title']); ?>&nbsp;</td>
									<td class="actions">
										<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $user['User']['id']), array('class'=>'btn btn-primary')); ?>
										<?php echo $this->Html->link(__('Detalles'), array('action' => 'view', $user['User']['id']), array('class'=>'btn btn-success')); ?>
										<?php echo $this->Html->link(__('Eliminar'), array('action' => 'delete', $user['User']['id']), array('class'=>'btn btn-danger', 'confirm'=>__('Esta seguro que desea eliminar el registro # %s?', $user['User']['id']))); ?>
									</td>
								</tr>
							<?php endforeach; ?>
							</tbody>
							</table>
							</div>
						</div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->


<?php /* ?><div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php */ ?>
<script type="text/javascript">
	//$(document).ready(function() {
	    $('#data').DataTable( {
	    	dom: 'Bfrtlip',
	    	responsive: true,
	        buttons: [
	            'copy', 'csv', 'excel', 'pdf', 'print'
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
	//} );
</script>