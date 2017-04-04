/*globals $:false */
$(document).ready(function() {

            function loadUsers() {
                $.ajax({
                    url: "./php/users.php",
                    type: "GET",
                    dataType: 'html',
                    success: function(returnedData) {
                        //console.log("cart checkout response: ", returnedData);
                        $("#userrows").html(returnedData);
                        //window.location.href = "user-editor.html";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.statusText, textStatus);
                    }
                });
            }

            loadUsers();
            
            


            $("#addNewUser").submit(function(e) {
                e.preventDefault();

                // get values from form
                var firstName = $("#addFirstName").val();
                var lastName = $("#addLastName").val();
                var userName = $("#addUserName").val();
                var email = $("#addEmail").val();
                var address = $("#addAddress").val();
                var password= $("#addPassword").val();
                var type = $("#addType").val();
                //console.log(firstName, lastName, userName);

                $.ajax({
                    url: "./php/users.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {action: "add", newFirstName: firstName,
                        newLastName: lastName, newUserName: userName, newEmail: email, 
                        newPassword: password, newType: type, newAddress: address},
                    success: function(returnedData) {
                        loadUsers();
                        console.log(returnedData);
                        //clear all fields
                        $('#addNewUser').trigger("reset");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $("#p1").text(jqXHR.statusText);
                    }

                });

            });

            $('#users').on('click', '.delete', function() {
                var loginValue = this.getAttribute("id");
                loginValue = loginValue.replace("d-", "");

                $.ajax({
                    url: "./php/users.php",
                    type: "POST",
                    dataType: 'json',
                    data: {action: "delete", username: loginValue},
                    success: function(returnedData) {
                        loadUsers();
                        console.log(returnedData);
                        //window.location.href = "user-editor.html";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.statusText, textStatus);
                    }
                });

            });

             $('#users').on('click', '.update', function() {
                var loginValue = this.getAttribute("id");
                //var firstName = $(this).val(
                loginValue = loginValue.replace("u-", "");
                var editedFirstName = $(this).parent().parent().find(".first_name span").text();
                var editedLastName = $(this).parent().parent().find(".last_name span").text();
                var editedType = $(this).parent().parent().find(".type span").text();
                var editedAddr = $(this).parent().parent().find(".address span").text();
                //console.log(loginValue, editedFirstName);

                $.ajax({
                    url: "./php/users.php",
                    type: "POST",
                    dataType: 'json',
                    data: {action: "update", username: loginValue, newFirstName: editedFirstName, newLastName: editedLastName,
                            newType: editedType, newAddress: editedAddr},
                    success: function(returnedData) {
                        loadUsers();
                        //console.log(returnedData);
                        //window.location.href = "user-editor.html";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.statusText, textStatus);
                    }
                });

            });


            // http://stackoverflow.com/questions/11882693/change-table-cell-from-span-to-input-on-click
            $('#users').on('click', 'span', function() {

                var $td = $(this).parent();
                var $input = null;

                var val = $(this).html();

                if($td.attr('class') === 'first_name' || $td.attr('class') === 'last_name' 
                    || $td.attr('class') === 'type' || $td.attr('class') === 'address') {
                    //var val = $(this).html();
                    $td.html('<input type="text" value="' + val + '"/>');
                    var $input = $td.find('input');
                    $input.focus();
                    $input.select();
                }

                if($input != null) {

                    $input.on('blur', function() {
                        $(this).parent().html('<span>' + $(this).val() + '</span>');
                    });

                    $input.keyup(function(e) {
                        if(e.which == 13) {
                            $(this).parent().html('<span>' + $(this).val() + '</span>');
                        } else if(e.which == 27) {
                            // escape key, means user canceled operation
                            $(this).parent().html('<span>' + val + '</span>');
                        }
                    });
                }
            });



        });