<?php

//error_reporting(E_ALL);
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_DEPRECATED);

$env = '';
if(isset($argv)){
	$env = $argv[1];
}else{
	if(isset($_GET['env'])) $env = $_GET['env'];
}

if(!$env) die('no env specified');
echo 'Selected environment: '.$env.'<br>';



define('DB_HOST','localhost');
// connect to db
if($env =='dev'){
	define('DIR','');
	define('DIR_BACKUP','');
	define('DB_USER','DB_USER_DEV');
	define('DB_PASS','DB_USER_PASS_DEV');
	define('DB_DB','DB_NAME_DEV');

}else if($env =='test'){
	define('DIR','');
	define('DIR_BACKUP','');
	define('DB_USER','DB_USER_TEST');
	define('DB_PASS','DB_USER_PASS_TEST');
	define('DB_DB','DB_NAME_TEST');

}else if($env =='prod'){
	define('DIR','');
	define('DIR_BACKUP','');
	define('DB_USER','DB_USER');
	define('DB_PASS','DB_USER_PASS');
	define('DB_DB','DB_NAME');
}else if($env == 'localhost'){
	define('DIR','');
	define('DIR_BACKUP','');
	define('DB_USER','DB_USER_LOCALHOST');
	define('DB_PASS','DB_USER_PASS_LOCALHOST'); 
	define('DB_DB','DB_NAME_LOCALHOST');
}else{
	die('No env available');   
}

// TODO: make a copy of the database here 
// mysqldump DB_NAME > DIR_BACKUP/copyTIMESTAMP.txt .          exec('mysqldump --user=... --password=... --host=... DB_NAME > /path/to/output/file.sql');




$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_DB);


$table_definition = Array();

$table_definition['usuarios']=Array(
	'definition'=>"CREATE TABLE `usuarios` (
                  `codigo` int(11) NOT NULL AUTO_INCREMENT,
                  `dni` VARCHAR(50) NOT NULL COLLATE 'utf8_bin',
                  `nombre` VARCHAR(100) NOT NULL COLLATE 'utf8_bin',
                  `email` VARCHAR(100) NOT NULL COLLATE 'utf8_bin',
	              `contrasenya` VARCHAR(100) NOT NULL COLLATE 'utf8_bin',
                  `telefono` VARCHAR(100) NOT NULL COLLATE 'utf8_bin',
                  `fecha_nacimiento` DATE NOT NULL,
                  `facebook` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_bin',
                  `twitter` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_bin',
                   PRIMARY KEY (`codigo`)
                ) COLLATE='utf8_bin' ENGINE=InnoDB AUTO_INCREMENT=2",
	'cols'=>Array(                    
		'codigo'=>Array('definition'=> "`codigo` int(11) NOT NULL AUTO_INCREMENT", 
						'type'=> 'int', 
						'size'=>11, 
						'allow_null'=>false,
						'default'=>'',
						'extra'=>'auto_increment'),                    
		'dni'=>Array('definition'=> "`dni` VARCHAR(50) NOT NULL COLLATE 'utf8_bin'", 
					 'type'=> 'varchar', 
					 'size'=>50, 
					 'allow_null'=>false,
					 'default'=>'',
					 'extra'=>''),
		'nombre'=>Array('definition'=> "`nombre` VARCHAR(100) NOT NULL COLLATE 'utf8_bin'", 
						'type'=> 'varchar', 
						'size'=>100, 
						'allow_null'=>false,
						'default'=>'',
						'extra'=>''),                                    
		'email'=>Array('definition'=> "`email` VARCHAR(100) NOT NULL COLLATE 'utf8_bin'", 
					   'type'=> 'varchar', 
					   'size'=>100, 
					   'allow_null'=>false,
					   'default'=>'',
					   'extra'=>''),

		'contrasenya'=>Array('definition'=> "`contrasenya` VARCHAR(100) NOT NULL COLLATE 'utf8_bin'", 
							 'type'=> 'varchar', 
							 'size'=>"100", 
							 'allow_null'=>false,
							 'default'=>'',
							 'extra'=>''),
		'telefono'=>Array('definition'=> "`telefono` VARCHAR(100) NOT NULL COLLATE 'utf8_bin'", 
						  'type'=> 'varchar', 
						  'size'=>"100", 
						  'allow_null'=>false,
						  'default'=>'',
						  'extra'=>''),
		'fecha_nacimiento'=>Array('definition'=> "`fecha_nacimiento` DATE NOT NULL", 
								  'type'=> 'int', 
								  'size'=>11, 
								  'allow_null'=>false,
								  'default'=>'',
								  'extra'=>''),
		'facebook'=>Array('definition'=> "`facebook` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_bin'", 
						  'type'=> 'varchar', 
						  'size'=>'200', 
						  'allow_null'=>true,
						  'default'=>'',
						  'extra'=>''),
		'twitter'=>Array('definition'=> "`twitter` VARCHAR(200) NULL DEFAULT NULL COLLATE 'utf8_bin'", 
						 'type'=> 'varchar', 
						 'size'=>'200', 
						 'allow_null'=>true,
						 'default'=>'',
						 'extra'=>''),               

	),                        
	'indexes' =>'',    
	'primary_key' => 'codigo',
	'engine' => '',
	'auto_increment'=> '',
	'default_charset' => '',
	'data'=>"INSERT INTO `usuarios` (`codigo`, `dni`, `nombre`, `email`, `contrasenya`, `telefono`, `fecha_nacimiento`, `facebook`, `twitter`) VALUES (1, '123123123f', 'Francisco', 'fran@somemail.com', '1234', '111222333', '1995-03-20', 'somefacebook', '@twitter');"
);



$table_definition['categorias']=Array(
	'definition'=>"CREATE TABLE `categorias` (
                `codigo` INT(11) NOT NULL,
                `nombre` VARCHAR(100) NOT NULL COLLATE 'utf8_bin',
                `padre` INT(11) NOT NULL DEFAULT '0',
                `imagen` VARCHAR(100) NOT NULL COLLATE 'utf8_bin',
                `url` VARCHAR(100) NOT NULL COLLATE 'utf8_bin',
	PRIMARY KEY (`codigo`)
) COLLATE='utf8_bin' ENGINE=InnoDB",
	'cols'=>Array(                    
		'codigo'=>Array('definition'=> "`codigo` INT(11) NOT NULL,", 
						'type'=> 'int', 
						'size'=>11, 
						'allow_null'=>false,
						'default'=>'',
						'extra'=>''),                    
		'nombre'=>Array('definition'=> "`nombre` VARCHAR(100) NOT NULL COLLATE 'utf8_bin'", 
						'type'=> 'varchar', 
						'size'=>100, 
						'allow_null'=>false,
						'default'=>'',
						'extra'=>''),
		'padre'=>Array('definition'=> "`padre` INT(11) NOT NULL DEFAULT '0'", 
					   'type'=> 'int', 
					   'size'=>11, 
					   'allow_null'=>false,
					   'default'=>'0',
					   'extra'=>''),                                    
		'imagen'=>Array('definition'=> "`imagen` VARCHAR(100) NOT NULL COLLATE 'utf8_bin'", 
						'type'=> 'varchar', 
						'size'=>100, 
						'allow_null'=>false,
						'default'=>'',
						'extra'=>''),

		'url'=>Array('definition'=> "`url` VARCHAR(100) NOT NULL COLLATE 'utf8_bin'", 
					 'type'=> 'varchar', 
					 'size'=>"100", 
					 'allow_null'=>false,
					 'default'=>'',
					 'extra'=>'')
	),                        
	'indexes' =>'',    
	'primary_key' => 'codigo',
	'engine' => '',
	'auto_increment'=> '',
	'default_charset' => '',
	'data'=>"INSERT INTO `categorias` (`codigo`, `nombre`, `padre`, `imagen`, `url`)
VALUES
	(0, 'Todas', 0, '', 'todas'),
	(1, 'Alimentacion', 0, '/img/categorias/alimentacion/alimentacion.jpg', 'alimentacion'),
	(2, 'Automoción', 0, '/img/categorias/automocion/automocion.jpg', 'automocion'),
;"
);


/*

ADD TABLES HERE
*/






// Fetch current tables
$current_tables = $mysqli->query("show tables");
if(!$current_tables) die('Error showing tables');
$aux = Array();
while($c = $current_tables->fetch_array()){
	$aux[$c[0]] = $c;
}
$current_tables = $aux;


// CREATE / UPDATE TABLES
// its only incremental, we dont delete tables or columns

// check tables and create if not
foreach($table_definition as $table => $table_info){
	if(!isset($current_tables[$table])){
		// install table
		$res = $mysqli->query($table_info['definition']);                
		if(!$res){
			die('E1: '.$mysqli->error.' -> on table'.$table);
		}        
	}else{
		// check columns and create (alter table) if so
		// check primary key and alter if so // SHOW KEYS FROM __correos WHERE Key_name = 'PRIMARY'
		// check indexes and alter if so    // SHOW indexes FROM __correos;
		$current_columns = $mysqli->query("show full columns from `".$table."`");
		if(!$current_columns) die('E2: '.$mysqli->error);
		$aux = Array();
		while($c = $current_columns->fetch_array()){
			$aux[$c['Field']] = $c; 
		}
		$current_columns = $aux;

		$columns = $table_info['cols'];
		foreach($columns as $col => $def){
			if(!isset($current_columns[$col])){
				echo 'Inserting col "'.$col.'" on table '.$table.'<br>';
				$sql = "alter table `".$table."` ADD COLUMN  ".$def['definition'];
				$inserting_col = $mysqli->query($sql);
				if(!$inserting_col) die('E3: '.$mysqli->error.' _on_ '.$sql);
			}else{
				//all ok (but we should test data type, length and so)   
			}

		}
	}
	// if it has data, lets put it
	if(isset($table_info['data'])){
		$queries = explode(';',$table_info['data']);
		echo 'Inserting data table '.$table.'<br>';
		foreach($queries as $q){
			if(!$q) continue;
			$res = $mysqli->query($q);   
			if(!$res) echo 'E4 (data): '.$mysqli->error;
		}
		echo '<br>';    


	}

}









?>