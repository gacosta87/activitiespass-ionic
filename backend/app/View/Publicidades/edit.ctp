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
                    <h3 class="box-title"><?php echo __('Edit Publicidade'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Publicidade', array('class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
			
echo $this->Form->input('id', array('class'=>'form-horizontal'));	
echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Publicidadetipo">Tipo</label>';   
echo'<div class="col-md-9">';     
echo $this->Form->input('tipo', array('options'=>array(1=>'Principal'),  'id'=>'Publicidadetipo', 'div'=>false, 'label'=>false, 'class'=>'form-control'));    
echo '</div>';  
echo '</div>';
  
echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Publicidadetitulo">Titulo</label>';   
echo'<div class="col-md-9">';     
echo $this->Form->input('titulo', array('id'=>'Publicidadetitulo', 'div'=>false, 'label'=>false, 'class'=>'form-control'));   
echo '</div>';  
echo '</div>';
  
echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Publicidadeimagen">Imagen</label>';   
echo'<div class="col-md-9">';     
echo $this->Form->input('imagen', array('type'=>'file', 'id'=>'Publicidadeimagen', 'div'=>false, 'label'=>false, 'class'=>'form-control'));   
echo '</div>';  
echo '</div>';

echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Tiposerviciodenominacion">Imagen</label>';    
echo'<div class="col-md-9">'; 
?>
<img src="<?= $this->Html->webroot($this->data['Publicidade']['imagen']) ?>" height="80" width="100">
<?php   
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
