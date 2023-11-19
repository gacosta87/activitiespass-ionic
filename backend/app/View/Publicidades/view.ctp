<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Publicidades'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Publicidades'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Publicidades'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
		<dt><?php echo __('Tipo'); ?></dt>
		<dd>
			<?php echo h($publicidade['Publicidade']['tipo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Titulo'); ?></dt>
		<dd>
			<?php echo h($publicidade['Publicidade']['titulo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Imagen'); ?></dt>
		<dd>
			<?php echo h($publicidade['Publicidade']['imagen']); ?>
			<img src="<?= $this->Html->webroot($publicidade['Publicidade']['imagen']) ?>">
			&nbsp;
		</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $publicidade['Publicidade']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
