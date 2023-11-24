<html>
<head>
	<title>Olympus</title>
	<meta name="author" content="MyCars" />
	<?php if(isset($data[0]['Usuario'])){ ?>
		<meta property="og:type" content="article" />
		<meta property="fb:app_id" content="278074326799502" />
		<meta property="description" content="<?= $data[0]['Mycar']['descripcion'] ?>">
		<meta property="og:title"       content="<?= $data[0]['Usuario']['nombre_apellido'] ?>. (@<?= $data[0]['Usuario']['username'] ?>) - Perfil de Olympus ">
		<meta property="og:description" content="<?= $data[0]['Mycar']['descripcion'] ?>">
		<meta property="og:image"       content="<?= $data[0]['Usuario']['foto2'] ?>">
		<meta property="og:image:url"   content="<?= $data[0]['Usuario']['foto2'] ?>">

		<meta property="twitter:title"       content="<?= $data[0]['Usuario']['nombre_apellido'] ?>. (@<?= $data[0]['Usuario']['username'] ?>) - Perfil de Olympus ">
		<meta property="twitter:description" content="<?= $data[0]['Mycar']['descripcion'] ?>">
		<meta property="twitter:image"       content="<?= $data[0]['Usuario']['foto2'] ?>">
	<?php } ?>
</head>
<body>
<?php if(isset($data[0]['Usuario'])){ ?>
	<script type="text/javascript">
		location.href = "https://dashboard.olympusapp.es/pwa/#/perfilmycar/<?= $data[0]['Usuario']['id'] ?>";
	</script>
<?php } ?>
</body>
</html>
