<?php
declare(strict_types=1);
/******************************************************************************
 * Project name: dc2
 * File name   : productos.php
 * Version     : 1.0.0
 * Begin       : 2024-02-13
 * Last Update : 
 * Author      : Dâmaso Constantino & Dâmaso Constantino Muñoz - Lab. Muñoz Caro S.L.
 * License     : GNU-LGPL v3 (http://www.gnu.org/copyleft/lesser.html)
 * -------------------------------------------------------------------
 * Copyright (C) 2011-2024 - Lab. Muñoz Caro S.L.
 * 
 * -------------------------------------------------------------------
 * Version 
 * 
 *     
 *****************************************************************************/
namespace dc2\src;

class products {
    
    // The internal web ID
    //private int $idProductoTerminado;
    
    // The class ID of the product
    //private int $ID_ClaseProduct;
    
    // The product name
    //private string $Nombre ;
    
    // The internal code from Lab
    //private int $InternalCode;
    
    // The Ean13 BarCode
    //private string $BarCodeEan13;

    // The Ucp BarCode
    //private string $BarCodeUcp;

    // The weith
    //private float $Peso;

    // the pointer to DB Object
    private PDO $dbh;

    /**
     * The class constructor
     */
    public function __construct() {
        
        require 'include/myconf.php';
        
        $dsn = $DNS_prefix . ':host=' . $SERVER_NAME . ';dbname=' . $DB_NAME;
        $dsn .= (isset($PDO_charset) ? ';charset=' . $PDO_charset : '');
        $options = array (
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION );
        // Create a new PDO instanace
        try {
            $this->dbh = new PDO ($dsn, $USERNAME, $PASSWORD, $options);
            unset($PASSWORD);
        }		
        catch ( PDOException $e ) { // Catch any errors
            echo  __FILE__ . ' ' . __FUNCTION__ . ' ' .  __LINE__ . ' ' .  $e->__toString();
            die();
        }
    }

    /**
     * get
     * get all products from ProductoTerminado
     * 
     * @return array
     */
    public function get_products() : array {
        $sql = 'SELECT * FROM `ProductoTerminado`';
        try {        
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchall(PDO::FETCH_CLASS);
        }
        catch ( PDOException $e ) {
            die('ERROR on '. __FILE__ . ' ' . __FUNCTION__ . ' ' . __LINE__ . '<br>Connect Error (' . $e->__toString());
        }
        return($result);
     }

     public function get_product_name_by_id(int $id, string $language) : string {
        $sql = "SELECT Nombre FROM `ProductoTerminado_Nombre` WHERE `ID_productoterminado` = :id AND `ID_idioma` LIKE :language;";
        try {        
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->bindParam(':language', $language, PDO::PARAM_STR);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
        }
        catch ( PDOException $e ) {
            die('ERROR on '. __FILE__ . ' ' . __FUNCTION__ . ' ' . __LINE__ . '<br>Connect Error (' . $e->__toString());
        }
        return($result->Nombre);
     }


     /**
     * get_products_clases
     * get all products classes from ProdTerminado_Clases
     * 
     * @return array
     */
    public function get_products_clases() : array {
        $sql = 'SELECT * FROM `ProdTerminado_Clases`';
        try {        
            $stmt = $this->dbh->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchall(PDO::FETCH_CLASS);
        }
        catch ( PDOException $e ) {
            die('ERROR on '. __FILE__ . ' ' . __FUNCTION__ . ' ' . __LINE__ . '<br>Connect Error (' . $e->__toString());
        }
        return($result);
     }


     /**
     * get_products_clase_name_by_id
     * get classes name by id
      * 
      * @param int $id
      * @return string
      */
     public function get_products_clase_name_by_id(int $id) : string {
        $sql = 'SELECT ClassName FROM `ProdTerminado_Clases` WHERE `idProdTerminado_Clases` = :id;';
        try {        
            $stmt = $this->dbh->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_OBJ);
        }
        catch ( PDOException $e ) {
            die('ERROR on '. __FILE__ . ' ' . __FUNCTION__ . ' ' . __LINE__ . '<br>Connect Error (' . $e->__toString());
        }
        return($result->ClassName);
     }
}
