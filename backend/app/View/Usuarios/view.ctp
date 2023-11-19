<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Usuarios'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Usuarios'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Usuarios'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
		<dt><?php echo __('Mycar'); ?></dt>
		<dd>
			<?php echo h($usuario['Mycar']['razon_social']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rol'); ?></dt>
		<dd>
			<?php echo h($usuario['Role']['title']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Username'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Clave'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['clave']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ci'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['ci']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefono'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['telefono']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre Apellido'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['nombre_apellido']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombres'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['nombres']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Apellidos'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['apellidos']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Password'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['password']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recuperar'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['recuperar']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Verificado'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['verificado']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fechaingreso'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['fechaingreso']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Push Token'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['push_token']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Push Platf'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['push_platf']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codigo Recuperacion'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['codigo_recuperacion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codigo Compartir'); ?></dt>
		<dd>
			<?php echo h($usuario['Usuario']['codigo_compartir']); ?>
			&nbsp;
		</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $usuario['Usuario']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
