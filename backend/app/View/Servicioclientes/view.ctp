<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Servicioclientes'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Servicioclientes'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Servicioclientes'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
		<dt><?php echo __('Pais'); ?></dt>
		<dd>
			<?php echo h($serviciocliente['Serviciocliente']['pais']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Llamada'); ?></dt>
		<dd>
			<?php echo h($serviciocliente['Serviciocliente']['llamada']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Whatsapp'); ?></dt>
		<dd>
			<?php echo h($serviciocliente['Serviciocliente']['whatsapp']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mensaje'); ?></dt>
		<dd>
			<?php echo h($serviciocliente['Serviciocliente']['mensaje']); ?>
			&nbsp;
		</dd>
		
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $serviciocliente['Serviciocliente']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
