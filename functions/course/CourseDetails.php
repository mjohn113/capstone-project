<?php

require( $_SERVER["DOCUMENT_ROOT"] . "/" . "resources/functions/dbconnection.function.php");
require( $_SERVER["DOCUMENT_ROOT"] . "/" . "resources/functions/course/Course.class.php");
require( $_SERVER["DOCUMENT_ROOT"] . "/" . "resources/functions/course/Review.class.php");


/**
 * This class holds most of the data used for the courseDetails page.
 */
class CourseDetails
{
    private $id;
    private $term;
    private $title;
    private $creditHours;
    private $seatsOpen;
    private $sections = array();
    private $reviews = array();
    private $totalReviews = 0;
    private $overallReviewScore = 0.0;

    /**
     * CourseDetails constructor
     * @param $id
     *  The course ID to display course data for
     * @param $term
     *  The term to display course data for formatted as startDate:endDate (YYYY-MM-DD:YYYY-MM-DD)
     */
    public function __construct($id)
    {
        $this->id = $id;

        // Retrieve all sections for provided course ID/term
        $sections = dbconnection("spSelectClasses(null, \"" . $id . "\", null, null, null, null, null, null, null, null, null)");

        // If no sections are found for the provided course ID/term, search for all sections to retrieve basic data such as course title and credit hours
        if (sizeof($sections) == 0) {
            $sections = dbconnection("spSelectClasses(null, \"" . $id . "\", null, null, null, null, null, null, null, null, null)");

            if (isset($sections[0])) {
                $this->title = $sections[0]["title"];
                $this->creditHours = $sections[0]["credits"];
                $this->seatsOpen = 0;
            }

        }
        else {
            // If sections are found, loop through each, creating an array of Course objects
            foreach ($sections as $section) {
                $this->sections[] = new Course($section["crn"], $section["courseID"], $section["campus"], $section["credits"], $section["title"], $section["totalSeats"], $section["seatsRemaining"],
                    $section["instructor"], $section["startDate"], $section["endDate"], $section["location"], $section["startTime"], $section["endTime"], $section["meetDays"]);
                $this->seatsOpen += $section["seatsRemaining"];
            }

            $this->title = $this->sections[0]->getTitle();
            $this->creditHours = $this->sections[0]->getCredits();

            // Sort the sections so they can be displayed by campus
            ksort($this->sections);
        }

        // Retrieve all reviews for provided course ID
        $reviews = dbconnection("spSelectUserClassComment(\"" . $id . "\")");

        if (sizeof($reviews) > 0) {
            // If reviews are found, loop through each, creating an array of Review objects
            foreach ($reviews as $review) {
                $this->reviews[] = new Review($review["name"], $review["rating"], $review["semester"], $review["instructor"], $review["campus"], $review["shortDescription"]);
                $this->overallReviewScore += $review["rating"];
                $this->totalReviews++;
            }
        }

    }

    public function getSections()
    {
        return $this->sections;
    }

    public function setSections($sections)
    {
        $this->sections = $sections;
    }

    public function getReviews()
    {
        return $this->reviews;
    }

    public function setReviews($reviews)
    {
        $this->reviews = $reviews;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getTerm()
    {
        return $this->term;
    }

    public function setTerm($term)
    {
        $this->term = $term;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function getCreditHours()
    {
        return $this->creditHours;
    }

    public function setCreditHours($creditHours)
    {
        $this->creditHours = $creditHours;
    }

    public function getSeatsOpen()
    {
        return $this->seatsOpen;
    }

    public function setSeatsOpen($seatsOpen)
    {
        $this->seatsOpen = $seatsOpen;
    }

    /**
     * @brief Check if a user has already posted a review in a class.
     *
     * Loops through the array of reviews for a class, searching for a user.
     *
     * @param $user
     *  The display name of a user
     *
     * @return true if a user has posted a review, false if not
     */
    public function userPostedReview($user) {
        foreach ($this->reviews as $review) {
            if ($review->getName() == $user) {
                return true;
            }
        }

        return false;
    }

    /**
     * @brief Fetch all subscribed classes for a user.
     *
     * Loops through the subscribed courses for a user and adds their CRNs to an array.
     *
     * @param $user
     *  The display name of a user
     *
     * @return array
     *  Returns array of CRNs for subscribed classes of a user
     */
    public function getUserSubscribedCourses($user) {
        $sc[] = array();

        if ($user != null) {
            $subscribedCourses = dbconnection("spSelectUserRegisteredClasses(\"" . $user . "\")");

            foreach ($subscribedCourses as $course) {
                $sc[] = $course["crn"];
            }
        }

        return $sc;

    }

    /**
     * @brief Display full review section for a class.
     *
     */
    public function outputReviewSection() {
          echo'<div id="reviewPart"> 
            <div class="row">
            <div class="col-12">
                <h4 class="font-weight-bold mb-1">Reviews</h4>
            </div>';

          // Check if there are any reviews for this class
          if ($this->totalReviews > 0) {
              echo '<div class="col-12">';
              for ($i = 0; $i < round($this->overallReviewScore / $this->totalReviews); $i++) {
                  echo '<i class="fas fa-star text-orange"></i>';
              }
              while ($i != 5) {
                  echo '<i class="far fa-star text-orange"></i>';
                  $i++;
              }
              echo '<p>' . round($this->overallReviewScore / $this->totalReviews) . '/5 stars</p>';

              echo '</div>
            <div class="col-12">
                <h6>Sorting by newest (' . $this->totalReviews . ' of ' . $this->totalReviews . ' reviews)</h6>
            </div>';
          }
          else {
              echo'<div class="col-12"><p class="my-3">No reviews found.</p></div>';
          }
        echo '</div>
        <div class="row mb-4">
            <div class="col-12">';
                    // Check if a user is logged in
                    if(isset($_SESSION['user'])) {
                        // Check if a user has already posted a review for this class
                        if ($this->userPostedReview($_SESSION['user']['name'])) {
                            // Disable button if a user has already posted a review for this class
                            echo '<button type="button" class="btn btn-warning" disabled>
                                Review Submitted
                            </button>';
                        } else {
                            echo '<button type="button" id="postReviewButton" class="btn btn-warning" data-toggle="modal" data-target="#exampleModal">
                                Post Review
                            </button>';
                        }
                    }
                    else {
                        echo '<a href="login.php" class="btn btn-warning">
                            Login to Review
                        </a>';
                    }
           echo ' </div>
        </div>';
        // Loop through each review in class and display review details
        foreach ($this->getReviews() as $review) {
            echo '<div class="review mb-3">
                <div class="row mb-1">
                    <div class="col-12">
                        <h5 class="font-weight-bold">' . $review->getName() . '</h5>
                        <h6 class="d-sm-inline mr-sm-2"><i class="fas fa-chalkboard-teacher text-orange" aria-label="Professor"></i> '. $review->getInstructor() .'</h6>
                        <h6 class="d-sm-inline mr-sm-2"><i class="fas fa-calendar-day text-orange" aria-label="Semester"></i> ' . $review->getSemester() . '</h6>
                        <h6 class="d-sm-inline"><i class="fas fa-school text-orange" aria-label="Campus"></i> '. $review->getCampus(). '</h6>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <p class="mb-2">' . $review->getDescription() . '</p>
                    </div>
                    <div class="col-12">';
                            for ($i = 0; $i < $review->getRating(); $i++) {
                                echo '<i class="fas fa-star text-orange"></i>';
                            }
                            while ($i != 5) {
                                echo '<i class="far fa-star text-orange"></i>';
                                $i++;
                            }
                    echo '</div>
                </div>
            </div>';
        }
        echo '</div>';
        // Display new review form if a user is logged in
        if (isset($_SESSION['user'])){
            if (!$this->userPostedReview($_SESSION['user']['name'])) {
                $this->outputReviewForm($_SESSION['user']['email']);
            }
        }

    }

    /**
     * @brief Output the add new review form.
     *
     * @param $user
     *  The display name of a user
     *
     */
    public function outputReviewForm($user) {
        echo '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">New Review.class</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 d-none" id="checkForm">
                                <div class="alert alert-warning" id="checkMessage" role="alert">
                                  
                                </div>
                            </div>
                            <form action ="resources/functions/course/course.details.addreview.function.php" method="post">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="instructor">Instructor</label>
                                                <input type="text" id="instructor" name="instructor" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-12 col-md-6">
                                            <div class="form-group">
                                                <label for="campus">Campus</label>
                                                <select name="campus" id="campus" class="custom-select">
                                                    <option value="Kent">Kent</option>
                                                    <option value="Stark">Stark</option>
                                                    <option value="Ashtabula">Ashtabula</option>
                                                    <option value="East Liverpool">East Liverpool</option>
                                                    <option value="Salem">Salem</option>
                                                    <option value="Geauga">Geauga</option>
                                                    <option value="Trumbull">Trumbull</option>
                                                    <option value="Tuscarawas">Tuscarawas</option>
                                                    <option value="Online">Online</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-12 col-sm-6">
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <label for="semester">Semester</label>
                                                                <select name="semester" id="semester" class="custom-select">
                                                                    <option value="Spring">Spring</option>
                                                                    <option value="Summer">Summer</option>
                                                                    <option value="Fall">Fall</option>
                                                                </select>
                                                            </div>
                                                            <div class="col-6">
                                                                <label for="year">Year</label>
                                                                <input type="text" id="year" name="year" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-6">
                                                        <div class="form-group">
                                                            <label for="crn">CRN</label>
                                                            <select id="crn" name="crn" class="custom-select">';
                                                                foreach ($this->getSections() as $section) {
                                                                    echo '<option value="' . $section->getCrn() . '">' . $section->getCrn() . '</option>';
                                                                }
                                                            echo '</select>
                                                        </div>
                                                    </div>
                                                </div>
        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="reviewDescription">Write a little about your experience</label>
                                        <textarea class="form-control mb-3" id="reviewDescription" name="reviewDescription" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group mb-1">
                                        <label for="rating">Rating</label>
                                        <div id="rating">
                                            <i class="far fa-star fa-lg text-orange reviewStar" onclick="highlightStar(this)" id="oneStar"></i>
                                            <i class="far fa-star fa-lg text-orange reviewStar" onclick="highlightStar(this)" id="twoStar"></i>
                                            <i class="far fa-star fa-lg text-orange reviewStar" onclick="highlightStar(this)" id="threeStar"></i>
                                            <i class="far fa-star fa-lg text-orange reviewStar" onclick="highlightStar(this)" id="fourStar"></i>
                                            <i class="far fa-star fa-lg text-orange reviewStar" onclick="highlightStar(this)" id="fiveStar"></i>
                                        </div>
                                        <input type="hidden" id="ratingValue" value="0" name="ratingValue" />
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="addReview(\'' . $user . '\', \'' . $this->id . '\')" class="btn btn-warning">Post Review</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>';
    }


}