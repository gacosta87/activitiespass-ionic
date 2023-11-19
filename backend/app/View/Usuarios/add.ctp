<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Usuarios'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Usuarios'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Add Usuario'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Usuario', array('class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuariomycar_id">Mycars</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('mycar_id', array('empty'=>'','id'=>'Usuariomycar_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuariorole_id">Rol</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('role_id', array('id'=>'Usuariorole_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuariousername">Username</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('username', array('id'=>'Usuariousername', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuarioclave">Clave</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('clave', array('id'=>'Usuarioclave', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuarioci">C.I</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('ci', array('id'=>'Usuarioci', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuariotelefono">Teléfono</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('telefono', array('id'=>'Usuariotelefono', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuarionombre_apellido">Nombre Apellido</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('nombre_apellido', array('id'=>'Usuarionombre_apellido', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuarionombres">Nombres</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('nombres', array('id'=>'Usuarionombres', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuarioapellidos">Apellidos</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('apellidos', array('id'=>'Usuarioapellidos', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';

	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuarioemail">Email</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('email', array('id'=>'Usuarioemail', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	

echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Usuariofechaingreso">Fecha ingreso</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('fechaingreso', array('type'=>'date2',  'id'=>'Usuariofechaingreso', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
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
