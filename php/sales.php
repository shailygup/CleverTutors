<?php

require_once('../init.php');
loadScripts();

    $data = array("status" => "not set!");

    if(Utils::isPOST()) {
        // post means either to delete or add a user
        $parameters = new Parameters("POST");

        $action = $parameters->getValue('action');
        $id = $parameters->getValue('id');

        //$data = array("action" => $action, "user_name" => $user_name);
        if($action == 'delete' && !empty($id)) {

            $sm = new SalesManager();
            $sm->deleteCartRow($id);
            $data = array("status" => "success", "msg" => "Cart '$id' deleted.");
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        } 

    } else if(Utils::isGET()) {
        // get means get the list of users
        $sm = new SalesManager();
        $rows = $sm->listCartSales();
        $html = "";
        if($rows != null) {

            foreach($rows as $row) {
                $id = $row['ID'];
                $state = $row['state'];
                $time = $row['time'];
                $total = $row['total'];
                $html .= "<tr>
                  <td class='id'><span>$id</span></td>
                  <td class='state'><span>$state</span></td>
                  <td class='time'>$time</td>
                  <td class='total'>$total</td>
                  <td><button id='d-$id' class='delete bg-danger'>Delete</button></td><br/>
                  </tr>";
            }
            echo $html;

        } else {
            // shouldn't be but ...
            echo 'The returned rows is "null". No user table perhaps?';
        }

        return;

    } else {
        $data = array("status" => "error", "msg" => "Only GET and POST allowed.");
        echo json_encode($data, JSON_FORCE_OBJECT);
        header("location:../error.html");
    }



?>
