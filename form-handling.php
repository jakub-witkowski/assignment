<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'product-add.php';

if (!isset($_POST['sku'])) {
	die("Invalid submission data!");
}

$db_server = 'serwer2330608.home.pl';
$db_user = '36974722_assignment';
$db_pass = 'BazaTrening_2023';
$db_name = '36974722_assignment';

$mysqli = new mysqli($db_server, $db_user, $db_pass, $db_name);
if ($mysqli->connect_error) {
	die("Connection failed: " . $mysqli->connect_error);
}

$sku = $mysqli->real_escape_string($_POST['sku']);
$name = $mysqli->real_escape_string($_POST['name']);
$price = $mysqli->real_escape_string($_POST['price']);
$type = $mysqli->real_escape_string(strtolower($_POST['type']));
$size = $mysqli->real_escape_string($_POST['size']);
$weight = $mysqli->real_escape_string($_POST['weight']);
$height = $mysqli->real_escape_string($_POST['height']);
$width = $mysqli->real_escape_string($_POST['width']);
$length = $mysqli->real_escape_string($_POST['length']);

$result = $mysqli->query("SELECT * FROM products WHERE sku = '$sku'");

if ($result->num_rows > 0) {
	echo '<script>alert("SKU already in use!");</script>';
    }
else {
	if ($type === 'dvd') {
        $result = $mysqli->query("INSERT IGNORE INTO products (
		sku, 
		name, 
		price,
                type,
		size
	) VALUES (
		'$sku', 
		'$name', 
		'$price',
		'$type',
                '$size')
	");
        }
        else if ($type === 'book') {
        $result = $mysqli->query("INSERT IGNORE INTO products (
		sku, 
		name, 
		price,
                type,
		weight
	) VALUES (
		'$sku', 
		'$name', 
		'$price',
		'$type',
                '$weight')
	");
        }
        else if ($type === 'furniture') {
        $result = $mysqli->query("INSERT IGNORE INTO products (
		sku, 
		name, 
		price,
                type,
		height,
                width,
                length
	) VALUES (
		'$sku', 
		'$name', 
		'$price',
		'$type',
                '$height',
                '$width',
                '$length')
	");
        }
}

if ($result === true) {
    header('Location: index.php');
}
else {
	echo "SQL error." . $mysqli->error;
}

$mysqli->close();

