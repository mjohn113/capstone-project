<?php
require_once("resources/functions/dbconnection.function.php");

function updateNotifications($email, $notifications) {
    $allNotifications = dbconnection("spSelectNotifications");

    foreach ($allNotifications as $notification) {
        // If no notifications were sent from form, delete all
        if ($notifications == "" || $notifications == null) {
            dbconnection("spDeleteUserNotifications(\"" . $email . "\", \"" . $notification['type'] . "\")");
        }
        else {
            // If notifications were sent, check which ones are missing and delete
            if (!(in_array($notification['type'], $notifications))) {
                dbconnection("spDeleteUserNotifications(\"" . $email . "\", \"" . $notification['type'] . "\")");
            }
            // If notifications were sent, add the ones that were checked
            else {
                dbconnection("spNewUserNotifications(\"" . $email . "\", \"" . $notification['type'] . "\")");
            }
        }
    }

}
