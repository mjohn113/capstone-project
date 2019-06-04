<!doctype html>
<html lang="en">
    <head>
        <?php include("resources/includes/head.inc.php"); ?>
        <title>BookIt - KSU</title>
    </head>
    <body>
        <?php include("resources/includes/header.inc.php"); ?>
        
        <main class="container">
            <div class="row mt-5">
                <div class="col text-center">
                    <h3><strong>Find your next book or class</strong></h3>
                </div>
            </div>
            <div class="row">
                <div class="col text-center">
                    <form method="get" action="searchResults.php">
                        <div class="container">
                            <div class="row ml-auto mr-auto mt-2 w-480p">
                                <div class="col">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="search" placeholder="Search">
                                    </div>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="form-group">
                                        <select class="form-control" name="searchType">
                                            <option value="courseNo">Course No.</option>
                                            <option value="isbn">Book ISBN</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col">
                                    <div class="form-group">
                                        <button type="submit" class="btn bg-orange w-160p"><strong>Search</strong></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </main>

        <?php include("resources/includes/footer.inc.php"); ?>
    </body>
</html>