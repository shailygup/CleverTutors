<?php

//require_once('./DBConnector.php');

// Facade
class SalesManager {

    private $db;

    public function __construct() {
        $this->db = DBConnector::getInstance();
    }


    public function listCartSales() {
        $sql = "SELECT * FROM cart";
        $rows = $this->db->query($sql);
        return $rows;
    }


    public function deleteCartRow($id) {
        $sql = "DELETE FROM cart WHERE ID = '$id'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function listCartProductSales() {
        $sql = "SELECT * FROM cart_product";
        $rows = $this->db->query($sql);
        return $rows;
    }


    public function deleteCartProductRow($id) {
        $sql = "DELETE FROM cart_product WHERE ID = '$id'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }


}

?>
