<?php

require("../dbconnection.function.php");

// @cond
if(isset($_POST['email']) && isset($_POST['crn']) && isset($_POST['review']) && isset($_POST['rating'])
    && isset($_POST['instructor']) && isset($_POST['semester']) && isset($_POST['campus'])) {
    addReviewFor($_POST["email"], $_POST["crn"], $_POST["review"], $_POST["rating"], $_POST["instructor"], $_POST["semester"], $_POST["campus"]);
}
else {
    $response_array['status'] = 'error';
    $response_array['error'] = 'Please enter all fields.';
    header('Content-type: application/json');
    echo json_encode($response_array);
}
// @endcond

/** \file */
/**
 * @brief Add a review for a specific course.
 *
 * Adds a user review for a single course.
 * Returns an error if any of the data sent is empty.
 *
 * @param $email
 *  The email of the user posting the review
 * @param $crn
 *  The CRN number of class being reviewed
 * @param $review
 *  The written review description
 * @param $rating
 *  The rating of the class using a number 1-5
 * @param $instructor
 *  The name of the instructor that taught the class
 * @param $semester
 *  The semester the class was taken in form of [Spring/Summer/Fall] + [Year]
 * @param $campus
 *  The campus the class was taken at
 */
function addReviewFor($email, $crn, $review, $rating, $instructor, $semester, $campus) {
    dbconnection("spNewUserClassComment(\"" . $email . "\", \"" . $crn . "\", \"" . $review . "\", \"" . $rating . "\", null, \"" . $instructor . "\", \"" . $semester . "\", \"" . $campus . "\")");
}