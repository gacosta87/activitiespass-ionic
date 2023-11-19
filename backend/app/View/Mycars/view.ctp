<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Mycars'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Mycars'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Mycars'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
								<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rif'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['rif']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Razon Social'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['razon_social']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Representante'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['representante']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Representante'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['descripcion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mycartipo'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycartipo']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Orden'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['orden']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefono'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['telefono']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Website'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['website']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Direccion'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['direccion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Latitud'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['latitud']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Longitud'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['longitud']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Foto1'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['foto1']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Foto2'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['foto2']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Foto3'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['foto3']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Foto4'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['foto4']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lunes'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['lunes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Martes'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['martes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Miercoles'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['miercoles']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Jueves'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['jueves']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Viernes'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['viernes']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sabado'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['sabado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Domingo'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['domingo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Pais'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['pais']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Municipio'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['municipio']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Estado'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['estado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($mycar['Mycar']['modified']); ?>
			&nbsp;
		</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $mycar['Mycar']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
