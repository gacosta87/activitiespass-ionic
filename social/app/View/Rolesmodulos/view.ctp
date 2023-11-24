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
                        <h3 class="box-title"><?php echo __('Roles modulos'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
								
		<dt><?php echo __('Rol'); ?></dt>
		<dd>
			<?php echo h($rolesmodulo['Role']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modulo'); ?></dt>
		<dd>
			<?php echo h($rolesmodulo['Modulo']['denominacion']); ?>
			&nbsp;
		</dd>
		
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $rolesmodulo['Rolesmodulo']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
<?php /* ?><div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rolesmodulo'), array('action' => 'edit', $rolesmodulo['Rolesmodulo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rolesmodulo'), array('action' => 'delete', $rolesmodulo['Rolesmodulo']['id']), array(), __('Are you sure you want to delete # %s?', $rolesmodulo['Rolesmodulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Rolesmodulos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rolesmodulo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modulos'), array('controller' => 'modulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modulo'), array('controller' => 'modulos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php */ ?>