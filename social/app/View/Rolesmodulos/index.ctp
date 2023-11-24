<section class="content-header">
  <h1>
    
    <small><?php echo __('Roles modulos'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Roles modulos'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Roles modulos'); ?> Registrados</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                    <p><?php echo $this->Html->link(__('Crear Nuevo'), array('action' => 'add')); ?></p>

							<table class="table table-striped">
							<thead>
							<tr>
															<th><?php echo $this->Paginator->sort('Rol'); ?></th>
															<th><?php echo $this->Paginator->sort('Modulo'); ?></th>
															<th class="actions"><?php echo __('Actions'); ?></th>
							</tr>
							</thead>
							<tbody>
							<?php foreach ($rolesmodulos as $rolesmodulo): ?>
	<tr>
		<td><?php echo h($rolesmodulo['Role']['title']); ?></td>
		<td><?php echo h($rolesmodulo['Modulo']['denominacion']); ?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $rolesmodulo['Rolesmodulo']['id'])); ?>
|			<?php echo $this->Html->link(__('Detalles'), array('action' => 'view', $rolesmodulo['Rolesmodulo']['id'])); ?>
|			<?php echo $this->Form->postLink(__('Eliminar'), array('action' => 'delete', $rolesmodulo['Rolesmodulo']['id']), array(), __('Are you sure you want to delete # %s?', $rolesmodulo['Rolesmodulo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Rolesmodulo'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modulos'), array('controller' => 'modulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modulo'), array('controller' => 'modulos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php */ ?>