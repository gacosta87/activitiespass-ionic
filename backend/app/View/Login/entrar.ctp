<div class="login-box-body">
  <p class="login-box-msg text-center">
  <div align="center">
    <?php
      echo $this->Html->image("logo.png", array('alt' => 'Imagen', 'class'=>'img-responsive', 'style'=>'width:40%;'));
    ?>
  </div>
<br />
      Ingresa tus credenciales para iniciar sesión
  </p>
  <?php echo $this->Form->create('Usuario', array('url'=>'/Login/entrar', 'class'=>'login-form')); ?>
            <input name="__RequestVerificationToken" value="Bm32DspR8YBNgTTmioWAnfEi-zw0gQ0XnNYtdIneA9EFjeDsQOe7f5FLG3ZtBkt7-Rq5R7TU_vPeiYBQQPnbuLXzBPf_Ka9Uymdw7F0d8As1" type="hidden">            
            <div class="form-group has-feedback">
                <input class="form-control text-box single-line" id="Username" name="data[Usuario][user]" placeholder="Usuario" value="" type="text">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input class="form-control text-box single-line" id="clave" name="data[Usuario][clave]" placeholder="Contraseña" value="" type="password">
                <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
            </div>
                <button type="submit" class="btn btn-sm btn-block btn-primary">Aceptar</button>
            </div>
  </form>
</div><!-- /.login-box-body -->