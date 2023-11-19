<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Mycarstips'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Mycarstips'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Mycarstips'); ?> Registrados</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <p><?php echo $this->Html->link(__('Crear Nuevo'), array('action' => 'add'),  array('class'=>'btn btn-primary')); ?></p>

							<table id="data" class="table table-striped table-bordered responsive nowrap" width="100%" cellspacing="0">
							<thead>
							<tr>
															<th><?php echo __('Imagen'); ?></th>
															<th><?php echo __('Titulo'); ?></th>
															<th><?php echo __('Tipo'); ?></th>
															<th><?php echo __('Titulo 2'); ?></th>
															<th class="actions"><?php echo __('Acción'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php $id_tr=0; ?><?php foreach ($mycarstips as $mycarstip): ?>
			<?php $id_tr++; ?>
			<tr id="tr_<?php echo $id_tr; ?>" > 
		<td>
			<?php
	              $foto = $mycarstip['Mycarstip']['imagen'];
	               $src = $this->webroot.$foto;
            ?>
            <img src="<?= $src ?>"  height="150" width="150">
		</td>
		<td><?php echo h($mycarstip['Mycarstip']['titulo']); ?>&nbsp;</td>
		<td><?php echo h($mycarstip['Mycarstip']['tipo']==1?"Imagen":"Video"); ?>&nbsp;</td>
		<td><?php echo h($mycarstip['Mycarstip']['titulo2']); ?>&nbsp;</td>
		<td class="actions">
			<?php 			 $empresa_id          = $this->Session->read('empresa_id'); 
			 $empresasurcusale_id = $this->Session->read('empresasurcusale_id'); 
			 $rol_id              = $this->Session->read('ROL'); 
			 $user_id             = $this->Session->read('USUARIO_ID'); 
			?> 			<?php echo $this->Html->link(__('Editar'),   array('action' => 'edit',   $mycarstip['Mycarstip']['id']), array('class'=>'btn btn-primary')); ?>
			<?php echo $this->Html->link(__('Ver'),      array('action' => 'view',   $mycarstip['Mycarstip']['id']), array('class'=>'btn btn-success')); ?>
			<?php echo $this->Html->link(__('Eliminar'), '#', array('onclick'=>"del('tr_".$id_tr."', '".$mycarstip['Mycarstip']['id']."'  )", 'class'=>'btn btn-danger', 'confirm'=>__('Esta seguro que desea eliminar el registro # %s?', $mycarstip['Mycarstip']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Mycarstip'), array('action' => 'add')); ?></li>
	</ul>
</div>
<?php */ ?><script type="text/javascript">
	//$(document).ready(function() {
	    $('#data').DataTable( {
	    	dom: 'Bfrtlip',
	    	responsive: true,
	        buttons: [
	            {
	                extend:'copy',
	                title: '<?php echo __('Mycarstips'); ?>'
	            },
	            {
	                extend:'csv',
	                title: '<?php echo __('Mycarstips'); ?>'
	            },
	            {
	                extend:'excel',
	                title: '<?php echo __('Mycarstips'); ?>'
	            },
	            {
	                extend:'pdf',
	                title: '<?php echo __('Mycarstips'); ?>'
	            },
	            ,
	            {
	                extend:'print',
	                title: '<?php echo __('Mycarstips'); ?>'
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

	    function del(id, valor){
           table =  $('#data').DataTable();
           table.row('#'+id).remove().draw(false);
           //$.ajax({url:'/Mycarstips/delete/'+valor,type:"post",data:{},success:function(n){} });
           $.ajax({url:'<?= $this->Html->url("/Mycarstips/delete/") ?>'+valor,type:"post",data:{},success:function(n){} });
	    }
	//} );
</script>
