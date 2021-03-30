<?php

        //mysql=>deprcated
		//mysqli=> use database=mysql 
		//PDO=> use 12 database
		
		$dsn="mysql:host=localhost;dbname=store;charset=utf8";
		$user="root";
		$pass="";
		$option=array(PDO::MYSQL_ATTR_INIT_COMMAND=>'SET NAMES utf8'); //اذا الموقع بالعربي نكتب هكذا 
		
		
		
		try{
			$con=new PDO($dsn,$user,$pass,$option);
			echo "Con";
			
			
		}
		catch (PDOException $e)
		{
			exit($e->getMessage());
		}


?>