<?php
    require_once("resources/functions/dbconnection.function.php");
    require_once("resources/functions/searchResults/singleClassResult.class.php");

    /**
     * This class will be used by the search results page.
     * It will hold data for multiple rows of data
     */
    class ClassResults {
        private $singleClassResultArray;
        private $searchString;

        /**
         * Use this to fetch the data for multiple rows of class results
         * @param searchString - The string the user entered in the search bar.
         */
        public function __construct($searchString) {
            $this->searchString = $searchString;
            $this->singleClassResultArray = array();
            $dbResult = dbconnection("spSelectClasses(NULL, \"{$searchString}\", NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)");

            $count = -1;
            foreach ($dbResult as $row) {
                //If the current row has a different title as the previous row, create a new SingleClassResult
                if ($count == -1 || $row["title"] != $this->singleClassResultArray[$count]->getTitle()) {
                    $this->singleClassResultArray[] = new SingleClassResult($row);
                    $count = $count + 1;
                }
            }
        }

        /**
         * Use this function to print the formatted string for each row of data.
         */
        public function print() {
            if (count($this->singleClassResultArray) == 0) {
                echo "<h5 class='mb-0'><strong>There are no results for \"{$this->searchString}\"</strong></h5><br>";
            }
            else {
                echo "<h5 class='mb-0'><strong>Showing ". count($this->singleClassResultArray) ." results for \"{$this->searchString}\"</strong></h5><br>";
                foreach ($this->singleClassResultArray as $row) {
                    $row->print();
                }
            }
        }
    }
?>