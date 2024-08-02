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
$produto = $data['produto'];
$preco = $data['preco'];
$qtd = $data['qtd'];

// Update the product whose id matches the received id
$query = "update produtos set nome = '$produto', preco = '$preco', qtd = '$qtd' where id = '$id'";

if (mysqli_query($conn, $query)) {
    echo "Produto modificado com sucesso.";
} else {
    echo "Erro ao modificar o produto: " . mysqli_error($conn);
}

mysqli_close($conn);