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
                    <h3 class="box-title"><?php echo __('Add Publicacione'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Publicacione', array("enctype"=>"multipart/form-data",  'class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>


<span>
		<p>1. Si vas agregar un post normal tienes que agregar Titulo, Texto, Imagen1</p>

		<p>2. Si vas agregar un post Descargar un libro, Debes agregar Titulo, Texto, url_descarga</p>

		<p>3. Si vas agregar un post que al darle clik sea como un libro, Debes agregar Titulo, Texto, Documentacion</p>

		<p>4. Si vas agregar un post que sea un video de Youtube debes agregar Titulo, Texto, ruta_video_1</p>
</span>
<br><br>


								<?php

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Publicidadetipo">Usuario</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('usuario_id', array('options'=>array(48=>'Personal'),  'id'=>'Publicidadetipo', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Publicidadetipo">Cuenta</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('mycar_id', array('options'=>array(48=>'Personal'),  'id'=>'Publicidadetipo', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Paratidetalleparaticategoria_id">Categoria</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('paraticategoria_id', array('id'=>'Paratidetalleparaticategoria_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Publicidadetipo">Tipo</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('tipo', array('options'=>array(3=>'Para ti'),  'id'=>'Publicidadetipo', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Publicidadetitulo">Titulo</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('titulo', array('id'=>'Publicidadetitulo', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Publicidadetitulo">Texto</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('texto', array('id'=>'Publicidadetitulo', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Publicidadeimagen">Url de Video</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('ruta_video_1', array('id'=>'Publicidadeimagen', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Paratidetalleparaticategoria_id">Imagen</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('imagen1', array('type'=>'file', 'id'=>'Paratidetalleparaticategoria_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Paratidetalleurl_descarga">Url de descarga</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('url_descarga', array('id'=>'Paratidetalleurl_descarga', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';


echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Paratidetalleurl_descarga">Documentacion</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('documentacion', array('id'=>'Informacionetexto', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';


	?>

	 <script>
      $(function () {
        // Replace the <textarea id="editor1"> with a CKEditor
        // instance, using default configuration.
        CKEDITOR.replace('Informacionetexto');
        //bootstrap WYSIHTML5 - text editor
        $(".textarea").wysihtml5();
      });
    </script>
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
