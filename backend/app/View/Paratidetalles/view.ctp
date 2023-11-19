<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Paratidetalles'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Paratidetalles'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Paratidetalles'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
		<dt><?php echo __('Categoria'); ?></dt>
		<dd>
			<?php echo $paratidetalle['Paraticategoria']['denominacion']; ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Titulo'); ?></dt>
		<dd>
			<?php echo h($paratidetalle['Paratidetalle']['titulo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url Foto'); ?></dt>
		<dd>
			<?php echo h($paratidetalle['Paratidetalle']['url_foto']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url Video'); ?></dt>
		<dd>
			<?php echo h($paratidetalle['Paratidetalle']['url_video']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Url Descarga'); ?></dt>
		<dd>
			<?php echo h($paratidetalle['Paratidetalle']['url_descarga']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Documentación'); ?></dt>
		<dd>
			<?php echo h($paratidetalle['Paratidetalle']['documentacion']); ?>
			&nbsp;
		</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $paratidetalle['Paratidetalle']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
