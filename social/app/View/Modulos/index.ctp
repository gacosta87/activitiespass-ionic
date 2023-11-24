<section class="content-header">
  <h1>
    
    <small><?php echo __('Modulos'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Modulos'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Modulos'); ?> Registrados</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <p><?php echo $this->Html->link(__('Crear Nuevo'), array('action' => 'add')); ?></p>

							<table class="table table-striped">
							<thead>
							<tr>
															<th><?php echo $this->Paginator->sort('Denominación'); ?></th>
															<th class="actions"><?php echo __('Actions'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($modulos as $modulo): ?>
	<tr>
		<td><?php echo h($modulo['Modulo']['denominacion']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $modulo['Modulo']['id'])); ?>
|			<?php echo $this->Html->link(__('Detalles'), array('action' => 'view', $modulo['Modulo']['id'])); ?>
|			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $modulo['Modulo']['id']), array(), __('Are you sure you want to delete # %s?', $modulo['Modulo']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
							</tbody>
							</table>
							<br>
						    <p style="text-align: center;font-style: italic; padding: 3px;" class="panel panel-success">
							<?php
							echo $this->Paginator->counter(array(
							'format' => __('Página {:page} de {:pages}, mostrando {:current} registros de un total de {:count}, apartir del registro {:start}, que concluye el {:end}')
							));
							?>							</p>
							<div class="paging pull-right">
							<?php
		echo $this->Paginator->prev('' . __('< Anterior '), array(), null, array('class' => 'disabled'));
		echo $this->Paginator->numbers(array('separator' => ' | '));
		echo $this->Paginator->next(__(' Siguiente >') . '', array(), null, array('class' => 'disabled'));
	?>
							</div>
						</div>
                </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->


<?php /* ?><div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Modulo'), array('action' => 'add')); ?></li>
	</ul>
</div>
<?php */ ?>