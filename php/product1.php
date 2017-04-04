<?php

require_once('../init.php');
loadScripts();

    $data = array("status" => "not set!");

    if(Utils::isGET()) {
        $pm = new ProductManager();
        $rows = $pm->listProducts();

        $html = "";
        foreach($rows as $row) {
            $pic = $row['picture'];
            $name = $row['name'];
            $price = $row['item_price'];
            $desc = $row['description'];
            $html .= "<div class='col-sm-3 col-xs-5' style='height:400px'>
                        <img src='$pic' alt='Picture'  width='50%' class='prodImage'/>
                        <h4 data-name-name='$name'>$name</h4>
                        <p data-name-desc='$name' style='color: #7D7F94'>$desc</p>
                        <p>$<span data-name-price='$name' class='price'>$price</span></p>
                        <span><input data-name-qty='$name' class='qty' type='number' value='1' min='1' max='10' step='1'/></span>
                        <input data-name-add='$name' class='btn btn-inverse' type='button' value='Add to Cart'/>
                      </div>
                    ";
        }
        echo $html;

    } else {
        header("location:../error.html");
        $data = array("status" => "error", "msg" => "Only GET allowed.");

    }
    return;

    echo json_encode($data, JSON_FORCE_OBJECT);

?>