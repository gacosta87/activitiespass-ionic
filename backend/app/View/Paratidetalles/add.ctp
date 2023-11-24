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
                    <h3 class="box-title"><?php echo __('Add Paratidetalle'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Paratidetalle', array("enctype"=>"multipart/form-data", 'class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Paratidetalleparaticategoria_id">Categoria</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('paraticategoria_id', array('id'=>'Paratidetalleparaticategoria_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Paratidetalletitulo">Titulo</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('titulo', array('id'=>'Paratidetalletitulo', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';
echo'<label class="control-label col-md-2" for="Paratidetalledocumentacion">Documentación/Descripción</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('documentacion', array('id'=>'Paratidetalledocumentacion', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Paratidetalleurl_foto">Url foto</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('url_foto', array('type'=>'file', 'id'=>'Paratidetalleurl_foto', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Paratidetalleurl_video">Url video</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('url_video', array('id'=>'Paratidetalleurl_video', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Paratidetalleurl_descarga">Url descarga</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('url_descarga', array('id'=>'Paratidetalleurl_descarga', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
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
