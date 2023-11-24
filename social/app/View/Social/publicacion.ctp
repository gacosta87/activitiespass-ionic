<html>
<head>
	<title>Olympus</title>
	<meta name="author" content="MyCars" />
	<?php if(isset($data[0]['Publicacione'])){ ?>
			<meta property="og:type"        content="article" />
			<meta property="fb:app_id"      content="278074326799502" />
			<meta property="description"    content="<?= substr($data[0]['Publicacione']['texto'],0 ,50) ?>">
			<meta property="og:title"       content="<?= $data[0]['Usuario']['nombre_apellido'] ?>. (@<?= $data[0]['Usuario']['username'] ?>) - Publicación en Olympus ">
			<meta property="og:description" content="<?= substr($data[0]['Publicacione']['texto'],0 ,50) ?>">
			<?php if(isset($data[0]['Publicacione']['imagen1_m'])){ ?>
			<meta property="og:image"       content="<?= $data[0]['Publicacione']['imagen1_m'] ?>">
			<meta property="og:image:url"   content="<?= $data[0]['Publicacione']['imagen1_m'] ?>">
			<?php } ?>
			<meta property="twitter:title"       content="<?= $data[0]['Usuario']['nombre_apellido'] ?>. (@<?= $data[0]['Usuario']['username'] ?>) - Publicación en Olympus ">
			<meta property="twitter:description" content="<?= substr($data[0]['Publicacione']['texto'],0 ,50) ?>">
			<?php if(isset($data[0]['Publicacione']['imagen1_m'])){ ?>
			<meta property="twitter:image"       content="<?= $data[0]['Publicacione']['imagen1_m'] ?>">
			<?php } ?>
    <?php } ?>
</head>
<body>
<?php if(isset($data[0]['Publicacione'])){ ?>
	<script type="text/javascript">
		location.href ="https://dashboard.olympusapp.es/pwa/#/perfilpostverall/<?= $data[0]['Publicacione']['id'] ?>/0";
	</script>
<?php } ?>
</body>
</html>
