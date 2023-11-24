<section class="content-header">
  <h1>
    
    <small><?php echo __('Usuarios del sistema'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Usuarios del sistema'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Edit Usuarios del sistema'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('User', array('class'=>'form-horizontal', 'onsubmit'=>'return validar_user();')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
									echo $this->Form->input('id', array('class'=>'form-horizontal'));	

									echo'<div class="form-group">';	
									echo'<label class="control-label col-md-2" for="Userrole_id">Nombre y Apellido</label>';		
									echo'<div class="col-md-9">';			
									echo $this->Form->input('nombre_apellido', array('id'=>'Userrole_id', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
									echo '</div>';	
									echo '</div>';
																		
									echo'<div class="form-group">';	
									echo'<label class="control-label col-md-2" for="Userusername">Username</label>';		
									echo'<div class="col-md-9">';			
									echo $this->Form->input('username', array('id'=>'Userusername', 'readonly'=>true, 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
									echo '</div>';	
									echo '</div>';
										
									echo'<div class="form-group">';	
									echo'<label class="control-label col-md-2" for="Userpassword">Password</label>';		
									echo'<div class="col-md-9">';			
									echo $this->Form->input('password', array('id'=>'Userpassword', 'div'=>false, 'label'=>false, 'class'=>'form-control'));
									echo $this->Form->input('password2', array('class'=>'form-control', 'type'=>'hidden', 'value'=>$this->request->data['User']['password'])); 	
									echo '</div>';	
									echo '</div>';

									echo'<div class="form-group">';	
									echo'<label class="control-label col-md-2" for="Userpassword">Confirmar password</label>';		
									echo'<div class="col-md-9">';			
									echo $this->Form->input('password3', array('id'=>'Userpassword2', 'div'=>false, 'label'=>false, 'class'=>'form-control', 'type'=>'password', 'value'=>$this->request->data['User']['password']));		
									echo '</div>';	
									echo '</div>';


									echo'<div class="form-group">';	
									echo'<label class="control-label col-md-2" for="foto">Foto</label>';
									echo'<div class="col-md-10">';

									?>
									<div class="row">
										<div class="col-md-5 text-center">
											<div id="upload-demo" style="width:350px"></div>
										</div>
										<div class="col-md-2" style="padding-top:30px;">
											<strong>Select Image:</strong>
											<br/>
											<input type="file" id="upload">
											<br/>
											<input class="btn btn-success upload-result" value="Recortar" type="button">
										</div>
										<div class="col-md-4" style="">
											<div id="upload-demo-i" style="background:#e1e1e1;width:300px;padding:50px;height:300px;margin-top:0px"></div>
										</div>
									</div>
									<script>
									var $uploadCrop;
									$uploadCrop = $('#upload-demo').croppie({
										enableExif: false,
										viewport: {
											width: 200,
											height: 200,
											type: 'circle'
										},
										boundary: {
											width: 300,
											height: 300
										}
									});
									$('#upload').on('change', function () { readFile(this); });
									$('.upload-result').on('click', function (ev) {
										$uploadCrop.croppie('result', {
											type: 'canvas',
											size: 'viewport'
										}).then(function (resp) {
											$.ajax({
													url: '<?= $this->Html->url('/Users/upload/') ?>',
													type: "POST",
													data: {"image":resp},
													success: function (data) {
														html = '<img src="' + resp + '" />';
														$("#upload-demo-i").html(html);
													}
											});
										});
									});
									</script>
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
<?php /* ?>	<div class="actions">
		<h3><?php echo __('Actions'); ?></h3>
		<ul>
				<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('User.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('User.id'))); ?></li>
				<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
			<li><?php echo $this->Html->link(__('List Roles'), array('controller' => 'roles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role'), array('controller' => 'roles', 'action' => 'add')); ?> </li>
		</ul>
	</div>
<?php */ ?>