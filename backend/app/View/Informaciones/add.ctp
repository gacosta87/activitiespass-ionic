<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Informaciones'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Informaciones'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Add Informacione'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Informacione', array('class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Informacionecategoria">Categoria</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('categoria', array('options'=>array(1=>'Terminos y condiciones', 2=>'Politicas de usos'), 'id'=>'Informacionecategoria', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Informacionetexto">Texto</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('texto', array('id'=>'Informacionetexto', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
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
