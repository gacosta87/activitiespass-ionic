<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Categorias'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Categorias'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Edit Categoria'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Categoria', array("enctype"=>"multipart/form-data", 'class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
			
echo $this->Form->input('id', array('class'=>'form-horizontal'));	

echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Categoriadenominacion">Idioma</label>';   
echo'<div class="col-md-9">';     
echo $this->Form->input('idioma', array('id'=>'Categoriadenominacion', 'div'=>false, 'label'=>false, 'class'=>'form-control'));   
echo '</div>';  
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Categoriadenominacion">Denominación</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('denominacion', array('id'=>'Categoriadenominacion', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Categoriadescripcion">Descripción</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('descripcion', array('id'=>'Categoriadescripcion', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Categoriaimagen">Imagen</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('imagen', array('type'=>'file', 'id'=>'Categoriaimagen', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';


echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Tiposerviciodenominacion">Imagen</label>';    
echo'<div class="col-md-9">'; 
?>
<img src="<?= $this->Html->webroot($this->data['Categoria']['imagen']) ?>" height="80" width="100">
<?php   
echo '</div>';  
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Categoriaorden">Orden</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('orden', array('id'=>'Categoriaorden', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
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
