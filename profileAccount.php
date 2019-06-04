<?php include('resources/functions/account/account.listings.list.function.php'); ?>
<!doctype html>
<html lang="en">
    <head>
        <?php include("resources/includes/head.inc.php"); ?>
        <title>Profile | BookIt - KSU</title>
    </head>
    <body>
        <?php include("resources/includes/header.inc.php"); ?>
		<?php
		
		include_once("resources/functions/dbconnection.function.php");
		

			
			if(isset($_POST['email'])) {
				
				$newemail = $_POST['email'];
				$row = dbconnection("spSelectEmail('$newemail')");
				

				
				if($row == NULL){
				
				$message = "Email has been updated.";

                dbconnection("spUpdateUser(" . $_SESSION['user']['id'] . ",'" . $newemail . "','" . $_SESSION['user']['name'] . "','" . $_SESSION['user']['password'] . "')");
				$_SESSION['user']['email'] = $newemail;

				}else{ $message = "The email you have entered already exist within the database please enter new one."; }

				
				}
			
		?>
	    
	     <?php    include_once("resources/includes/check.php"); ?>
        <main>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-2 col-12 py-2 py-lg-3 pb-lg-4 bg-light" id="sidenav">
                        <nav class="nav nav-pills flex-column flex-sm-row flex-lg-column">
                            <a class="h5 mb-1 text-blue font-weight-bold flex-fill text-lg-right text-center nav-link" href="profileAccount.php">Account</a>
                            <a class="h5 mb-1 text-blue font-weight-bold flex-fill text-lg-right text-center nav-link" href="profileNotifications.php">Notifications</a>
                            <a class="h5 mb-1 text-blue font-weight-bold flex-fill text-lg-right text-center nav-link" href="profileCourses.php">Courses</a>
                            <a class="h5 mb-1 text-blue font-weight-bold flex-fill text-lg-right text-center nav-link" href="profileListings.php">Listings</a>
                        </nav>
                    </div>
                    <div class="col-12 col-lg-10 pt-4 pb-4">
                        <div class="mb-3">
                            <div class="row mb-3">
                                <div class="col-12">
                                    <h4 class="font-weight-bold">Account</h4>
                                </div>
                            </div>
                        </div>
                        <form action="" method="post">
                            <div class="row mb-4">
                                <div class="col-12 col-md-4">
                                    <div class="form-group mb-4">
                                        <label for="email">Email</label>
                                        <input type="text" id="email" name="email" class="form-control" value="<?php echo $_SESSION['user']['email']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control" value="<?php echo $_SESSION['user']['password']; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="confirm">Confirm Password</label>
                                        <input type="password" id="confirm" name="confirm" class="form-control" value="<?php echo $_SESSION['user']['password']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                            </div>
                        </form>
                        <?php
                            if(isset($_POST['password'])){
								if($_POST['password'] != $_SESSION['user']['password']){
									                                if($_POST['password'] == $_POST['confirm']){
									
									if(isset($_POST['password'])) {
									$newpass = $_POST['password'];
									dbconnection("spUpdateUser(" . $_SESSION['user']['id'] . ",'" . $_SESSION['user']['email'] . "','" . $_SESSION['user']['name'] . "','" . $newpass . "')");							
									}
									$_SESSION['user']['password'] = $newpass;
                                    echo '<p>Password was changed</p>';
                                }
                                else{
                                    echo '<p>Passwords do not match re-enter please.</p>';
                                }

								}
                            }
                        ?>
						<br>
						<p><?php
						if(isset($_POST['email']))
						echo $message;

						?></p>
                    </div>
                </div>
            </div>
        </main>

        <?php include("resources/includes/footer.inc.php"); ?>
    </body>

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"
            integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
            crossorigin="anonymous"></script>

    <script src="resources/js/account.listings.js"></script>
</html>
