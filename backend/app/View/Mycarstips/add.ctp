<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Mycarstips'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Mycarstips'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Add Mycarstip'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Mycarstip', array("enctype"=>"multipart/form-data", 'class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycartiptitulo">Titulo</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('titulo', array('id'=>'Mycartiptitulo', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycartipdescripcion">Descripción corta</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('titulo2', array('id'=>'Mycartipdescripcion_corta', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycartipdescripcion">Descripción</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('descripcion', array('id'=>'Mycartipdescripcion', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycartipurl">Imagen miniatura</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('imagen', array('type'=>'file', 'id'=>'Mycartipurl', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycartipdescripcion">Tipo</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('tipo', array('id'=>'Mycartiptipo_url', 'options'=>array('1'=>'Imagen', '2'=>'Video'),  'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Mycartipurl">Video/imagen</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('url', array('type'=>'file', 'id'=>'Mycartipurl', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
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
<?php /* ?>	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
				<li><?php echo $this->Html->link(__('List Mycartips'), array('action' => 'index')); ?></li>
			</ul>
	</div>
<?php */ ?>

<script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('Mycartipdescripcion');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>