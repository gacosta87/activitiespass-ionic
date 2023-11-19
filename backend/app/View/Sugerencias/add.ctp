<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Sugerencias'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Sugerencias'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Add Sugerencia'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Sugerencia', array('class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
	
echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Sugerenciausuario_id">Usuario</label>';   
echo'<div class="col-md-9">';     
echo $this->Form->input('usuario_id', array('id'=>'Sugerenciausuario_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));    
echo '</div>';  
echo '</div>';
  
echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Sugerenciapuntaje">Puntaje</label>';    
echo'<div class="col-md-9">';     
echo $this->Form->input('puntaje', array('id'=>'Sugerenciapuntaje', 'div'=>false, 'label'=>false, 'class'=>'form-control'));    
echo '</div>';  
echo '</div>';
  
echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Sugerenciatexto">Texto</label>';    
echo'<div class="col-md-9">';     
echo $this->Form->input('texto', array('id'=>'Sugerenciatexto', 'div'=>false, 'label'=>false, 'class'=>'form-control'));    
echo '</div>';  
echo '</div>';
  
	?>
							</div>
							<div class="col-md-12">
								<div class="form-group">
	                                <div class="col-md-12">
	                                    <?php echo $this->Html->link(__('Volver al listado'), array('action' => 'index')); ?>	                                    <input value="Guardar" class="btn btn-primary pull-right" type="submit">
	                                </div>
	                            </div>
                            </div>
					</div></form>                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
