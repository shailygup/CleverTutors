<?php

//require_once('./DBConnector.php');

//$um = new ShoppingCartManager();

// Facade
class ShoppingCartManager {

    private $db;

    public function __construct() {
        $this->db = DBConnector::getInstance();
    }

    public function listTotal($id) {
        $sql = "SELECT total FROM cart WHERE ID = $id";
        $rows = $this->db->query($sql);
        return $rows;
    }
    public function startCart() {
        $sql = "INSERT INTO cart (state, total) values ('started', 0.00)";
        $id = $this->db->getTransactionID($sql);
        // return id of the cart that was started
        return $id;
    }

    public function cancelCart($id) {
        $sql = "UPDATE cart SET state = 'cancelled' WHERE ID = $id";
        $count = $this->db->affectRows($sql);
        return $count;
    }

    public function checkoutCart($id) {

            $sql = "UPDATE cart SET state = 'checked out'WHERE ID = $id";
            $count = $this->db->affectRows($sql);
            return $count;
        
        
    }

    public function addItemsToCart($items, $cart_id) {

        foreach($items as $item) {
            $name = $item['name'];
            $qty = $item['qty'];

            // need to look up the ID of the product based on the name
            $sql = "SELECT ID FROM product WHERE name = '$name'";
            $rows = $this->db->query($sql);
            $product_id = $rows[0]['ID'];
            $sql = "INSERT INTO cart_product (product_id, cart_id, quantity)
                VALUES ($product_id, $cart_id, $qty)";
            $this->db->affectRows($sql);
        }

    }

    public function updateprodQty($items){
        foreach ($items as $item) {
            $qty = $item['qty'];
            $name = $item['name'];
            $sql="UPDATE product set quantity= GREATEST(0, quantity-$qty)  WHERE name='$name'";
            $count = $this->db->affectRows($sql);
            return $count;
        }
    }

    



}



?>
