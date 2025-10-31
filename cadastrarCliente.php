<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include('conexao.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];
    $cpf = $_POST['cpf'];
    $tipo = $_POST['tipo'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO clientes (nome, sobrenome, cpf, tipo, telefone)
            VALUES ('$nome', '$sobrenome', '$cpf', '$tipo', '$telefone')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Cliente cadastrado com sucesso!');</script>";
    } else {
        echo "Erro: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h2>Cadastrar Cliente</h2>

    <form method="POST">
        <label>Nome:</label><br>
        <input type="text" name="nome" required><br><br>

        <label>Sobrenome:</label><br>
        <input type="text" name="sobrenome" required><br><br>

        <label>CPF:</label><br>
        <input type="text" name="cpf" maxlength="11" required><br><br>

        <label>Tipo:</label><br>
        <select name="tipo">
            <option value="Varejo">Varejo</option>
            <option value="Atacado">Atacado</option>
        </select><br><br>

        <label>Telefone:</label><br>
        <input type="text" name="telefone"><br><br>

        <input type="submit" value="Cadastrar">
    </form>

    <br>
    <a href="PaginaInicial.html">Voltar ao início</a>
</body>
</html>
