<?php
    require_once("resources/functions/dbconnection.function.php");
    require_once("resources/functions/searchResults/singleBookResult.class.php");

    /**
     * This class will be used by the search results page.
     * It will hold data for multiple many rows of data
     */
    class BookResults {
        private $singleBookResultArray;
        private $searchString;

        /**
         * Use this to fetch the data for multiple rows of book results
         * @param searchString - The string the user entered in the search bar.
         */
         public function __construct($searchString) {
            $this->searchString = $searchString;
            $this->singleBookResultArray = array();
            $dbResult = dbconnection("spSelectBooks(\"{$searchString}\", NULL, NULL, NULL, NULL)");

            foreach ($dbResult as $row) {
                $this->singleBookResultArray[] = new SingleBookResult($row);
            }
        }

        /**
         * Use this function to print the formatted string for each row of data.
         */
        public function print() {
            echo "<h5 class='mb-0'><strong>Showing ". count($this->singleBookResultArray) ." results for \"{$this->searchString}\"</strong></h5><br>";
            foreach ($this->singleBookResultArray as $row) {
                $row->print();
            }
        }
    }
?>