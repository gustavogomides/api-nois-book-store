<?php
	$body = "body";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .="Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .="From: ianbrooks77@comcast.net" . "\r\n";
	mail("gustavo.gomides7@hotmail.com", "Your Recent Order From Ian's Coding Books Emporium!" ,$body, $headers);
?>