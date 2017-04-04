<?php

require_once('../init.php');
loadScripts();

    $data = array("status" => "not set!");
    $html="";

    if(Utils::isPOST()) {
        $scm = new ShoppingCartManager();

        $parameters = new Parameters("POST");

        $action = $parameters->getValue('action');

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        switch($action) {
            case "startcart":
                $subtotal = $parameters->getValue('subtotal');
                // start the cart, so start session, create cart table in DB
                if(isset($_SESSION['started'])) {
                    $data = array("status" => "fail", "msg" => "You already have a cart started.");
                    echo json_encode($data, JSON_FORCE_OBJECT);
                    return;
                }

                $id = $scm->startCart();
                if(!empty($id)) {

                    $_SESSION['started'] = "true";
                    $_SESSION['id'] = $id;
                    //$data = array("status" => "success", "s_id", => session_id(),
                    //    "cart_id" => $id, "msg" => "Cart started.");
                    $data = array("status" => "success", "cart_id" => $id, "msg" => "Cart started.");


                } else {
                    $data = array("status" => "fail", "msg" => "Cart NOT started.",
                        "reasons" => Messages::getMessagesAsJSONArray());
                }

                break;
            case "cancelcart":
                // cancel the cart, end session, set cart row to 'cancelled'

                if(!isset($_SESSION['started'])) {
                    $data = array("status" => "fail", "msg" => "There is no cart to cancel.");
                     $html = "<div class='alert alert-danger'>
                                <strong>Sorry the cart is empty, therefore cancelling is out of option!</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                
                            </div>
                                ";
                        echo $html;
                    // echo json_encode($data, JSON_FORCE_OBJECT);
                    return;
                }
                $affectedRows = $scm->cancelCart($_SESSION['id']);
                if($affectedRows > 0) {
                    $html = "<div class='alert alert-success'>
                                <strong>The cart has been cancelled</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                
                            </div>
                                ";
                    echo $html;
                    session_unset();
                    session_destroy();
                    // $data = array("status" => "success", "msg" => "Cart cancelled.");

                } else {
                    // $data = array("status" => "fail", "msg" => "Cart NOT cancelled." ,
                    //     "reasons" => Messages::getMessagesAsJSONArray());
                    $html = "<div class='alert alert-danger'>
                                <strong>Sorry something went wrong with our server</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                
                            </div>
                                ";
                    echo $html;
                }

                break;
            case "checkoutcart":
                // check out the cart
                
            
                if(!isset($_SESSION['started'])) {
                    $html = "<div class='alert alert-danger'>
                                <strong>Please select an item to check out.</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                
                            </div>
                                ";
                    
                    $data = array("status" => "fail", "msg" => "There is no cart to check out.");
                    echo $html;
                    // echo json_encode($data, JSON_FORCE_OBJECT);

                    return;
                }

                // turn the JSON into an array of arrays (true means arrays and not objects)
                $items = json_decode($_POST['items'], true);
                
                $pm = new ProductManager();
                $rows = $pm->listProducts();
                
                if($rows != null){
                    foreach($rows as $row) {
                        $qty = $row['quantity'];

                            if($qty < 1){
                                $html = "<div class='alert alert-danger'>
                                    <strong>Sorry this product is out of stock. You can surely checkout our other products</strong>
                                    <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                    
                                </div>
                                    ";
                                echo $html;
                                return;
                        }
                    }
                }
                $scm->addItemsToCart($items, $_SESSION['id']);
                $scm->updateprodQty($items);
                $affectedRows = $scm->checkoutCart($_SESSION['id']);
                
                if($affectedRows > 0) {
                    // $scm->totalPrice($items, $_SESSION['id']);
                    // $scm->addTotal($_SESSION['id']);

                    session_unset();
                    session_destroy();
                    $data = array("status" => "success", "msg" => "Cart successfully checked out.", );
                    $html = "<div class='alert alert-success'>
                                <strong>Your products have been checked out</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                
                            </div>
                                ";
                    echo $html;


                } else {
                    $data = array("status" => "fail", "msg" => "Cart was NOT checked out.",
                        "reasons" => Messages::getMessagesAsJSONArray());

                    $html = "<div class='alert alert-danger'>
                                <strong>Sorry it wasn't checked out</strong>
                                <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
                                
                            </div>
                                ";
                    echo $html;
                }
                break;


            }
        }else {
        $data = array("status" => "error", "msg" => "Only POST allowed.");
        header("location:../error.html");

        }

    
    // echo json_encode($data, JSON_FORCE_OBJECT);



?>
