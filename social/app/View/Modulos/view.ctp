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
                        <h3 class="box-title"><?php echo __('Modulos'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
								
		<dt><?php echo __('Denominación'); ?></dt>
		<dd>
			<?php echo h($modulo['Modulo']['denominacion']); ?>
			&nbsp;
		</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $modulo['Modulo']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('Edit Modulo'), array('action' => 'edit', $modulo['Modulo']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Modulo'), array('action' => 'delete', $modulo['Modulo']['id']), array(), __('Are you sure you want to delete # %s?', $modulo['Modulo']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Modulos'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Modulo'), array('action' => 'add')); ?> </li>
	</ul>
</div>
<?php */ ?>