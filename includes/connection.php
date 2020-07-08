<?php

$sdn="mysql:host=localhost;dbname=sirel";
$username='root';
$password='ismael';


try{
$connection=new PDO($sdn, $username, $password,array(PDO::ATTR_EMULATE_PREPARES=>false,PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));

} catch (PDOException $e){
    throw new PDOException($e->getMessage());
}
     
    
?>