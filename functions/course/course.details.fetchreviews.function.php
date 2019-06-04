<?php
session_start();
require("CourseDetails.php");

// @cond
if(isset($_GET['id']))
    retrieveReviewsFor($_GET['id']);
// @endcond


/** \file */
/**
 * @brief Retrieve reviews for a class
 *
 * Creates a new CourseDetails object with provided class ID.
 * Outputs the reviews using the CourseDetails outputReviewSection() function.
 *
 * @param $id
 *  The ID of the course to fetch reviews for
 */
function retrieveReviewsFor($id) {
    $courseDetails = new CourseDetails($_GET["id"], "2019-06-10:2019-08-17");
    $courseDetails->outputReviewSection();
}