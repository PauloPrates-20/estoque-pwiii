<?php

// Set the headers for the page
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

// Connects to the database
$conn = mysqli_connect("localhost", "root", "", "produtos");

// Get the data and decodes it
$json = file_get_contents("php://input");
$data = json_decode($json, true);

$produto = $data['produto'];
$preco = $data['preco'];
$qtd = $data['qtd'];

// Inserts the received data into the database
$query = "insert into produtos (nome, preco, qtd) values ('$produto', '$preco', '$qtd')";
if (mysqli_query($conn, $query)) {
    echo "Produto cadastrado com sucesso";
} else {
    echo "Falha ao cadastrar produto: " . mysqli_error($conn);
}

mysqli_close($conn);