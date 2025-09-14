<?php
declare(strict_types=1);
/******************************************************************************
 * Project name: dc2
 * File name   : myconf.php
 * Version     : 1.0.0
 * Begin       : 2025-09-13
 * Last Update : 
 * Author      : Dâmaso Constantino - Lab. Muñoz Caro S.L.
 * License     : GNU-LGPL v3 (http://www.gnu.org/copyleft/lesser.html )
 * -------------------------------------------------------------------
 * Copyright (C) 2011-2024 - Lab. Muñoz Caro S.L.
 * 
 * Configure the Database access for mysqli and PDO
 * 
 *****************************************************************************/

// ------------------------
// MySQL Configuration :
// ------------------------

if (!isset($dbname))    {$dbname    = '25082_dc2';}		//Base de Datos: Nombre de Base de Datos
if (!isset($use_db))    {$use_db    = 'TRUE';}
if (!isset($host))      {$host      = 'localhost';}		//Base de Datos: Servidor
if (!isset($user))      {$user      = 'dc2_dbuser';}	//Base de Datos: Usuario
if (!isset($password))  {$password  = 'cZo2nfiURffPz.scNaLRHxvdtC_QUmh2';}	//Base de Datos: Password de Usuario
if (!isset($port))      {$port      = 3306;}
if (!isset($socket))    {$socket    = '';}

    
// ------------------------
// PDO Configuration :
// --
// If you need to modify, try to do it on MySQL Configuration
// ------------------------

if (!isset($DNS_prefix)){$DNS_prefix = "mysql";}
if (!isset($SERVER_NAME)){$SERVER_NAME = $host;}
if (!isset($DB_NAME)){$DB_NAME = $dbname;}
if (!isset($USERNAME)){$USERNAME = $user;}
if (!isset($PASSWORD)){$PASSWORD = $password;}

if (!isset($PDO_PORT)){$PDO_PORT = $port;}
if (!isset($PDO_DSN_prefix)){$PDO_DSN_prefix = 'mysql';}
if (!isset($PDO_charset))   {$PDO_charset = 'UTF8';}
