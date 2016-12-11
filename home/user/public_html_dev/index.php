<?php 




$url = $_SERVER['HTTP_HOST'];

if (strpos($url,'dev.mydomain.com') !== false) { 
	// servidor produccion
	define('ENV','dev');
	define('DIR','/home/user/public_html_dev/');
}else if (strpos($url,'test.mydomain.com') !== false) { 
	// servidor produccion
	define('ENV','test');
	define('DIR','/home/user/public_html_test/');	
}else if (strpos($url,'mydomain.com') !== false) { 
	// servidor produccion
	define('ENV','prod');
	define('DIR','/home/user/public_html/');	
}else if (strpos($url,'localhost') !== false) {
	// localhost carlos
	define('ENV','localhost');
	define('DIR','/path/on/a/local/machine/');	
}else{
	define('ENV',''); 
}








echo "hello, this is a web app in".ENV.' environment';
?>