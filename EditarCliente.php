<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conexao.php');


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("ID inválido.");
}


$stmt = $conn->prepare("SELECT nome, sobrenome, cpf, tipo, telefone FROM clientes WHERE id_cliente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if (!$row) {
    die("Cliente não encontrado.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo'];
    $telefone = $_POST['telefone'];

    $stmt = $conn->prepare("UPDATE clientes SET nome=?, sobrenome=?, cpf=?, tipo=?, telefone=? WHERE id_cliente=?");
    $stmt->bind_param("sssssi", $nome, $sobrenome, $cpf, $tipo, $telefone, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Cliente atualizado com sucesso!'); window.location='ListarClientes.php';</script>";
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
    <title>Editar Cliente</title>
</head>
<body>
    <h1>Editar Cliente</h1>
    <form method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" value="<?= htmlspecialchars($row['nome']) ?>" required><br><br>

        <label>Sobrenome:</label><br>
        <input type="text" name="sobrenome" value="<?= htmlspecialchars($row['sobrenome']) ?>" required><br><br>

        <label>CPF:</label><br>
        <input type="text" name="cpf" value="<?= htmlspecialchars($row['cpf']) ?>" required><br><br>

        <label>Tipo:</label><br>
        <input type="text" name="tipo" value="<?= htmlspecialchars($row['tipo']) ?>" required><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone" value="<?= htmlspecialchars($row['telefone']) ?>" required><br><br>

        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>

