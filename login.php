<?php include('resources/functions/account/account.listings.list.function.php'); ?>
<!doctype html>
<html lang="en">
<head>
    <?php include("resources/includes/head.inc.php"); ?>
    <title>Sign in | BookIt - KSU</title>
</head>
<body>
<?php include("resources/includes/header.inc.php"); ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-4 offset-lg-4">
                <div class="card bg-blue mt-5">
                    <div class="card-body px-4 text-white">
                        <h4 class="font-weight-bold text-center">Sign in</h4>
                        <form action="userlogin.php" method="post">
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" name="email" class="form-control" id="email" required/>
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required/>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-warning w-100 mb-2">Submit</button>
                            </div>
                            <div class="form-group text-center">
                                <a href="register.php" class="text-white text-center mb-2">Need an account?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br />
</main>
</body>

<?php include("resources/includes/footer.inc.php"); ?>
