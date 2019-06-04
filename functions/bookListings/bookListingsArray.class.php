<?php
    require_once("resources/functions/dbconnection.function.php");
    require_once("resources/functions/bookListings/bookListings.class.php");

    /**
     * This class will be used by the book listings page.
     * It will hold data for multiple rows of data
     */
    class BookListingsArray {
        private $bookListingsArray;
        private $count;

        /**
         * Use this to fetch the data for multiple rows of book listings
         * @param isbn - The isbn that we will fetch results for.
         */
        public function __construct($isbn) {
            $this->bookListingsArray = array();
            $dbResult = dbconnection("spSelectUserSellBook(NULL, NULL, \"{$isbn}\", NULL, NULL, NULL)");

            $this->count = 0;
            foreach($dbResult as $row) {
                $this->bookListingsArray[] = new SingleClassResult($row);
                $this->count = $this->count + 1;
            }
        }

        /**
         * Use this function to print the formatted string for each row of data.
         */
        public function print() {
            foreach ($this->bookListingsArray as $row) {
                $row->print();
            }
        }

        public function getMinPrice() {
            if ($this->count == 0) {
                return 0.00;
            }

            $price = 10000.00;
            foreach ($this->bookListingsArray as $row) {
                if ($row->getPrice() < $price) {
                    $price = $row->getPrice();
                }
            }
            return $price;
        }

        public function getMaxPrice() {
            if ($this->count == 0) {
                return 0.00;
            }

            $price = 0.00;
            foreach ($this->bookListingsArray as $row) {
                if ($row->getPrice() > $price) {
                    $price = $row->getPrice();
                }
            }
            return $price;
        }

        public function getCount() {return $this->count;}
    }
?>