<?php
    require_once("resources/functions/searchResults/classResults.class.php");
    require_once("resources/functions/searchResults/bookResults.class.php");

    $search = "";
    $searchType = "courseNo";
    if (isset($_GET["search"]) && isset($_GET["searchType"])) {
        $search = $_GET["search"];
        $searchType = $_GET["searchType"];
    }
?>

<!doctype html>
<html lang="en">
    <head>
        <?php include("resources/includes/head.inc.php"); ?>
        <title>Search Results | BookIt - KSU</title>
    </head>
    <body>
        <?php include("resources/includes/header.inc.php"); ?>

        <main class="container mt-4">
            <div class="row">
                <div class="col">
                    <div class="container">
                        <form class="row" method="get" action="searchResults.php">
                            <div class="col-sm">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search" value="<?php echo($search)?>">
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="form-group">
                                    <select class="form-control" name="searchType">
                                        <?php if ($searchType=="courseNo") {?>
                                            <option value="courseNo" selected>Course No.</option>
                                            <option value="isbn">Book ISBN</option>
                                        <?php } else {?>
                                            <option value="courseNo">Course No.</option>
                                            <option value="isbn" selected>Book ISBN</option>
                                        <?php }?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="form-group">
                                    <button type="submit" class="btn bg-orange w-160p"><strong>Search</strong></button>
                                </div>
                            </div>
                        </form>
                        <?php
                            if ($searchType=="courseNo") {
                                $classResults = new ClassResults($search);
                                $classResults->print();
                            }
                            else {
                                $bookResults = new BookResults($search);
                                $bookResults->print();
                            }
                        ?>
                        <br>
                    </div>
                </div>
            </div>
        </main>

        <?php include("resources/includes/footer.inc.php"); ?>
    </body>
</html>