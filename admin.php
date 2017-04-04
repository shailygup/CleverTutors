
<?php include('headers_footers/adminHeader.html'); ?>

		<div id="editUser">
			<div id="page-wrapper">
			      <p><i>Edit customers</i></p>
			      <table id="users" border = 3 >
			        <thead>
			          <tr>
			            <th class="first_name_header">First Name</th><br/>
			            <th class="last_name_header">Last Name </th>
			            <th class="email_header">Email </th>
			            <th class="address_header">Address(shipping) </th>
			            <th class="login_header">User Name </th>
			            <th class="password_header">Password </th>
			            <th class="type_header">Type </th>
			            <th class="delete_header">Delete </th>
			            <th class="delete_header">Update </th>
			          </tr>
			        </thead>

			        <tbody id='userrows'>
			          <!-- THIS SECTION WILL BE REPLACED BY SERVER GENERATED ROWS -->
			          <tr>
			            <td class="first_name">aaa</td>
			            <td class="last_name">bbb</td>
			            <td class="email">someEmail</td>
			            <td class="user_name">uniqueloginname</td>
			            <td class="password">somePassword</td>
			            <td class="type">admin</td>
			            <td><input id="uniqueloginname" class="delete" type="button" value="Delete"/></td>
			          </tr>
			          <!-- THIS SECTION WILL BE REPLACED BY SERVER GENERATED ROWS -->
			        </tbody>
			      </table>​
			      <br/> <br/>
			      <h4>Add A New User</h4>
			      <br/>
			      <form id="addNewUser">
			        <input id="addFirstName" type="text" placeholder="first name" required="required"/> 
			        <input id="addLastName" type="text" placeholder="last name" required="required"/>
			        <input id="addUserName" type="text" placeholder="User name" required="required"/><br/></br>
			        <input id="addPassword" type="text" placeholder="Password" required="required"/>
			        <input id="addEmail" type="text" placeholder="Email" required="required"/>
			        <input id="addAddress" type="text" placeholder="Address" required="required"/><br/></br>
			        <labe>Type:</label>
			        <select name="type" id="addType">
			          	<option name="Admin">Admin</option>
					  	<option name="Customer">Customer</option>
					</select></br></br>
			        <button id="submitNewUser" type="submit" class = "bg-success">Add</button>
			      </form>
			    </div>

			    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			    <script src="Style/js/adminuser.js"></script>

		</div>
		<div id="editProduct">
			<div id="page-wrapper">
			      <p><i>Edit Product</i></p>
			      <div id="msg"></div>
			      <table id="products" border = 3 >
			        <thead>
			          <tr>
			          	<th class="ID_header">ID</th><br/>
			          	<th class="pic_header">Picture</th><br/>
			            <th class="name_header">Name</th><br/>
			            <th class="price_header">Price </th>
			            <th class="type_header">Type </th>
			            <th class="desc_header">Description </th>
			            <th class="qty_header">Quantity </th>
			            <th class="delete_header">Delete </th>
			            <th class="delete_header">Update </th>
			          </tr>
			        </thead>

			        <tbody id='prodrows'>
			          <!-- THIS SECTION WILL BE REPLACED BY SERVER GENERATED ROWS -->
			          <tr>
			            <td class="name">aaa</td>
			            <td class="price">bbb</td>
			            <td class="type">some</td>
			            <td class="desc">desc</td>
			            <td><input id="some" class="delete" type="button" value="Delete"/></td>
			          </tr>
			          <!-- THIS SECTION WILL BE REPLACED BY SERVER GENERATED ROWS -->
			        </tbody>
			      </table>​
			      <br/> <br/>
			      <h4>Add A New Product</h4>
			      <br/>
			      <form id="addNewProduct">
			      	<input id="addProdID" type="text" placeholder="ID" required="required"/> 
			      	<input id="addPic" type="text" placeholder="Picture Path" required="required"/> 
			        <input id="addName" type="text" placeholder="Name" required="required"/> <br/></br>
			        <input id="addPrice" type="number" placeholder="Price" required="required"/>
			        <input id="addDesc" type="text" placeholder="Description" required="required"/>
			        <input id="addQty" type="text" placeholder="Quantity" required/><br/><br/>
			        <labe>Type:</label>
			        <select name="type" id="addProdType">
			          	<option value="Textbook">TextBook</option>
					  	<option value="Worksheet">Worksheet</option>
					  	<option value="Study Guide">Study Guide</option>
					</select></br></br>
			        <button id="submitNewProduct" type="submit" class = "bg-success">Add</button>
			      </form>
			    </div>

			    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
			    <script src="Style/js/adminproduct.js"></script>

		</div>

		<div id="sales">
			<div id="page-wrapper">
		      <p><i>Check to see how many sales/day and how many sales are being cancelled/day: </i></p>
		      <table id="sales" border = 1>
		        <thead>
		          <tr>
		            <th class="ID_header">ID</th>
		            <th class="price_header">State</th>
		            <th class="time_header">Time </th>
		            <th class="total_header">Total </th>
		            <th class="delete_header">Delete </th>
		          </tr>
		        </thead>

		        <tbody id='salesrows'>
		          <!-- THIS SECTION WILL BE REPLACED BY SERVER GENERATED ROWS -->
		          <tr>
		            <td class="ID">bbb</td>
		            <td class="state">somePrice</td>
		            <td class="time">ballallala</td>
		            <td class="total">something</td>
		            <td><input id="d-name" class="delete" type="button" value="Delete"/></td>
		          </tr>
		          <!-- THIS SECTION WILL BE REPLACED BY SERVER GENERATED ROWS -->
		        </tbody>
		      </table>​
		      <br/> <br/> 
		      <p><i>Check to see which product are being baught the most: </i></p>
		      <table id="cartProduct" border = 1>
		        <thead>
		          <tr>
		            <th class="ID_header">ID</th>
		            <th class="prID_header">Product ID</th>
		            <th class="cartId_header">Cart ID </th>
		            <th class="qty_header">Quantity </th>
		            <th class="time_header">Time </th>
		          </tr>
		        </thead>

		        <tbody id='cartProdrows'>
		          <!-- THIS SECTION WILL BE REPLACED BY SERVER GENERATED ROWS -->
		          <tr>
		            <td class="ID">bbb</td>
		            <td class="prid">somePrice</td>
		            <td class="cid">ballallala</td>
		            <td class="qty">something</td>
		            <td class="time">something</td>
		          </tr>
		          <!-- THIS SECTION WILL BE REPLACED BY SERVER GENERATED ROWS -->
		        </tbody>
		      </table>​  
		    </div>

		    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		    <script src="Style/js/adminCart.js"></script>
		    <script src="Style/js/adminCartProduct.js"></script>
		</div>



<?php include('headers_footers/adminFooter.html'); ?>
	