<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Historialpushusuarios'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Historialpushusuarios'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Historialpushusuarios'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
							<dt><?php echo __('Usuario'); ?></dt>
							<dd>
								<?php echo h($historialpushusuario['Usuario']['username']); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Titulo'); ?></dt>
							<dd>
								<?php echo h($historialpushusuario['Historialpushusuario']['titulo']); ?>
								&nbsp;
							</dd>
							<dt><?php echo __('Texto'); ?></dt>
							<dd>
								<?php echo h($historialpushusuario['Historialpushusuario']['texto']); ?>
								&nbsp;
							</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $historialpushusuario['Historialpushusuario']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
