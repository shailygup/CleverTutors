
<?php

require_once('../init.php');
loadScripts();

    $data = array("status" => "not set!");

    if(Utils::isPOST()) {
        // post means either to delete or add a product
        $parameters = new Parameters("POST");

        $action = $parameters->getValue('action');
        $name = $parameters->getValue('name');
        $id = $parameters->getValue('id');

        //$data = array("action" => $action, "user_name" => $user_name);
        if($action == 'delete' && !empty($id)) {

            $pm = new ProductManager();
            $pm->deleteProduct($id);
            echo $name."\n";
            $data = array("status" => "success", "msg" => "Product '$name' deleted.");
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        } else if($action == 'update' && !empty($id)) {

            $newName = $parameters->getValue('newName');
            $newPrice = $parameters->getValue('newPrice');
            $newDesc = $parameters->getValue('newDesc');
            $newType = $parameters->getValue('newType');
            $newPic = $parameters->getValue('newPic');
            $newQty = $parameters->getValue('newQty');

            //$data = array("status" => "test", "msg" =>
             //           "Name: '$newName' , Price: '$newPrice', Description: '$newDesc', Type: '$newType' ");

            if(!empty($newName) || !empty($newDesc) || !empty($newPrice) || !empty($newType) || !empty($newPic) || !empty($newQty)) {

                $pm = new ProductManager();
                $count = $pm->updateName($id, $newName);
                $countDesc = $pm->updateDesc($id, $newDesc);
                $countPrice = $pm->updatePrice($id, $newPrice);
                $countType = $pm->updateType($id, $newType);
                $countPic = $pm->updatePic($id, $newPic);
                $countQty = $pm->updateQty($id, $newQty);

                if($count > 0) {
                    $data = array("status" => "success", "msg" =>
                        "Product '$name' updated with new name ('$newName').");
                } else if($countDesc > 0){
                    $data = array("status" => "success", "msg" =>
                        "Product '$name' was updated with new description ('$newDesc').");
                }else if($countPrice > 0){
                    $data = array("status" => "success", "msg" =>
                        "Product '$name' was updated with new price ('$newPrice').");    
                } else if($countType > 0){
                    $data = array("status" => "success", "msg" =>
                        "Product '$name' was updated with new type('$newType').");
                }else if($countPic > 0){
                    $data = array("status" => "success", "msg" =>
                        "Product '$name' was updated with new pic path('$newPic').");
                }else if($countQty > 0){
                    $data = array("status" => "success", "msg" =>
                        "Product '$name' was updated with new quantity('$newQty').");
                }else {
                    $data = array("status" => "fail", "msg" =>
                        "Product '$name' was not updated.");
                }
            } else {
                $data = array("status" => "fail", "msg" =>
                    "New product name must be present - value was '$newName' for '$name'.");

            }

            $data = array("status" => "test", "msg" =>
                        "Name: '$newName' , Price: '$newPrice', Description: '$newDesc', Type: '$newType' ");
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        }else if($action == 'add') {
            $newName = $parameters->getValue('newName');
            $newPrice = $parameters->getValue('newPrice');
            $newDesc = $parameters->getValue('newDesc');
            $newType = $parameters->getValue('newType');
            $newID = $parameters->getValue('newID');
            $newPic = $parameters->getValue('newPic');
            $newQty = $parameters->getValue('newQty');

            if(!empty($newName) && !empty($newPrice) && !empty($newDesc) && !empty($newType) && !empty($newID) && !empty($newPic) && !empty($newQty)) {
                $data = array("status" => "success", "msg" => "Product added.");
                $pm = new ProductManager();
                $pm->addProduct($newName, $newPrice, $newDesc, $newType, $newID, $newPic, $newQty);

            } else {
                $data = array("status" => "fail", "msg" => "Name, Price, Description and type cannot be empty.");
            }
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        }else {
            $data = array("status" => "fail", "msg" => "Action not understood.");
        }

        echo json_encode($data, JSON_FORCE_OBJECT);
        return;

        } else if(Utils::isGET()) {
            // get means get the list of users
            $pm = new ProductManager();
            $rows = $pm->listProducts();

            $html = "";
            $deplete = "";
            if($rows != null){
                foreach($rows as $row) {
                    $picture = $row['picture'];
                    $name = $row['name'];
                    $price = $row['item_price'];
                    $desc = $row['description'];
                    $type = $row['type'];
                    $qty=$row['quantity'];
                    $id = $row['uniqueID'];
                    $html .= "<tr>
                                <td class='id'><span>$id</span></td>
                                <td class='picture'><span>$picture</span></td>
                                <td class='name'><span>$name</span></td>
                                <td class='price'><span>$price</span></td>
                                <td class='type'><span>$type</span></td>
                                <td class='desc'><span>$desc</span></td>
                                <td class='qty'><span>$qty</span></td>
                                <td><button id='d-$id' class='delete bg-danger'>Delete</button></td>
                                <td><input id='u-$id' class='update' type='button' value='Update'/></td><br/>
                              </tr>";
                    
                   
                    }else if($qty <= 5 && $qty >= 1){
                         $deplete = "<div class='alert alert-danger'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <strong>Ok This Is Urgent! Go Re-stock!</strong>
                                
                                
                            </div>";
                        echo $deplete;
                    }else if($qty == 0){
                        $deplete = "<div class='alert alert-danger'>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                <strong>OMG You are Crazy!! Some quantities have reached 0!!!</strong>
                                
                                
                            </div>";
                        echo $deplete;

                    }
                }
            echo $html;

        } else {
            // shouldn't be but ...
            echo 'The returned rows is "null". No product table perhaps?';
        }

        return;

    } else {
        $data = array("status" => "error", "msg" => "Only GET and POST allowed.");
        echo json_encode($data, JSON_FORCE_OBJECT);
        header("location:../error.html");
    }



?>