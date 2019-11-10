			      <?php 
			      include 'incl/header.php'; 
			      if (isset($_POST['login'])) {
			      	$_SESSION['user']=$_POST['id'];
			      }
			      ?>
			      <div class="container">
			      	<div class="row">
			      	  <div class="col-md-3">
			      	  	
			      	  </div>
			      	  <div class="col-md-6">
			      	  	<h2 class="bg-primary" style="margin-top: 100px;border-radius: 20px;text-align: center; padding: 5px;">Login</h2>
			      	  	<div class="modal-body">
				      	
				      	<form action="homepage.php" method="post">
				      			<label>ID Number:</label>
				      			<input type="text" name="id" placeholder="Enter your ID" class="form-control"><br>
				      			<label>Password:</label>
				      			<input type="password" name="pass" placeholder="Enter Password" class="form-control"><br>
				      		<input type="submit" name="login" class="btn btn-outline-success" value="Login">
				      		
				      	</form>
				        
				      </div>
			      	  </div>
			      	  <div class="col-md-3">
			      	  	
			      	  </div>
			      	</div>
			      </div><br><br><br><br>
			      
			      <?php include 'incl/footer.php'; ?>