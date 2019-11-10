
<?php 
include 'incl/header.php';
include 'incl/nav.php';
if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
}

?>
<body>

<div class="container-fluid" style="margin-top: 20px;">
  <div class="row">
    <?php include 'incl/sidebar.php'; ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">View Ticket</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        	<?php
        	if ($user!=='') {?>
        	 	<a class="btn btn-primary" href="login.php">Logout</a>
        	 	<?php
        	 } 

        	 ?>
          
        </div>
      </div>
       <div class="container">
	 	<div class="row">
	 		<div class="col-md-2">
	 			
	 		</div>
	 		<div class="col-md-8" style="margin-top: 10px;">
	 			<?php 
	 			if (isset($_GET['id'])) {
	 				$eid=$_GET['id'];
	 				$esql = $conn->query("SELECT * from events where e_id = '$eid' ");
	 				$es = $conn->query("SELECT * from user where nid = '$user' ");
	 				$resu = mysqli_fetch_assoc($es);
	 				$uname=$resu['fname'];
	 			}
	 			if (isset($_POST['book'])) {
	 				$eid = $_POST['eid'];
	 				$uid = $_POST['uid'];
	 				$claz = $_POST['claz'];
	 				$selsql = $conn->query("SELECT * from ticket Where uid ='$user'");
	 				$selre = mysqli_num_rows($selsql);
	 				
	 				if ($user=='') {
	 					?>
	 					<script type="text/javascript">
	 						alert("lease login!");
	 						document.location.replace('login.php');
	 					</script>
	 				<?php
	 				}if ($uid=='' OR $eid=='' OR $claz=='') {
	 					?>
	 					<script type="text/javascript">
	 						alert("Please select a class to reserve the Ticket");
	 						document.location.replace('homepage.php');
	 					</script>
	 				<?php
	 				}if ($selre>=5) {
	 					?>
	 					<script type="text/javascript">
	 						alert("The maximum Tickets Should be 5 in number!");
	 						document.location.replace('homepage.php');
	 					</script>
	 				<?php
	 				}else  {
	 					$insr = $conn->query("INSERT into ticket(id,uid,eventid,class) values(NULL,'$uid', '$eid', '$claz')");
	 					?>
	 					<script type="text/javascript">
	 						alert("Ticket Booked successfully!");
	 						document.location.replace('homepage.php');
	 					</script>
	 				<?php	
	 				//mail function
	 				$mailto = $conn->query("SELECT * from users where uid='$uid'");
	 				$mailres = mysqli_fetch_assoc($mailto);
	 				$emai = $mailres['email'];




						}$to = $emai; // note the comma

						// Subject
						$subject = 'Churchill booking ticket';

						// Message
						$message = '
						<html>
						<head>
						  <title>Churchill</title>
						</head>
						<body>
						  <p>Here are the birthdays upcoming in August!</p>
						  <table>
						    <tr>
						      <th>Person</th><th>Day</th><th>Month</th><th>Year</th>
						    </tr>
						    <tr>
						      <td>Johny</td><td>10th</td><td>August</td><td>1970</td>
						    </tr>
						    <tr>
						      <td>Sally</td><td>17th</td><td>August</td><td>1973</td>
						    </tr>
						  </table>
						</body>
						</html>
						';

						// To send HTML mail, the Content-type header must be set
						$headers[] = 'MIME-Version: 1.0';
						$headers[] = 'Content-type: text/html; charset=iso-8859-1';

						// Additional headers
						$headers[] = $emai;
						$headers[] = 'From: Birthday Reminder <churchill@team.com>';

						// Mail it
						mail($to, $subject, $message, implode("\r\n", $headers));
	 				
	 			}

	 			 ?>
	 			 <?php while($res = mysqli_fetch_assoc($esql)): ?>
			         <div class="card flex-md-row mb-4 shadow-sm h-md-250" style="padding:">
			            <div class="card-body d-flex flex-column align-items-start bg-primary" style="color: white">
			            	<h2 class="bg-warning" style="text-align: center; padding: 3px;border-radius: 10px; color: white">Event:<strong class="d-inline-block mb-2 text-success"><?=strtoupper( $res['e_name'] )?></strong></h2>
			            	<P >Name: <?=$uname?></P>
			            	<P>VIP charges: <?= $res['vip'] ?></P>
			               	<P>Regular charges: <?= $res['regular'] ?></P>
			               <div class="mb-1 text-muted small">Event Date: <?= $res['e_date'] ?></div>
			               <p class="card-text mb-auto">Event Venue: <?= $res['e_venue'] ?></p>
			               <form action="reserve.php" method="post">
			               	<input type="hidden" name="eid" value="<?=$res['e_id'] ?> ">
			               	<input type="hidden" name="uid" value="<?=$user ?> "><br>
			               	<select class="form-control" name="claz">
			               		<option value="">--select</option>
			               		<option value="vip">VIP</option>
			               		<option value="Regular">Regular</option>
			               	</select><br>
			               	<input type="submit" name="book" class="btn btn-success" value="Reserve">

			               	
			               </form>
			            </div>
			            <img class="card-img-right flex-auto d-none d-lg-block" alt="Thumbnail [200x250]" src="//placeimg.com/250/250/nature" style="width: 500px; height: 300px;">
			         </div>
	 			 <?php endwhile ?>
	 			
	 		</div>
	 		<div class="col-md-2">
	 			
	 		</div>
	 	</div>
	 </div>

      
    </main>
  </div>
</div>
<?php
include 'incl/footer.php';

 ?>