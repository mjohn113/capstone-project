<!doctype html>
<html lang="en">
    <head>
        <?php include("resources/includes/head.inc.php"); ?>
    </head>
    <body>
        <?php include("resources/includes/header.inc.php"); ?>

        <main>
		<br></br>
        <div  class="container-fluid" >


			<div class="row">

			<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="card bg-blue mt-5">
                    <div class="card-body px-4 text-white">
                        <h4 class="font-weight-bold text-center">Create Account</h4>
                        <form action="post.php" method="post">
							<div class="form-group text-left">
								<label for="email">Email address:</label>
								<input type="email" class="form-control" name="email" required>
							</div>
							<div class="form-group text-left">
								<label for="email">Display Name:</label>
								<input type="text" class="form-control" name="dnam" required>
							</div>
							<div class="form-group text-left">
								<label for="pwd">Password:</label>
								<input type="password" class="form-control" name="pwd" required>
							</div>
							<div class="form-group text-left">
								<label for="pwd">Confirm Password:</label>
								<input type="password" class="form-control" name="confirm" required>
							</div>
								<button type="submit" class="btn btn-warning btn-block">Submit</button>
								<br></br>
								<a href="login.php" class="text-white text-center"><p>Already have an Account?</p></a>
						</form>
			
						<?php
						
						if(isset($_GET['error'])){
							if($_GET['error'] = 1){
								echo '<p class="text-white text-center">Passwords did not Match please re-enter information.</p>';
							}
						}
						?>
                    </div>
                </div>
            </div>


		</div>
		</div> 

	<br></br>
        </main>

        <?php include("resources/includes/footer.inc.php"); ?>
    </body>
</html>
