<section class="content-header">
  <h1>
    
    <small><?php echo __('Roles'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Dashboard/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Roles'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Add Role'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
					<?php echo $this->Form->create('Role', array('class'=>'form-horizontal')); ?>
					<div class='row'>
							<div class='col-md-12'>
								<?php
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Roletitle">Title</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('title', array('id'=>'Roletitle', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
	
echo'<div class="form-group">';	
echo'<label class="control-label col-md-2" for="Rolealias">Alias</label>';		
echo'<div class="col-md-9">';			
echo $this->Form->input('alias', array('id'=>'Rolealias', 'div'=>false, 'label'=>false, 'class'=>'form-control'));		
echo '</div>';	
echo '</div>';
?>

<!--------- Modulos -------->
<div class="form-group">
<label class="control-label col-md-2" for="Rolesmodulomodulo_id">Modulos</label>
<div class="col-md-9 col-sm-12 col-xs-12">
    <div class="box box-solid box-default">
        <div class="box-header with-border">
            <h3 class="box-title">Modulos</h3>
            <div class="box-tools pull-right">
                <button id="newModulosBtn" class="btn btn-box-tool" data-toggle="tooltip" title="Agregar otro modulo" data-widget="chat-pane-toggle"><i class="glyphicon glyphicon-plus"></i></button>
            </div><!-- /.box-tools -->
        </div><!-- /.box-header -->
        <div class="box-body">
            <div id="modulos-container">
                <div id="moduloscount">
                    <div class="form-group tel-con" id="modulo_0">
                        <label class="control-label col-md-2">Modulos</label>
                        <div class="col-md-3">
                            <select class="form-control tel-0" id="Modulos_0__Tipo" name="data[Afiliado][Modulos][0][tipo]" onchange="Javascript:manageExt(0);">
							<?php
	                             foreach($modulos as $modulo){
	                             	echo " <option value=\"".$modulo['Modulo']['id']."\">".$modulo['Modulo']['denominacion']."</option>";
	                             }
                             ?>
							</select>
                        </div>
                        <div class="col-md-1">
                            <button class="btn btn-danger btn-sm" onclick="return false;"><span class="glyphicon glyphicon-trash"></span></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>



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
<script type="text/javascript">
$(document).ready(function() {
    $("#newModulosBtn").click(function (e) {
        var MaxInputs       = 20;
        var x = $("#modulos-container #moduloscount").length + 1;
        var FieldCount = x-1;
        if(x <= MaxInputs) //max input box allowed
        {
            FieldCount++;
            $("#modulos-container").append('<div id="moduloscount">'+
            	                             '<div class="form-group tel-con" id="modulo_'+ FieldCount +'">'+
            	                             '<label class="control-label col-md-2">Modulos</label>'+ 
            	                             '<div class="col-md-3">'+
            	                             '<select class="form-control tel-0" id="Modulos_'+ FieldCount +'__Tipo" name="data[Afiliado][Modulos]['+ FieldCount +'][tipo]" onchange="Javascript:manageExt(0);">'+
	            	                             <?php
		            	                             foreach($modulos as $modulo){
		            	                             	echo "  '<option value=\"".$modulo['Modulo']['id']."\">".$modulo['Modulo']['denominacion']."</option>'+   ";
		            	                             }
	            	                             ?>
            	                             '</select>'+
            	                             '</div>'+            	                                        	                            
            	                             '<div class="col-md-1">'+ 
            	                             '<button class="btn btn-danger btn-sm" onclick="if(confirm(\'Seguro que desea eliminar el registro\')){  $(\'#modulo_'+ FieldCount +'\').remove(); } return false;"><span class="glyphicon glyphicon-trash"></span></button></div></div></div>');
            x++; //text box increment
        }
        return false;
    });
    
});
</script>