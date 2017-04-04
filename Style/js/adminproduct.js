/*globals $:false */
$(document).ready(function() {

            function loadProducts() {
                $.ajax({
                    url: "./php/products.php",
                    type: "GET",
                    dataType: 'html',
                    success: function(returnedData) {
                        //console.log("cart checkout response: ", returnedData);
                        $("#prodrows").html(returnedData);
                        //window.location.href = "user-editor.html";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.statusText, textStatus);
                    }
                });
            }

            loadProducts();


            $("#addNewProduct").submit(function(e) {
                e.preventDefault();

                // get values from form
                var name = $("#addName").val();
                var price = $("#addPrice").val();
                var desc = $("#addDesc").val();
                var type = $("#addProdType").val();
                var id = $("#addProdID").val();
                var qty = $("#addQty").val();
                var pic = $("#addPic").val();


                $.ajax({
                    url: "php/products.php",
                    type: "POST",
                    dataType: "JSON",
                    data: {action: "add", newName: name,
                        newPrice: price, newDesc: desc, newType: type, newID: id, newPic: pic, newQty: qty},
                    success: function(returnedData) {
                        loadProducts();
                        console.log(returnedData);
                        //clear all fields
                        $('#addNewProduct').trigger("reset");
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $("#p1").text(jqXHR.statusText);
                    }

                });

            });

            $('#products').on('click', '.delete', function() {
                var id = this.getAttribute("id");
                id = id.replace("d-", "");

                $.ajax({
                    url: "./php/products.php",
                    type: "POST",
                    data: {action: "delete", id: id},
                    success: function(returnedData) {
                        loadProducts();
                        console.log(returnedData);
                        //window.location.href = "user-editor.html";
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.statusText, textStatus);
                    }
                });

            });

            $('#products').on('click', '.update', function() {
                var id = this.getAttribute("id");
                id = id.replace("u-", "");

                var editedName = $(this).parent().parent().find(".name span").text();
                var editedDesc = $(this).parent().parent().find(".desc span").text();
                var editedPrice = $(this).parent().parent().find(".price span").text();
                var editedType = $(this).parent().parent().find(".type span").text();
                var editedPic = $(this).parent().parent().find(".picture span").text();
                var editedQty = $(this).parent().parent().find(".qty span").text();
                console.log(id, editedName, editedDesc, editedPrice, editedType, editedPic, editedQty);

                $.ajax({
                    url: "./php/products.php",
                    type: "POST",
                    data: {action: "update", id: id, newName: editedName, newDesc: editedDesc, newPrice: editedPrice,
                            newType: editedType, newPic: editedPic, newQty: editedQty},
                    success: function(returnedData) {
                        loadProducts();
                        console.log(returnedData);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.log(jqXHR.statusText, textStatus);
                    }
                });

            });


            // http://stackoverflow.com/questions/11882693/change-table-cell-from-span-to-input-on-click
            $('#products').on('click', 'span', function() {

                var $td = $(this).parent();
                var $input = null;

                var val = $(this).html();

                if($td.attr('class') === 'name' || $td.attr('class') === 'desc' || $td.attr('class') === 'price' 
                    || $td.attr('class') === 'type' || $td.attr('class') === 'picture' || $td.attr('class') === 'qty' ) {
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