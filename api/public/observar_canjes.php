<?php
	$ch = curl_init();
	curl_setopt( $ch,CURLOPT_URL, 'https://beautyaccess.jcloudtec.com/api/public/api/observar_canjes' );
	curl_setopt( $ch,CURLOPT_POST, true );
	curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt($ch, CURLOPT_FAILONERROR, TRUE);
	$result = curl_exec($ch);
	curl_close( $ch );
?>