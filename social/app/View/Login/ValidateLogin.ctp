<div class="login-box-body">
  <p class="login-box-msg text-center">
      <img src="<?= $this->webroot.'img/logo.png' ?>" class="img-responsive" style="width:80%; margin-left:10%;" /><br />
      Ingresa tus credenciales para iniciar sesión
  </p>
  <?php echo $this->Form->create('Admin', array('url'=>'/Login/ValidateLogin', 'class'=>'login-form')); ?>
                <input name="__RequestVerificationToken" value="Bm32DspR8YBNgTTmioWAnfEi-zw0gQ0XnNYtdIneA9EFjeDsQOe7f5FLG3ZtBkt7-Rq5R7TU_vPeiYBQQPnbuLXzBPf_Ka9Uymdw7F0d8As1" type="hidden">            
            <div class="form-group has-feedback">
                <input class="form-control text-box single-line" id="Username" name="data[Admin][user]" placeholder="Usuario" value="" type="text">
                <span class="glyphicon glyphicon-user form-control-feedback"></span>
            </div>
            <div class="form-group has-feedback">
                <input class="form-control text-box single-line" id="Password" name="data[Admin][password]" placeholder="Contraseña" value="" type="password">
                <span class="glyphicon glyphicon-asterisk form-control-feedback"></span>
            </div>
            <div>
                <button type="submit" class="btn btn-sm btn-block btn-primary">Aceptar</button>
            </div>
  </form>
</div><!-- /.login-box-body -->