<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Mycarservicios'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Mycarservicios'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Mycarservicios'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
								<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mycarservicio['Mycarservicio']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mycar'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mycarservicio['Mycar']['id'], array('controller' => 'mycars', 'action' => 'view', $mycarservicio['Mycar']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Categoria'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mycarservicio['Categoria']['id'], array('controller' => 'categorias', 'action' => 'view', $mycarservicio['Categoria']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Categoriasub'); ?></dt>
		<dd>
			<?php echo $this->Html->link($mycarservicio['Categoriasub']['id'], array('controller' => 'categoriasubs', 'action' => 'view', $mycarservicio['Categoriasub']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activo'); ?></dt>
		<dd>
			<?php echo h($mycarservicio['Mycarservicio']['activo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($mycarservicio['Mycarservicio']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($mycarservicio['Mycarservicio']['modified']); ?>
			&nbsp;
		</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $mycarservicio['Mycarservicio']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
