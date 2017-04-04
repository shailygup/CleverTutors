<?php

require_once('../init.php');
loadScripts();

    $data = array("status" => "not set!");

    if(Utils::isGET()) {
        // get means get the list of users
        $sm = new SalesManager();
        $rows = $sm->listCartProductSales();
        $html = "";
        if($rows != null) {

            foreach($rows as $row) {
                $id = $row['ID'];
                $proid = $row['product_id'];
                $cid = $row['cart_id'];
                $qty = $row['quantity'];
                $time = $row['time'];
                $html .= "<tr>
                  <td class='id'><span>$id</span></td>
                  <td class='proid'><span>$proid</span></td>
                  <td class='cid'><span>$cid</span></td>
                  <td class='qty'>$qty</td>
                  <td class='time'>$time</td>
                  </tr>";
            }
            echo $html;

        } else {
            // shouldn't be but ...
            echo 'The returned rows is "null". No user table perhaps?';
        }

        return;

    } else {
        $data = array("status" => "error", "msg" => "Only GET allowed.");
        echo json_encode($data, JSON_FORCE_OBJECT);
        header("location:../error.html");
    }





?>
