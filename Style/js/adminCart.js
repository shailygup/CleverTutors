$(document).ready(function() {

            function loadSales() {
                $.ajax({
                    url: "./php/sales.php",
                    type: "GET",
                    dataType: 'html',
                    success: function(returnedData) {
                        //console.log("cart checkout response: ", returnedData);
                        $("#salesrows").html(returnedData);
                        //window.location.href = "user-editor.html";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.statusText, textStatus);
                    }
                });
            }

            loadSales();


            $('#sales').on('click', '.delete', function() {
                var loginValue = this.getAttribute("id");
                loginValue = loginValue.replace("d-", "");

                $.ajax({
                    url: "./php/sales.php",
                    type: "POST",
                    dataType: 'json',
                    data: {action: "delete", id: loginValue},
                    success: function(returnedData) {
                        loadSales();
                        console.log(returnedData);
                        //window.location.href = "user-editor.html";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.statusText, textStatus);
                    }
                });

            });



        });