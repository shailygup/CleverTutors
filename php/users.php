<?php

require_once('../init.php');
loadScripts();

    $data = array("status" => "not set!");

    if(Utils::isPOST()) {
        // post means either to delete or add a user
        $parameters = new Parameters("POST");

        $action = $parameters->getValue('action');
        $user_name = $parameters->getValue('username');

        //$data = array("action" => $action, "user_name" => $user_name);
        if($action == 'delete' && !empty($user_name)) {

            $um = new UserManager();
            $um->deleteUser($user_name);
            $data = array("status" => "success", "msg" => "User '$user_name' deleted.");
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        } else if($action == 'update' && !empty($user_name)) {
            $newFirstName = $parameters->getValue('newFirstName');
            $newLastName = $parameters->getValue('newLastName');
            $newType = $parameters->getValue('newType');
            $newAddr = $parameters->getValue('newAddress');

            if(!empty($newFirstName) || !empty($newLastName) || !empty($newType) || !empty($newAddr)) {

                $um = new UserManager();
                $count = $um->updateUserFirstName($user_name, $newFirstName);
                $countLast = $um->updateUserLastName($user_name, $newLastName);
                $countType = $um->updateType($user_name, $newType);
                $countAddr = $um->updateAddress($user_name, $newAddr);
                if($count > 0) {
                    $data = array("status" => "success", "msg" =>
                        "User '$user_name' updated with new first name ('$newFirstName').");
                } else if($countType > 0){
                    $data = array("status" => "success", "msg" =>
                        "User '$user_name' was updated with new last name ('$newLastName').");
                }else if($countType > 0){
                    $data = array("status" => "success", "msg" =>
                        "User '$user_name' was updated with new type('$newType').");
                }else if($countAddr > 0){
                    $data = array("status" => "success", "msg" =>
                        "User '$user_name' was updated with new address('$newAddr').");
                }else{
                    $data = array("status" => "fail", "msg" =>
                        "User '$user_name' was not updated.");
                }
            } else {
                $data = array("status" => "fail", "msg" =>
                    "New user name must be present - value was '$newFirstName' for '$user_name'.");

            }
            echo json_encode($data, JSON_FORCE_OBJECT);
            return;

        } else if($action == 'add') {
            $newFirstName = $parameters->getValue('newFirstName');
            $newLastName = $parameters->getValue('newLastName');
            $newUserName = $parameters->getValue('newUserName');
            $newEmail = $parameters->getValue('newEmail');
            $newPassword = $parameters->getValue('newPassword');
            $newType = $parameters->getValue('newType');
            $newAddr = $parameters->getValue('newAddress');
            
            if(!empty($newFirstName) && !empty($newLastName) && !empty($newUserName) && !empty($newEmail) && !empty($newPassword) && !empty($newType) && !empty($newAddr)) {
                $data = array("status" => "success", "msg" => "User added.");
                $um = new UserManager();
                $um->addUser($newFirstName, $newLastName, $newUserName, $newEmail, $newPassword, $newType, $newAddr);

            } else {
                $data = array("status" => "fail", "msg" => "First name, last name, user name, password, email type and address cannot be empty.");
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
        $um = new UserManager();
        $rows = $um->listUsers();
        $html = "";
        if($rows != null) {

            foreach($rows as $row) {
                $first_name = $row['first_name'];
                $last_name = $row['last_name'];
                $email = $row['email'];
                $user_name = $row['user_name'];
                $password = $row['password'];
                $type = $row['type'];
                $address = $row['address'];

                $html .= "<tr>
                  <td class='first_name'><span>$first_name</span></td>
                  <td class='last_name'><span>$last_name</span></td>
                  <td class='email'>$email</td>
                  <td class='address'><span>$address</span></td>
                  <td class='user_name'>$user_name</td>
                  <td class='password'>$password</td>
                  <td class='type'><span>$type</span></td>
                  <td><button id='d-$user_name' class='delete bg-danger'>Delete</button></td><br/>
                  <td><input id='u-$user_name' class='update' type='button' value='Update'/></td><br/>
                  </tr>
                ";
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
