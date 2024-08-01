<?php

// Create connection
$conn = mysqli_connect("localhost", "root", "");

if (!$conn) {
    die("Falha na conexão: " . mysqli_connect_error());
}

// Create database
$query = "create database if not exists produtos";
if (mysqli_query($conn, $query)) {
    echo "Banco de dados criado com sucesso.";

    $conn = mysqli_connect("localhost", "root", "", "produtos");

    $query = "create table if not exists produtos (
        id int not null auto_increment primary key,
        nome varchar(45),
        preco float,
        qtd int
    )";

    if (mysqli_query($conn, $query)) {
        echo "Tabela criada com sucesso.";
    } else {
        echo "Erro ao criar tabela: " . mysqli_error($conn);
    }
} else {
    echo "Erro ao criar o banco de dados: " . mysqli_error($conn);
}

mysqli_close($conn);

header('location: dashboard.html');
exit;