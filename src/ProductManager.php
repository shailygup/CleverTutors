<?php

//require_once('./DBConnector.php');

//$um = new ProductManager();

// Facade
class ProductManager {

    private $db;

    public function __construct() {
        $this->db = DBConnector::getInstance();
    }

    public function listProducts() {
        $sql = "SELECT picture, name, item_price, quantity, description, type, uniqueID FROM product";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function findProduct($description) {
        $params = array(":description" => $description);
        $sql = "SELECT name, item_price, description, type FROM product WHERE description = :description";

        $rows = $this->db->query($sql, $params);
        if(count($rows) > 0) {
            return $rows[0];
        }

        return null;
    }

    public function deleteProduct($id) {
        $sql = "DELETE FROM product WHERE uniqueID = '$id'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function addProduct($name, $price, $desc, $type, $id, $pic, $qty) {

        $sql = "INSERT INTO product (picture, name, item_price, description, type, uniqueID, quantity)
            VALUES ('$pic', '$name', '$price', '$desc', '$type', '$id', '$qty')";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function updateName($id, $name) {
        $sql = "UPDATE product SET name = '$name' WHERE uniqueID = '$id'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function updateDesc($id, $desc) {
        $sql = "UPDATE product SET description = '$desc' WHERE uniqueID = '$id'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function updatePrice($id, $price) {
        $sql = "UPDATE product SET item_price = '$price' WHERE uniqueID = '$id'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function updateType($id, $type) {
        $sql = "UPDATE product SET type = '$type' WHERE uniqueID = '$id'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function updatePic($id, $pic) {
        $sql = "UPDATE product SET picture = '$pic' WHERE uniqueID = '$id'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }
    public function updateQty($id, $qty) {
        $sql = "UPDATE product SET quantity = '$qty' WHERE uniqueID = '$id'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }
}

?>
