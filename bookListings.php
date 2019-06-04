
<?php 
    require_once("resources/functions/dbconnection.function.php");
    require_once("resources/functions/bookListings/bookListingsArray.class.php");
   
    $isbn ="";
    if (empty($_GET["isbn"]) || !is_numeric($_GET["isbn"])) {
        die("Error: invalid isbn.");
    }
    $isbn = $_GET["isbn"];

    $book = dbconnection("spSelectSingleBook( \"{$isbn}\")");
    if (count($book) != 1) {
        die("Error: invalid isbn.");
    }
    $book = $book[0];
    $array = new bookListingsArray($isbn);
?> 

<!doctype html>
<html lang="en">
    <head>
        <title>Book Listings</title>
        <?php include("resources/includes/head.inc.php"); ?>
        <script src="resources/js/listingsFilter.js"></script>
    </head> 
    <body>
        <?php include("resources/includes/header.inc.php"); ?>
        <main class= "container mt-4">
            <div class="row">
                <div class="col">
                    <h1 class="mt-2"><?php echo $book['title'];?></h1>
                    <h2>Author</h2>
                    <h4><?php echo $book['author'];?></h4>
                    <h2>ISBN</h2>
                    <h4><?php echo $book['isbn'];?></h4>
                    <h2>Edition</h2>
                    <h4><?php echo $book['edition'];?></h4>
                    <?php if (isset($_SESSION['user']['email'])) {?>
                        <a role="button" href="postABook.php?title=<?php echo $book['title'];?>&author=<?php echo $book['author'];?>&isbn=<?php echo $book['isbn'];?>&edition=<?php echo $book['edition'];?>" class="btn bg-orange">Sell Book</a>
                    <?php }else{?>
                        <button class="btn bg-orange disabled">Log In</button>
                    <?php }?>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-sm-3 mb-4">
                    <form>
                        <h2>Filters</h2>
                        <h4>Show Condition</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="conditionMint" checked>
                            <label class="form-check-label" for="conditionMint">
                                Mint
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="conditionGood" checked>
                            <label class="form-check-label" for="conditionGood">
                                Good
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="conditionFair" checked>
                            <label class="form-check-label" for="conditionFair">
                                Fair
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="conditionBad" checked>
                            <label class="form-check-label" for="conditionBad">
                                Bad
                            </label>
                        </div>
                        <h4>Price</h4>
                        <div class="form-row">
                            <div class="col">
                                <input class="form-control" type="number" id="minPrice" min="0" value="0">
                            </div>
                            <div class="col-auto">
                                to
                            </div>
                            <div class="col">
                                <input class="form-control" type="number" id="maxPrice" min="0" value="1000">   
                            </div>
                        </div>
                        <h4>Sort by</h4>
                        <div class="form-check">
                            <input class="form-check-input" name="sortPrice" type="radio" id="sortPriceLowHigh" checked>
                            <label class="form-check-label" for="sortPriceLowHigh">
                                Price (lowest)
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" name="sortPrice" type="radio" id="sortPriceHighLow">
                            <label class="form-check-label" for="sortPriceHighLow">
                                Price (highest)
                            </label>
                        </div>
                    </form>
                </div>
                <div class="col mb-4">
                    <h4><?php echo $array->getCount();?> Listings Found ($<?php echo $array->getMinPrice();?> - $<?php echo $array->getMaxPrice();?>)</h4>
                    <table class="table table-hover border">
                        <thead class="bg-blue text-light">
                            <tr>
                                <th scope="col">Seller</th>
                                <th scope="col">Condition</th>
                                <th scope="col">List Date</th>
                                <th scope="col">Price</th>
                                <th scope="col">View Listing</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $array->print();
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
        <?php include('resources/includes/footer.inc.php'); ?>
    </body>
</html>
