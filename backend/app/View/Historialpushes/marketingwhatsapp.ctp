<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Envio de Whatsapp Marketing'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Envio de Whatsapp Marketing'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Add Envio de Whatsapp Marketing'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
          <?php echo $this->Form->create('Historialpush', array('class'=>'form-horizontal')); ?>
          <div class='row'>
              <div class='col-md-12'>
                <?php
  

echo'<div class="form-group">'; 
echo'<div class="col-md-12">';
  echo "1) Recuerda @usuario y sera reemplazado con el nombre del usuario.";
echo '</div>';  
echo '</div>';  

echo'<div class="form-group">'; 
echo'<div class="col-md-12">';
  echo "2) Los saltos de lineas se hacen normal con enter";
echo '</div>';  
echo '</div>';  

echo "<br><br>";

echo'<div class="form-group">'; 
echo'<label class="control-label col-md-2" for="Historialpushtexto">Texto</label>';   
echo'<div class="col-md-9">';     
echo $this->Form->input('texto', array('id'=>'Historialpushtexto', 'div'=>false, 'label'=>false, 'class'=>'form-control', 'type'=>'textarea'));   
echo '</div>';  
echo '</div>';
  

  ?>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                                  <div class="col-md-12">
                                      <input value="Guardar" class="btn btn-primary pull-right" type="submit">
                                  </div>
                              </div>
                            </div>
          </div></form>                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
