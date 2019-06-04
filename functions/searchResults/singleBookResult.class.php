<?php
    /**
     * This class will never be called directly, see BookResults instead.
     * This class holds data for a single row.
     */
    class SingleBookResult {
        private $isbn;
        private $title;
        private $author;
        private $edition;
        private $publisher;
        
        private $minPrice;
        private $maxPrice;
        private $numberOfListings;

        public function __construct($dbArrayRow) {
            $this->isbn = $dbArrayRow["isbn"];
            $this->title = $dbArrayRow["title"];
            $this->author = $dbArrayRow["author"];
            $this->edition = $dbArrayRow["edition"];
            $this->publisher = $dbArrayRow["publisher"];
            $this->getMinMaxPrice($this->isbn);
        }

        public function print() {
            $authorText;
            $editionText;
            $publisherText;
            $priceText;
            $listingsText;
            if (empty($this->author)) {$authorText = "";}
            else {$authorText = "Author: {$this->author} ";}
            if (empty($this->edition)) {$editionText = "";}
            else {$editionText = " Edition: {$this->edition}";}
            if (empty($this->publisher)) {$publisherText = "";}
            else {$publisherText = "Publisher: {$this->publisher} ";}
            if (empty($this->minPrice)) {$priceText = "";}
            else {$priceText = "Price Range: $". strval($this->minPrice) ." to $". strval($this->maxPrice) ."";}
            if (empty($this->numberOfListings)) {$listingsText = "There are no listings for this book.";}
            else {$listingsText = "There are {$this->numberOfListings} listings for this book.";}

            echo "<div class='row mb-2'>
                    <div class='col'>
                        <a class='text-primary' href='bookListings.php?isbn={$this->isbn}'>{$this->isbn} - {$this->title}{$editionText}</a><br>
                        {$authorText}{$publisherText}
                    </div>
                    <div class='col-sm-auto text-right'>
                        {$listingsText}<br>
                        {$priceText}
                    </div>
                </div>\n";
        }

        private function getMinMaxPrice($bookISBN) {
            require_once("resources/functions/dbconnection.function.php");

            $dbResult = dbconnection("spSelectUserSellBook(NULL, NULL, \"{$bookISBN}\", NULL, NULL, NULL)");
            if (count($dbResult) > 0) {
                $count = 0;
                foreach($dbResult as $row) {
                    if ($count == 0) {
                        $this->minPrice = $row['price'];
                        $this->maxPrice = $row['price'];
                    }
                    else {
                        if ($row['price'] < $this->minPrice) {$this->minPrice = $row['price'];}
                        elseif ($row['price'] > $this->maxPrice) {$this->maxPrice = $row['price'];}
                    }
                    $count = $count + 1;
                }
                $this->numberOfListings = $count;
            }
        }
    }
?>