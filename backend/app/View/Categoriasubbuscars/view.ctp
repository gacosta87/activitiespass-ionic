<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Categoriasubbuscars'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Categoriasubbuscars'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Categoriasubbuscars'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
		<dt><?php echo __('Categoria'); ?></dt>
		<dd>
			<?php echo h($categoriasubbuscar['Categoria']['denominacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Categoriasub'); ?></dt>
		<dd>
			<?php echo h($categoriasubbuscar['Categoriasub']['denominacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Palabra'); ?></dt>
		<dd>
			<?php echo h($categoriasubbuscar['Categoriasubbuscar']['palabra']); ?>
			&nbsp;
		</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $categoriasubbuscar['Categoriasubbuscar']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
