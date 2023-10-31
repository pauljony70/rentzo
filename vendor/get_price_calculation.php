<?php

include('session.php');

$return = array();

$seller_price =  $_POST['seller_price'];


$inactive = "active";

$stmt = $conn->prepare("SELECT id, price_from, price_to,commission,status FROM seller_commission where FLOOR(price_from) <= " . $seller_price . " AND FLOOR(price_to) >=" . $seller_price . "  ORDER BY id ASC ");

$stmt->execute();

$data = $stmt->bind_result($col1, $price_from, $price_to, $commission, $col5);

$return = array();

$i = 0;

while ($stmt->fetch()) {

	echo number_format($seller_price * ((100 + number_format($commission)) / 100), 2);
}
