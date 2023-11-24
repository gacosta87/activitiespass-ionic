<?php
    //header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
	echo $content_for_layout;
?>