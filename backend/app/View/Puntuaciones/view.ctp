<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Puntuaciones'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Puntuaciones'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Puntuaciones'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
								
		<dt><?php echo __('Denominación'); ?></dt>
		<dd>
			<?php echo h($puntuacione['Puntuacione']['denominacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Punto'); ?></dt>
		<dd>
			<?php echo h($puntuacione['Puntuacione']['punto']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Acción'); ?></dt>
		<dd>
			<?php echo h($puntuacione['Puntuacione']['accion']); ?>
			&nbsp;
		</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $puntuacione['Puntuacione']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
