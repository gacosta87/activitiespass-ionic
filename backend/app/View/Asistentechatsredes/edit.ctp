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
                    <h3 class="box-title"><?php echo __('Edit Asistentechatsrede'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Asistentechatsrede', array('class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
			
echo $this->Form->input('id', array('class'=>'form-horizontal'));	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Asistentechatsredesender_id">sender_id</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('sender_id', array('id'=>'Asistentechatsredesender_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Asistentechatsrederecipient_id">recipient_id</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('recipient_id', array('id'=>'Asistentechatsrederecipient_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Asistentechatsredefields">fields</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('fields', array('id'=>'Asistentechatsredefields', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Asistentechatsrederole">role</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('role', array('id'=>'Asistentechatsrederole', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Asistentechatsredemensaje">mensaje</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('mensaje', array('id'=>'Asistentechatsredemensaje', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Asistentechatsredeactivo">activo</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('activo', array('id'=>'Asistentechatsredeactivo', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Asistentechatsredebandera">bandera</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('bandera', array('id'=>'Asistentechatsredebandera', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Asistentechatsredemensaje_id">mensaje_id</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('mensaje_id', array('id'=>'Asistentechatsredemensaje_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Asistentechatsredeupdated_at">updated_at</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('updated_at', array('id'=>'Asistentechatsredeupdated_at', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
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
