<?php

/*** begin our session ***/
require_once('../init.php');
loadScripts();
    
        
        $um = new UserManager();
        $errorMessage = "";

        $user = $_POST["user"];
        $password = $_POST["password"];
        $type = 'admin';
        if (isset($_GET["user"]) && !empty($_GET["user"])) {
            // these names don't all have to be the same but if we have several variables
            // then it makes sense to make them the same
            $user =  $_GET["user"];
        }
        if (isset($_GET["password"]) && !empty($_GET["password"])) {
            // these names don't all have to be the same but if we have several variables
            // then it makes sense to make them the same
            $password =  $_GET["password"];
        }
        $encrypted_password=md5($password);
        $count = $um->findAdmin($user, $encrypted_password);

        if($count>0){
            header("location:../admin.php");  
            
        }else {
            // $errorMessage= "<div class='alert alert-danger'>
            //                      <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
            //                             <p>Sorry you aren't authorized</p>
            //                             <i>If you think you should be, check you password and username again</i>
                                        
                                                    
            //                          </div><br/>";
            // echo $errorMessage;
            header("location:../index.php?msg=Invalid_Login+Not_Authorized");


        }
        



?>