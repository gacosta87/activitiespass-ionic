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
                        <h3 class="box-title"><?php echo __('Usermodulos'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
						<dt><?php echo __('User'); ?></dt>
						<dd>
							<?php echo $this->Html->link($usermodulo['User']['username'], array('controller' => 'users', 'action' => 'view', $usermodulo['User']['id'])); ?>
							&nbsp;
						</dd>
						<dt><?php echo __('Modulo'); ?></dt>
						<dd>
							<?php echo $this->Html->link($usermodulo['Modulo']['denominacion'], array('controller' => 'modulos', 'action' => 'view', $usermodulo['Modulo']['id'])); ?>
							&nbsp;
						</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $usermodulo['Usermodulo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Edit Usermodulo'), array('action' => 'edit', $usermodulo['Usermodulo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Usermodulo'), array('action' => 'delete', $usermodulo['Usermodulo']['id']), array(), __('Are you sure you want to delete # %s?', $usermodulo['Usermodulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Usermodulos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Usermodulo'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Modulos'), array('controller' => 'modulos', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modulo'), array('controller' => 'modulos', 'action' => 'add')); ?> </li>
	</ul>
</div>
<?php */ ?>