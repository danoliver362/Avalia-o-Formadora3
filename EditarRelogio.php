<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conexao.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("ID inválido.");
}

$stmt = $conn->prepare("SELECT id_relogio, marca, modelo, num_serie, id_cliente FROM relogios WHERE id_relogio = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if (!$row) {
    die("Relógio não encontrado.");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $marca = $_POST['marca'];
    $modelo = $_POST['modelo'];
    $num_serie = $_POST['num_serie'];
    $id_cliente = $_POST['id_cliente'];

    $stmt = $conn->prepare("UPDATE relogios SET marca=?, modelo=?, num_serie=?, id_cliente=? WHERE id_relogio=?");
    $stmt->bind_param("sssii", $marca, $modelo, $num_serie, $id_cliente, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Relógio atualizado com sucesso!'); window.location='ListagemRelogio.php';</script>";
        exit;
    } else {
        echo "Erro: " . $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Relógio</title>
</head>
<body>
    <h1>Editar Relógio</h1>
    <form method="post">
        <label>Marca:</label><br>
        <input type="text" name="marca" value="<?= htmlspecialchars($row['marca']) ?>" required><br><br>

        <label>Modelo:</label><br>
        <input type="text" name="modelo" value="<?= htmlspecialchars($row['modelo']) ?>" required><br><br>

        <label>Número de Série:</label><br>
        <input type="text" name="num_serie" value="<?= htmlspecialchars($row['num_serie']) ?>" required><br><br>

        <label>ID do Cliente:</label><br>
        <input type="number" name="id_cliente" value="<?= htmlspecialchars($row['id_cliente']) ?>" required><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
