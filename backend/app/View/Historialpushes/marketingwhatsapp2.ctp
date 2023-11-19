<section class="content-header">
  <h1>
    <?= Configure::read('namesysS'); ?>    <small><?php echo __('Envio de Whatsapp Estadistica'); ?></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?= $this->Html->url('/Principal/')?>"><i class="fa fa-newspaper-o"></i> Inicio</a></li>
    <li class="active"><?php echo __('Envio de Whatsapp Estadistica'); ?></li>
  </ol>
</section>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title"><?php echo __('Add Envio de Whatsapp Estadistica'); ?></h3>
                    <hr>
                </div><!-- /.box-header -->
                <div class="box-body">
          <?php echo $this->Form->create('Historialpush', array('class'=>'form-horizontal')); ?>
          <div class='row'>
              <div class='col-md-12'>
                <?php
  

  ?>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                                  <div class="col-md-12">
                                      <input value="Enviar estadisticas" class="btn btn-primary pull-right" type="submit">
                                  </div>
                              </div>
                            </div>
          </div></form>                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->
