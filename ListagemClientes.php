<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conexao.php');

$sql = "SELECT id_cliente, nome, sobrenome, cpf, tipo, telefone FROM clientes";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Clientes</h1>

   <table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Sobrenome</th>
        <th>CPF</th>
        <th>Tipo</th>
        <th>Telefone</th>
        <th>Ações</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id_cliente']}</td>";
            echo "<td>{$row['nome']}</td>";
            echo "<td>{$row['sobrenome']}</td>";
            echo "<td>{$row['cpf']}</td>";
            echo "<td>{$row['tipo']}</td>";
            echo "<td>{$row['telefone']}</td>";
            echo "<td>
                    <a href='EditarCliente.php?id={$row['id_cliente']}'>Editar</a> |
                    <a href='ExcluirCliente.php?id={$row['id_cliente']}' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Nenhum cliente cadastrado.</td></tr>";
    }
    ?>
</table>
