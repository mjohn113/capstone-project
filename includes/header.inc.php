<?php

session_start();


if(isset($_GET['log'])){

unset($_SESSION['username']);
session_destroy();

header("Location: login.php");
exit;
}

   
?>


<div class="container-fluid bg-blue">
    <nav class="navbar navbar-expand-sm justify-content-between">
        <div class="row">
            <div class="col-12 pl-0 text-right">
                <a class="navbar-brand text-white mr-0 pb-0" href="#"><h1 class="font-weight-bold mb-0">BookIt</h1></a>
                <a href="#"><h5 class="text-orange font-weight-bold">Kent State</h5></a>
            </div>
        </div>
        <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse" data-target="#navbarText">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ml-sm-auto">
                <li class="nav-item">
                    <a class="nav-link mx-1 head-link text-center" href="index.php"><h5 class="font-weight-bold">Home</h5></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-1 head-link text-center" href="postABook.php"><h5 class="font-weight-bold">List a Book</h5></a>
                </li>
                <li class="nav-item dropdown" id="loggedIn">
                    <?php if (isset($_SESSION['user'])) { ?>
                        <a class="nav-link head-link mx-1 text-center" href id="navbardrop" data-toggle="dropdown">
                            <h5 class="font-weight-bold d-inline">
                                <?php echo($_SESSION['user']['name']); ?>
                            </h5>
                            <i class="fas fa-xs fa" id="chev"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right bg-light">
                            <h6 class="font-weight-bold text-center"><a href="profileAccount.php">Account</a></h6>
                            <h6 class="font-weight-bold text-center"><a href="login.php?log=1">Sign out</a></h6>
                        </div>
                    <?php } else { ?>
                        <a class="nav-link head-link mx-1 text-center" href="login.php">
                            <h5 class="font-weight-bold d-inline">Sign in</h5>
                        </a>
                    <?php } ?>
                </li>
                <li class="nav-item dropdown" id="headerSearch">
                    <a class="nav-link head-link mx-1 text-center" href id="navbardrop" data-toggle="dropdown">
                        <i class="fas fa-search"></i>
                        <i class="fas fa-xs fa" id="chev"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right bg-light">
                        <form method="get" action="searchResults.php">
                            <div class="input-group p-3">
                                <input type="text" name="search" placeholder="Search" class="form-control">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-warning">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                            <div class="input-group px-3 pb-3">
                                <select class="form-control" name="searchType">
                                    <option value="courseNo">Course No.</option>
                                    <option value="isbn">Book ISBN</option>
                                </select>
                            </div>
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
