<?php

//require_once('./DBConnector.php');

//$um = new UserManager();

// Facade
class UserManager {

    private $db;

    public function __construct() {
        $this->db = DBConnector::getInstance();
    }

    public function getUserProfile($userName) {

        $rows = $this->db->query("select * from user where user_name = :name",
            array(':name' => $userName));
        //var_dump($rows[0]);
        if(count($rows) == 1) {
            return $rows[0];
        }
        // otherwise
        return null;
    }

    public function listUsers() {
        $sql = "SELECT user_name, first_name, last_name, email, address, password, type FROM user";
        $rows = $this->db->query($sql);
        return $rows;
    }

    public function updateUserFirstName($login, $newFirstName) {
        $sql = "UPDATE user SET first_name = '$newFirstName' WHERE user_name = '$login'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function updateUserLastName($login, $newLastName) {
        $sql = "UPDATE user SET last_name = '$newLastName' WHERE user_name = '$login'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function updateType($login, $type) {
        $sql = "UPDATE user SET type = '$type' WHERE user_name = '$login'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }
    public function updateAddress($login, $address) {
        $sql = "UPDATE user SET address = '$address' WHERE user_name = '$login'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function deleteUser($login) {
        $sql = "DELETE FROM user WHERE user_name = '$login'";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function addUser($firstName, $lastName, $userName, $email, $password, $type, $address) {

        $sql = "INSERT INTO user (first_name, last_name, user_name, email, password, type, address)
            VALUES ('$firstName', '$lastName', '$userName', '$email', MD5('$password'), '$type', '$address')";
        $affectedRows = $this->db->affectRows($sql);
        return $affectedRows;
    }

    public function findAdmin($usr, $pwd) {
        $params = array(":usr" => $usr, ":pwd" => $pwd);
        $sql = "SELECT * FROM user WHERE user_name = :usr AND password = :pwd AND type='admin'";

        $rows = $this->db->query($sql, $params);
        if(count($rows) > 0) {
            return $rows[0];
        }

        return null;
    }


}

?>
