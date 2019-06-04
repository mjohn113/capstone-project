<?php
    /**
     * This class will never be called directly, see BookListingsArray instead.
     * This class holds data for a single row.
     */
    class SingleClassResult {
        private $seller;
        private $condition;
        private $listDate;
        private $price;
        private $id;

        public function __construct($dbArrayRow) {
            $this->seller = preg_replace("/@.*/", "", $dbArrayRow["email"]);
            $this->condition = $dbArrayRow["bookCondition"];
            $this->listDate = $dbArrayRow["postDate"];
            $this->price = $dbArrayRow["price"];
            $this->id = $dbArrayRow["id"];
        }

        public function print() {
            echo "<tr condition='{$this->condition}' price='{$this->price}'>
                <td>{$this->seller}</td>
                <td class='condition'>{$this->condition}</td>
                <td>{$this->listDate}</td>
                <td class='price'>$". $this->price ."</td>
                <td><a role='button' href='singleBookListing.php?id={$this->id}' class='btn bg-orange'>View Listing</a></td>
            </tr>";
        }

        public function getPrice() {return $this->price;}
    }
?>