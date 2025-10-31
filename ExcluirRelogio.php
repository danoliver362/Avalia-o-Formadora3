<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conexao.php');


$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    die("ID inválido.");
}


$stmt = $conn->prepare("SELECT id_relogio FROM relogios WHERE id_relogio = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Relogio não encontrado.");
}


$stmt = $conn->prepare("DELETE FROM relogios WHERE id_relogio = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "<script>alert('Relogio excluído com sucesso!'); window.location='ListagemRelogio.php';</script>";
    exit;
} else {
    echo "Erro ao excluir: " . $stmt->error;
}
?>
