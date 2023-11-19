<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.Console.Templates.default.views
 * @since         CakePHP(tm) v 1.2.0.5234
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<section class="content-header">
  <h1>
    <?php echo "<?= Configure::read('namesysS'); ?>"; ?>
    <small><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo "<?= \$this->Html->url('/Dashboard/')?>"; ?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?> Registrados</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <p><?php echo "<?php echo \$this->Html->link(__('Crear Nuevo'), array('action' => 'add'),  array('class'=>'btn btn-primary')); ?>"; ?></p>

							<table id="data" class="table table-striped table-bordered responsive nowrap" width="100%" cellspacing="0">
							<thead>
							<tr>
							<?php foreach ($fields as $field): ?>
								<th><?php echo "<?php echo __('{$field}'); ?>"; ?></th>
							<?php endforeach; ?>
								<th class="actions"><?php echo "<?php echo __('Acción'); ?>"; ?></th>
							</tr>
							</thead>
							<tbody>
							<?php
							echo "<?php \$id_tr=0; ?>";
							echo "<?php foreach (\${$pluralVar} as \${$singularVar}): ?>\n";
							echo "\t\t\t<?php \$id_tr++; ?>\n";
							echo "\t\t\t<tr id=\"tr_<?php echo \$id_tr; ?>\" > \n";
								foreach ($fields as $field) {
									$isKey = false;
									if (!empty($associations['belongsTo'])) {
										foreach ($associations['belongsTo'] as $alias => $details) {
											if ($field === $details['foreignKey']) {
												$isKey = true;
												echo "\t\t<td>\n\t\t\t<?php echo \$this->Html->link(\${$singularVar}['{$alias}']['{$details['displayField']}'], array('controller' => '{$details['controller']}', 'action' => 'view', \${$singularVar}['{$alias}']['{$details['primaryKey']}'])); ?>\n\t\t</td>\n";
												break;
											}
										}
									}
									if ($isKey !== true) {
										echo "\t\t<td><?php echo h(\${$singularVar}['{$modelClass}']['{$field}']); ?>&nbsp;</td>\n";
									}
								}
								echo "\t\t<td class=\"actions\">\n";
								echo "\t\t\t<?php ";
								echo "\t\t\t \$usuario_rol              = \$this->Session->read('usuario_rol'); \n";
								echo "\t\t\t \$usuario_id             = \$this->Session->read('usuario_id'); \n";
								echo "\t\t\t?> ";
								echo "\t\t\t<?php echo \$this->Html->link(__('Editar'),   array('action' => 'edit',   \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class'=>'btn btn-primary')); ?>\n";
								echo "\t\t\t<?php echo \$this->Html->link(__('Ver'),      array('action' => 'view',   \${$singularVar}['{$modelClass}']['{$primaryKey}']), array('class'=>'btn btn-success')); ?>\n";
								echo "\t\t\t<?php echo \$this->Html->link(__('Eliminar'), '#', array('onclick'=>\"eliminar('tr_\".\$id_tr.\"', '\".\${$singularVar}['{$modelClass}']['{$primaryKey}'].\"'  )\", 'class'=>'btn btn-danger', 'confirm'=>__('Esta seguro que desea eliminar el registro # %s?', \${$singularVar}['{$modelClass}']['{$primaryKey}']))); ?>\n";
								echo "\t\t</td>\n";
							echo "\t</tr>\n";
							echo "<?php endforeach; ?>\n";
							?>
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
	                title: '<?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?>'
	            },
	            {
	                extend:'csv',
	                title: '<?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?>'
	            },
	            {
	                extend:'excel',
	                title: '<?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?>'
	            },
	            {
	                extend:'pdf',
	                title: '<?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?>'
	            },
	            ,
	            {
	                extend:'print',
	                title: '<?php echo "<?php echo __('{$pluralHumanName}'); ?>"; ?>'
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
           //$.ajax({url:'/<?= $pluralHumanName ?>/delete/'+valor,type:"post",data:{},success:function(n){} });
           $.ajax({url:'<?php echo "<?= \$this->Html->url(\"/$pluralHumanName/delete/\") ?>"; ?>'+valor,type:"post",data:{},success:function(n){} });
	    }
	//} );
</script>
