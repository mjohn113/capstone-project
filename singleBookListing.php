<?php 
    require_once("resources/functions/dbconnection.function.php");

    $bookID = "";
    if (empty($_GET["id"]) || !is_numeric($_GET["id"])) {
        die("Error: invalid book posting.");
    }
    $bookID = $_GET["id"];

    $bookData = dbconnection("spSelectUserSellBook({$bookID}, NULL, NULL, NULL, NULL, NULL)");
    if (count($bookData) != 1) {
        die("Error: invalid book posting.");
    }
    $bookData = $bookData[0];
    $photos = dbconnection("spSelectUserSellBookPhoto({$bookID})");
    $sellerInfo = dbconnection("spSelectEmail(\"". $bookData["email"] ."\")")[0];
?>
<!doctype html>
<html lang="en">
    <head>
        <title>Book Listing</title>
        <?php include("resources/includes/head.inc.php"); ?>
        <link type="text/css" rel="stylesheet" href="resources/css/lightslider.css">
        <script src="resources/js/lightslider.js"></script>
        <script src="resources/js/copyEmail.js"></script>
    </head> 
    <body>
        <?php include("resources/includes/header.inc.php"); ?>

        <main class="container my-4">
            <div class="row">
                <div class="col">
                    <h1 class="mt-2"><?php echo $bookData["title"];?></h1>
                    <h2 class="mt-2">Seller</h2>
                    <h4><?php echo $sellerInfo["name"];?></h4>
                    <h2 class="mt-2">ISBN</h2>
                    <h4><?php echo $bookData["bookISBN"];?></h4>
                    <h2 class="mt-2">Condition</h2>
                    <h4><?php echo $bookData["bookCondition"];?></h4>
                    <h2 class="mt-2">Price</h2>
                    <h4>$<?php
                            if (empty($bookData["price"])) {echo "0.00";}
                            else {echo $bookData["price"];}
                        ?></h4>
                    <h2 class="mt-2">Listing Description</h2>
                    <h4><?php echo $bookData["longDescription"];?></h4><br>
                    <button id="copyButton" class="btn bg-orange mb-4" type="button" onclick="copyEmail('<?php echo $bookData['email']; ?>')">Contact Seller</button>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <h1>Pictures</h1>
                    <?php if (count($photos) > 0) {?>
                        <ul id="lightSlider">
                            <?php
                                foreach($photos as $photo) {
                                    echo "<li>
                                        <img src='resources/images/{$photo['photoName']}' alt='Picture'>
                                    </li>";
                                }
                            ?>
                        </ul>
                    <?php }else {?>
                        <h4>There are no pictures for this book</h4>
                    <?php }?>
                </div>
            </div>
        </main>

        <?php include("resources/includes/footer.inc.php"); ?>

    </body>
</html>

<script type="text/javascript">
  $(document).ready(function() {
    $("#lightSlider").lightSlider(); 
  });
</script>