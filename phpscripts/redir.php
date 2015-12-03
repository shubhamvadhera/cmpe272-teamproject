<?php
session_start();
$productid = $_GET['product'];
$userid = $_SESSION['username'];

//DB Credentials
$username = "vishwasm_admin";
$host = "localhost";
$database = "vishwasm_marketplace";
$password = "admin123";

//Connect to Database
$conn = connectDB($host, $database, $username, $password);

//Build insert Query
$queryI = buildInsertQuery($userid, $productid);
runInsertQuery($queryI, $conn);

function buildInsertQuery($userid, $productid) {
    $part1 = "INSERT INTO vishwasm_marketplace.userlog(user_id,product_id) VALUES(";
    $part2 = "'" . $userid . "'," . $productid.")";
    $query = $part1 . $part2;
    return $query;
}

function connectDB($host, $database, $username, $password) {
    if (!($conn = @mysql_connect($host, $username, $password))) {
        die("Could not connect to database" . mysql_error());
    }
    if (!mysql_select_db($database, $conn)) {
        die("Could not open database" . mysql_error());
    }

    return $conn;
}

function runInsertQuery($query, $conn) {
//echo "I run !";
    if (!mysql_query($query, $conn)) {
        die("Could not execute Insert query" . mysql_error());
    }
}

function runSelectQuery($query, $conn) {
    if (!$result = mysql_query($query, $conn)) {
        die("Could not execute select query" . mysql_error());
    }
    return $result;
}

$queryS = "SELECT product_ext_url FROM vishwasm_marketplace.products WHERE product_id = '" . $productid . "'";
$result = runSelectQuery($queryS, $conn);
//echo "Result is".mysql_result($result,0);
$numRows = mysql_num_rows($result);
if ($numRows != 1) {
    die("Fetch product_ext_url returned no rows or more than 1 rows");
}
$headerParm = "Location: " . mysql_result($result, 0);
header($headerParm);
?>