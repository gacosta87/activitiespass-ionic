<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Asistentechatsredes'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Asistentechatsredes'); ?></li>
  </ol>
</section>
<section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"><?php echo __('Asistentechatsredes'); ?> Detalles</h3>
                        <hr>
                    </div><!-- /.box-header -->
                    <div class="box-body">
						<dl class="dl-horizontal">
								<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sender Id'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['sender_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Recipient Id'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['recipient_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fields'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['fields']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['role']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mensaje'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['mensaje']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activo'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['activo']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['modified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Bandera'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['bandera']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Mensaje'); ?></dt>
		<dd>
			<?php echo $this->Html->link($asistentechatsrede['Mensaje']['id'], array('controller' => 'mensajes', 'action' => 'view', $asistentechatsrede['Mensaje']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Updated At'); ?></dt>
		<dd>
			<?php echo h($asistentechatsrede['Asistentechatsrede']['updated_at']); ?>
			&nbsp;
		</dd>
						</dl>
						<p>
						    		<?php echo $this->Html->link(__('Editar'), array('action' => 'edit', $asistentechatsrede['Asistentechatsrede']['id'])); ?>
                            |
                            		<?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>
                        </p>
					</div>
			    </div><!-- /.box -->
            </div><!-- /.col -->
        </div><!-- /.row -->
</section><!-- /.content -->
