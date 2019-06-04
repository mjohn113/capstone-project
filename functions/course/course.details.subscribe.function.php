<?php

require("../dbconnection.function.php");

if(isset($_POST['id'])) {
    subscribeUserTo($_POST['id'], $_POST['email']);
}

/** \file */
/**
 * @brief Subscribe a user to a specific class.
 *
 * Subscribes a user to a single class.
 *
 * @param $crn
 *  The CRN number of the section to subscribe a user to
 * @param $email
 *  The email address of a user to subscribe a section to
 */

function subscribeUserTo($crn, $email) {
    dbconnection("spNewUserRegisteredClass(\"" . $email . "\", \"" . $crn . "\")");
}