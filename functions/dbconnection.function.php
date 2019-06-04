<?php
/** \file */
/**
 * This function is used to connect to the database and call stored procedures.
 * The string should contain the stored procedure name along with any input parameters in parenthesis.\n
 * Example: "spSelectUser(someemail@email, somepassword)"
 */
function dbconnection($spString)
{
    $dbuser = 'webuser';
    $dbpass = '123456';
    $dbconnstring = 'mysql:host=localhost;dbname=Capstone;';

    try {
        //Establish the connection.
        $pdo = new PDO($dbconnstring, $dbuser, $dbpass, array('charset' => 'utf8'));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = 'CALL ' . $spString;
        $pdo->query("SET CHARACTER SET utf8");
        $query = $pdo->query($sql);

        //Fetch the data
        $result = array();
        If (preg_match("/(spUpdate|spDelete|spNew){1}/", $sql) == 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $result[] = $row;
            }
        }

        //Terminate the connection and return the results
        $pdo = null;
        return $result;
    } catch (PDOException $e) {
        $pdo = null;
        die("Error occured: " . $e->getMessage());
    }
}
 