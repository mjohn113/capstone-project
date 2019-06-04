<!doctype html>
<html lang="en">
    <head>

        <?php include("resources/includes/head.inc.php"); ?>
		
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
    </head>
    <body>
        <?php include("resources/includes/header.inc.php"); ?>
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
						<h4><strong>Courses</strong></h4>
						<br>
						<h5>You can update your notifications for your registered course by selecting the notifications tab on the left.</h5>
						<br>

						<?php
						
							include_once("resources/functions/dbconnection.function.php");
						
							$user = $_SESSION['user']['email'];
							
							$result = dbconnection("spSelectUserRegisteredClasses('$user')");
							
							$a = 0;
							
							if(isset($_POST['crn'])){
								$rmclass = $_POST['crn'];
								dbconnection("spDeleteUserRegisteredClass('$user', '$rmclass')");
							}
							
							foreach($result as $row){
								

							
								echo '<h4 id="' . $a . '" class="' . $a . '"><a href="courseDetails.php?id=' . $row['courseID'] . '"><strong>' . $row['title'] . '</strong></a></h4>';		
								
							echo '<div id="' . $a . '" class="' . $a . ' container-fluid row">';
							
							echo '<div class="col-2" style="padding-left: 0;">';
								

								
								echo '<p>CRN: ' . $row['crn'] . '</p>';
								echo '<p>Campus: ' . $row['campus'] . '</p>';
								echo '<p>Credits: ' . $row['credits'] . '</p>';
								echo '<button onclick=" removeclass(' . $a . ', \'' . $row['crn'] . '\') " class="btn btn-lg bg-orange w-160p"><strong>Remove</strong></button>';
								
								//echo '<form action="#">';
								//echo '<button type="submit" class="btn btn-lg bg-orange w-160p"><strong>Book Info</strong></button>';
								//echo '</form>';
								
							echo '<br></br></div>';

							echo '<div class="col-10">';
							
							
							
								echo '<p>Start Date: ' . $row['startDate'] . ' End Date: ' . $row['endDate'] . '</p>';
								echo '<p>Meeting Days: ' . $row['meetDays'] . ' 	|	Meeting Times: ' . $row['startTime'] . '-' . $row['endTime'] . '</p>';
								echo '<p>Instructor: ' . $row['instructor'] . '</p>';
								//echo '<button onclick=" removeclass(' . $a . ', \'' . $row['crn'] . '\') " class="btn btn-lg bg-orange w-160p"><strong>Remove</strong></button>';


								
							echo '</div><br>';
							echo '</div>';

							
							$a++;
							
							}
							

							
						?>


						<script>
						
						function removeclass(str, num) {
	
						$.ajax({
							url:"profileCourses.php",
							type: "POST",
							data:{
								id: str,
								crn: num
							},
							success:function(data) {	
								$('.' + str).fadeOut();
							},
							error:function(data){
								alert("Whoops, something went wrong! Please try again.");
							}
						});
						
						}
						
						</script>
						
					</div>
                </div>
            </div>
        </main>

        <?php include("resources/includes/footer.inc.php"); ?>
    </body>
</html>
