<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conexao.php');

// Pega o ID do cliente da URL e garante que seja um número
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("ID inválido.");
}

// Verifica se o cliente existe antes de excluir
$stmt = $conn->prepare("SELECT id_cliente FROM clientes WHERE id_cliente = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Cliente não encontrado.");
}

// Exclui o cliente
$stmt = $conn->prepare("DELETE FROM clientes WHERE id_cliente = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Cliente excluído com sucesso!'); window.location='ListarClientes.php';</script>";
    exit;
} else {
    echo "Erro ao excluir: " . $stmt->error;
}
?>

