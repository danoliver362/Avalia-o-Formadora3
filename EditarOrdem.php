<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conexao.php');

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id <= 0) {
    die("ID inválido.");
}


$stmt = $conn->prepare("SELECT id_ordem, descricao, data_entrada, valor, form_pgt, garantia, id_relogio FROM ordem_servico WHERE id_ordem = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
if (!$row) {
    die("OS não encontrada.");
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $descricao = $_POST['descricao'];
    $data_entrada = $_POST['data_entrada'];
    $valor = $_POST['valor'];
    $forma_pgt = $_POST['forma_pgt'];
    $garantia = $_POST ['garantia'];
    $id_relogio = $_POST ['id_relogio'];

    $stmt = $conn->prepare("UPDATE ordem_servico SET descricao=?, data_entrada=?, valor=?, forma_pgt=?, garantia=?, id_relogio=? WHERE id_ordem=?");
    $stmt->bind_param("sssssi", $descricao, $data_entrada, $valor, $forma_pgt, $garantia, $id_relogio $id);

    if ($stmt->execute()) {
        echo "<script>alert('Ordem atualizado com sucesso!'); window.location='ListagemOrdem.php';</script>";
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
    <title>Editar OS</title>
</head>
<body>
    <h1>Editar Ordem de Serviço </h1>
    <form method="post">
        <label>Descrição:</label><br>
        <input type="text" name="descricao" value="<?= htmlspecialchars($row['descricao']) ?>" required><br><br>

        <label>Data de Entrada:</label><br>
        <input type="text" name="data_entrada" value="<?= htmlspecialchars($row['data_entrada']) ?>" required><br><br>

        <label>Valor:</label><br>
        <input type="text" name="valor" value="<?= htmlspecialchars($row['valor']) ?>" required><br><br>

        <label>Forma de Pagamento:</label><br>
        <input type="text" name="forma_pgt" value="<?= htmlspecialchars($row['forma_pgt']) ?>" required><br><br>

        <label>Garantia</label><br>
        <input type="text" name="garantia" value="<?= htmlspecialchars($row['garantia']) ?>" required><br><br>
        
        <label>ID do Cliente</label><br>
        <input type="text" name="id_cliente" value="<?= htmlspecialchars($row['id_cliente'])?>" required><br><br>


        <button type="submit">Salvar Alterações</button>
    </form>
</body>
</html>
