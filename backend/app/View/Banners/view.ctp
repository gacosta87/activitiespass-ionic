<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Banners'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Banners'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Banners'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
		<dt><?php echo __('Tipo'); ?></dt>
		<dd>
			<?php echo h($banner['Banner']['tipo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url Banner'); ?></dt>
		<dd>
			<?php echo h($banner['Banner']['url_banner']); ?>
			&nbsp;
		</dd>

		<dt><?php echo __('Perfil'); ?></dt>
		<dd>
			<?php echo h($banner['Banner']['mycar_id']); ?>
			&nbsp;
		</dd>

		
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $banner['Banner']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
