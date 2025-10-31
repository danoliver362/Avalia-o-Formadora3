<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conexao.php');

$sql = "SELECT id_ordem, descricao, data_entrada, valor, forma_pgt, garantia, id_relogio, status FROM ordem_servico";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Lista de OS</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Lista de Ordens de Serviços</h1>

   <table border="1" cellpadding="10">
    <tr>
        <th>ID</th>
        <th>Descricão</th>
        <th>Data Entrada</th>
        <th>Valor</th>
        <th>Forma de Pagamento</th>
        <th>Garantia</th>
        <th>ID do Relogio</th>
    </tr>

    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>{$row['id_ordem']}</td>";
            echo "<td>{$row['descricao']}</td>";
            echo "<td>{$row['data_entrada']}</td>";
            echo "<td>{$row['valor']}</td>";
            echo "<td>{$row['forma_pgt']}</td>";
            echo "<td>{$row['garantia']}</td>";
            echo "<td>{$row['id_relogio]}</td>"
            echo "<td>
                    <a href='EditarOrdem.php?id={$row['id_ordem']}'>Editar</a> |
                    <a href='ExcluirOrdem.php?id={$row['id_ordem']}' onclick='return confirm(\"Tem certeza que deseja excluir?\")'>Excluir</a>
                  </td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Nenhuma Ordem de Servico Cadastrada</td></tr>";
    }
    ?>
</table>
</body>
</html>
