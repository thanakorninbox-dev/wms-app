<?php

//<><><><><><><><> MAIN TRCLOUD <><><><><><><><>//
if(true){
	$expire = "2027-01-01";
	// unique key
	$pinkey = "wms";
	/**
	 * default smtp server
	 */
	$SMTP = [];
	$SMTP['server'] = "smtp.gmail.com";
	$SMTP['username'] = "thanakorn.inbox@gmail.com";
	$SMTP['port'] = "587";
	$SMTP['password'] = "duuo vnad rdax hgpt";
	// password encoding
	$method = "AES-256-CBC";
	$iv = "1234567890123456"; // Must be exactly 16 bytes
	$SMTP['password'] = openssl_encrypt($SMTP['password'], $method, $pinkey, 0, $iv);

	
}
// configuration 


?>
