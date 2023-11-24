<section class="content-header">
  <h1>
    
    <small><?php echo __('Empresa surcusales'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Empresa surcusales'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Edit Empresa surcusales'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Empresasurcusale', array('class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
			
								echo $this->Form->input('id', array('class'=>'form-horizontal'));	
								echo'<div class="form-group" style="display:none;">';	
								echo'<label class="control-label col-md-2" for="Empresasurcusaleempresa_id">Empresa</label>';		
								echo'<div class="col-md-9">';			
								echo $this->Form->input('empresa_id', array('id'=>'Empresasurcusaleempresa_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
								echo '</div>';	
								echo '</div>';
									
								echo'<div class="form-group">';	
								echo'<label class="control-label col-md-2" for="Empresasurcusaledenominacion">Denominación</label>';		
								echo'<div class="col-md-9">';			
								echo $this->Form->input('denominacion', array('id'=>'Empresasurcusaledenominacion', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
								echo '</div>';	
								echo '</div>';

								?>
							</div>
							<div class="col-md-12">
								<div class="form-group">
	                                <div class="col-md-12">
	                                    <?php echo $this->Html->link(__('Volver'), array('action' => 'index')); ?>	                                    <input value="Guardar" class="btn btn-primary pull-right" type="submit">
	                                </div>
	                            </div>
                            </div>
					</div></form>                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
<?php /* ?>	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Empresasurcusale.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Empresasurcusale.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Empresasurcusales'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('List Empresas'), array('controller' => 'empresas', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Empresa'), array('controller' => 'empresas', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		</ul>
	</div>
<?php */ ?>