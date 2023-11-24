<section class="content-header">
  <h1>
    
    <small><?php echo __('Usermodulos'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Usermodulos'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Usermodulos'); ?> Registrados</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <p><?php echo $this->Html->link(__('Crear Nuevo'), array('action' => 'add')); ?></p>

							<table id="data" class="table table-striped table-bordered" width="100%" cellspacing="0">
							<thead>
							<tr>
															<th><?php echo h('Usuario'); ?></th>
															<th><?php echo h('Modulo'); ?></th>
															<th class="actions"><?php echo __('Actions'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($usermodulos as $usermodulo): ?>
	<tr>
		<td><?php echo h($usermodulo['User']['username']); ?></td>
		<td><?php echo h($usermodulo['Modulo']['denominacion']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $usermodulo['Usermodulo']['id'])); ?>
|			<?php echo $this->Html->link(__('Detalles'), array('action' => 'view', $usermodulo['Usermodulo']['id'])); ?>
|			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $usermodulo['Usermodulo']['id']), array(), __('Are you sure you want to delete # %s?', $usermodulo['Usermodulo']['id'])); ?>
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


<?php /* ?><div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Usermodulo'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modulos'), array('controller' => 'modulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modulo'), array('controller' => 'modulos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php */ ?>

<script type="text/javascript">
	//$(document).ready(function() {
	    $('#data').DataTable( {
	    	dom: 'Bfrtlip',
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