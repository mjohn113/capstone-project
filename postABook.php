<!doctype html>
<html lang="en">
    <head>
        <?php include("resources/includes/head.inc.php"); ?>
    </head>
    <body>
        <?php include("resources/includes/header.inc.php"); ?>
        <?php
			
		include_once("resources/functions/dbconnection.function.php");
		
		
		$message = "please enter a book";
		
			if(isset($_POST['title'])){
			
			$title = $_POST['title'];
			$isbn = $_POST['isbn'];
			$author = $_POST['author'];
			$price = $_POST['price'];
			$edition = $_POST['edition'];
			$publisher = $_POST['publisher'];
			$desc = $_POST['desc'];
			$condition = $_POST['condition'];
 			$day = $_POST['date'];
			$h = strlen($desc);


			//runs a select to see if book is already in the database if it is then check won't be equal to null if
			//if it is then that means book isn't in database 
			$check = dbconnection("spSelectIsbn('$isbn')");
			
			if($check == NULL){
			//if book isn't in database then adds it to it.
			dbconnection("spNewBook('$isbn' ,'$title', '$author', '$edition', '$publisher', 'NULL')");
			
			}
			//assigns the current users email to $email.
			$email = $_SESSION['user']['email'];
			
			//checks the length of book description if above 255 character limit of short description then sets short to null and uses long instead.


			dbconnection("spNewUserSellBook('$email', '$isbn', 'NULL', '$desc', '$condition', '$price', '$day')");
			$message = "book was posted.";
			
			
			

			
			


			
			$_POST = array();
			

			
			}
			
			

			
		?>
		
		<?php
		
		
			if(isset($_GET['isbn'])){
				
				
				$gtitle = $_GET['title'];
				$gauthor = $_GET['author'];
				$gisbn = $_GET['isbn'];
				$gedition = $_GET['edition'];
				
				
			}
		
		
		?>
        <main>
		<?php    include_once("resources/includes/check.php"); ?>

		
<br></br>
        <div  class="container-fluid" >


			<div class="row">

			<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="card bg-blue mt-5">
                    <div class="card-body px-4 text-white">
                        <h4 class="font-weight-bold text-center">Post a Book</h4>
                        <form action="postABook.php" method="post">
							<div class="form-group text-left">
								<label for="title">Title:</label>
								<input type="text" class="form-control" name="title" required <?php	if(isset($_GET['isbn'])){ echo 'value="' . $gtitle . '" style="background-color: #DCDCDC; " readonly '; }?>>
							</div>
							<div class="form-group text-left">
								<label for="isbn">ISBN:</label>
								<input type="text" class="form-control" name="isbn" required <?php	if(isset($_GET['isbn'])){ echo 'value="' . $gisbn . '" style="background-color: #DCDCDC; " readonly'; }?>>
							</div>
							<div class="row">
							<div class="form-group text-left col-sm-6">
								<label for="price">Price:</label>
								<input type="number" class="form-control" name="price" step="0.01" min="0" required>
							</div>
							<div class="form-group text-left col-sm-6">
								<label for="author">author:</label>
								<input type="text" class="form-control" name="author" required <?php	if(isset($_GET['isbn'])){ echo 'value="' . $gauthor . '" style="background-color: #DCDCDC; " readonly'; }?>>
							</div>
							<div class="form-group text-left col-sm-6">
								<label for="edition">edition:</label>
								<input type="text" class="form-control" name="edition" required <?php	if(isset($_GET['isbn'])){ echo 'value="' . $gedition . '" style="background-color: #DCDCDC; " readonly'; }?>>
							</div>
							<div class="form-group text-left col-sm-6">
								<label for="publisher">publisher:</label>
								<input type="text" class="form-control" name="publisher" required >
							</div>
							<div style="display: none;">
								<input type="date" id="today" name="date" value="">
							</div>
							</div>
							
							<div class="form-group text-left ">
								<label for="condition">Condition:</label>
								<select class="form-control" name="condition">
									<option value="Mint">Mint</option>
									<option value="Good">Good</option>
									<option value="Fair">Fair</option>
									<option value="Bad">Bad</option>
								</select>
							</div>
							
							<div class="form-group text-left">
								<label for="desc">Description</label>
								<textarea class="form-control" rows="5" cols="50" name="desc" placeholder="enter short description" maxlength="2500" ></textarea>
							</div>
								<button type="submit" class="btn btn-warning btn-block">Submit</button>
						</form>

                    </div>
					
					<?php
					
					echo '<p class="text-white text-center mb-2">' . $message . '</p> <br>';
					
					?>
                </div>
            </div>

		<script>
		
			document.getElementById("today").valueAsDate = new Date();
		
		</script>
		
		</div>
		</div>

			<br></br>

			
			

        </main>

        <?php include("resources/includes/footer.inc.php"); ?>
    </body>
</html>
