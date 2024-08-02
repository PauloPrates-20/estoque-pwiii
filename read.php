<?php

// Set the headers for the page
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Connects to the database
$conn = mysqli_connect("localhost", "root", "", "produtos");

// Fetch the data from the database
$query = "select * from produtos";
$resultado = mysqli_query($conn, $query);

$products = [];

while ($row = mysqli_fetch_assoc($resultado)) {
    $products[] = $row;
}

echo json_encode($products);

mysqli_close($conn);