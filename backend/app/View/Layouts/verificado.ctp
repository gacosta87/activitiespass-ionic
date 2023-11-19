<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?= Configure::read('namesysT') ?></title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/bootstrap/css/bootstrap.min.css', 'AdminLTE-2.3.0');?>">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/bootstrap/css/font-awesome.min.css', 'AdminLTE-2.3.0');?>">
    <!-- Ionicons -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/bootstrap/css/ionicons.min.css', 'AdminLTE-2.3.0');?>">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/dist/css/AdminLTE.min.css', 'AdminLTE-2.3.0');?>">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= $this->Html->templateinclude('/plugins/iCheck/square/blue.css', 'AdminLTE-2.3.0');?>">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js', 'AdminLTE-2.3.0');?>"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js', 'AdminLTE-2.3.0');?>"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
      </div><!-- /.login-logo -->
      <?php echo $this->Flash->render(); ?>
      <?php echo $this->fetch('content'); ?>
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.4 -->
    <script src="<?= $this->Html->templateinclude('/plugins/jQuery/jQuery-2.1.4.min.js', 'AdminLTE-2.3.0');?>"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="<?= $this->Html->templateinclude('/bootstrap/js/bootstrap.min.js', 'AdminLTE-2.3.0');?>"></script>
    <!-- iCheck -->
    <script src="<?= $this->Html->templateinclude('/plugins/iCheck/icheck.min.js', 'AdminLTE-2.3.0');?>"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>