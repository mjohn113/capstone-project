<?php include('resources/functions/account/account.listings.list.function.php'); ?>
<!doctype html>
<html lang="en">
    <head>
        <?php include("resources/includes/head.inc.php"); ?>
        <title>Your Listings | BookIt - KSU</title>
    </head>
    <body>
        <?php include("resources/includes/header.inc.php"); ?>
        <?php include_once("resources/includes/check.php"); ?>
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
                                    <h4 class="font-weight-bold">Your Listings</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-none" id="no-listings">
                            <div class="row">
                                <h5>No active book listings.</h5>
                            </div>
                        </div>
                        <?php outputUserListings($_SESSION['user']['email']); ?>
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
