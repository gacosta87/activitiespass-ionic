<!-- Main content -->
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div>
                <?php
                    if(isset($empresas[0]["Empresa"]["carpeta_imagen"])){
                           $img = $empresas[0]["Empresa"]["ruta_imagen"];
                    }else{
                            $img = "logo.png";
                    }
                    echo $this->Html->image($img, array('alt' =>'Imagen', 'class'=>'img-responsive','style'=>'high:138px; margin-left: auto; margin-right: auto; border:none; width:308px;'));
                ?>
                <br />
                <p class="text-center text-blue text-bold"></p>
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
</section><!-- /.content -->