<?php
    include('resources/functions/account/account.notifications.list.function.php');
    include('resources/functions/account/account.notifications.update.function.php');
?>
<!doctype html>
<html lang="en">
    <head>
        <?php include("resources/includes/head.inc.php"); ?>
    </head>
    <body>
        <?php
            include("resources/includes/header.inc.php");
            include_once("resources/includes/check.php");
            if (isset($_POST['submit'])) {
                updateNotifications($_SESSION['user']['email'], $_POST['type']);
            }
        ?>

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
                        <div class="row mb-3">
                            <div class="col-12">
                                <h4 class="font-weight-bold">Your Notifications</h4>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <h5>Email me if...</h5>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <form action="" method="post">
                                    <?php outputUserNotifications($_SESSION['user']['email']); ?>
                                    <button class="btn btn-warning" type="submit" name="submit">Update</button>
                                </form>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <p class="small">All emails will be sent to the email address found in <a href="profileAccount.php">Account</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php include("resources/includes/footer.inc.php"); ?>
    </body>
</html>