<?php
    /**
     * This class will never be called directly, see ClassResults instead.
     * This class holds data for a single row.
     */
    class SingleClassResult {
        private $courseID;
        private $title;
        private $lastUpdated;
        private $credits;

        public function __construct($dbArrayRow) {
            $this->courseID = preg_replace("/-[0-9]*$/", "" ,$dbArrayRow["courseID"]);
            $this->title = $dbArrayRow["title"];
            $this->lastUpdated = $this->timeSinceDate(strtotime($dbArrayRow["lastUpdated"]));
            $this->credits = $dbArrayRow["credits"];
        }

        public function print() {
            echo "<div class='row mb-2'>
                    <div class='col'>
                        <a class='text-primary' href='courseDetails.php?id={$this->courseID}'>{$this->title}</a><br>
                        {$this->courseID}
                    </div>
                    <div class='col-sm-auto text-sm-right'>
                        Credit Hours: {$this->credits}<br>
                        Updated {$this->lastUpdated} ago.
                    </div>
                </div>\n";
        }

        public function getTitle() {return $this->title;}

        private function timeSinceDate($time) {
            $time = time() - $time;
            $time = ($time<1)? 1 : $time;
            $tokens = array (
                31536000 => 'year',
                2592000 => 'month',
                604800 => 'week',
                86400 => 'day',
                3600 => 'hour',
                60 => 'minute',
                1 => 'second'
            );
        
            foreach ($tokens as $unit => $text) {
                if ($time < $unit) continue;
                $numberOfUnits = floor($time / $unit);
                return $numberOfUnits.' '.$text.(($numberOfUnits>1)?'s':'');
            }
        }
    }
?>