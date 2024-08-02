<?php

// Set the headers for the page
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Connects to the database
$conn = mysqli_connect("localhost", "root", "", "produtos");

// Gets the json data and decodes it
$json = file_get_contents("php://input");
$data = json_decode($json, true);
$id = $data['id'];

// Deletes the product whose id matches the received id
$query = "delete from produtos where id = '$id'";

if (mysqli_query($conn, $query)) {
    echo "Produto deletado com sucesso.";
} else {
    echo "Falha ao deletar produto: " . mysqli_error($conn);
}

mysqli_close($conn);