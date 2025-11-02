<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conexao.php');

$sql = "SELECT id_relogio, marca, modelo, num_serie, id_cliente FROM relogios";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de Relogios</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Relogios</h1>

   <table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Marca</th>
        <th>Modelo</th>
        <th>Número Serie</th>
        <th>ID do Cliente</th>
        <th>Ações</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id_relogio']}</td>";
            echo "<td>{$row['marca']}</td>";
            echo "<td>{$row['modelo']}</td>";
            echo "<td>{$row['num_serie']}</td>";
            echo "<td>{$row['id_cliente']}</td>";
            echo "<td>
                    <a href='EditarRelogio.php?id={$row['id_relogio']}'>Editar</a> |
                    <a href='ExcluirRelogio.php?id={$row['id_relogio']}' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Nenhum Relogio cadastrado.</td></tr>";
    }
    ?>
</table>
</body>
</html>
