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
                        <h3 class="box-title"><?php echo __('Usuarios del sistema'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
						        <dt><?php echo __('Empresa'); ?></dt>
								<dd>
									<?php echo h($user['Empresa']['razon_social']); ?>
									&nbsp;
								</dd>
						        <dt><?php echo __('Surcusal'); ?></dt>
								<dd>
									<?php echo h($user['Empresasurcusale']['denominacion']); ?>
									&nbsp;
								</dd>
								<dt><?php echo __('Nombre y Apellido'); ?></dt>
								<dd>
									<?php echo h($user['User']['nombre_apellido']); ?>
									&nbsp;
								</dd>
								<dt><?php echo __('Role'); ?></dt>
								<dd>
									<?php echo h($user['Role']['title']); ?>
									&nbsp;
								</dd>

								<dt><?php echo __('Username'); ?></dt>
								<dd>
									<?php echo h($user['User']['username']); ?>
									&nbsp;
								</dd>

								<dt><?php echo __('Estatus'); ?></dt>
								<dd>
									<?php echo h($user['Estatus']['denominacion']); ?>
									&nbsp;
								</dd>

						</dl>
 

						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $user['User']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Edit User'), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete User'), array('action' => 'delete', $user['User']['id']), array(), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php */ ?>